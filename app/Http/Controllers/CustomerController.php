<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;


class CustomerController extends Controller
{
    //Muestra pagina principal
    public function home(Request $request){

        $auth = session('customer_info');

        //Check if the session is still active
        if (is_null($auth))
        {
            //return the login page 
            return redirect('/');
        }else{
           //return the welcome page 
           return view('index');  
        }

    }

    /*Valida la vida del token */
    public function verifyToken()
    {
        /*
        *check if the token is still valid
        *
        * This conditions is met when the current timestamp 
        * is greater that the access token expiration
        */
        if (Carbon::now()->timestamp > session('expiration_token')) {

           // dd("http://beesys.beenet.com.sv/api/2.0/admin/auth/tokens/.session('refresh_token')");
            // Renew token
            $response = Http::withOptions([
                    'debug' => false,
                    'verify' => false
                ])->get('https://beesys.beenet.com.sv/api/2.0/admin/auth/tokens/'.session('refresh_token'), [
                        
                ]);

            $responseToken = json_decode($response->getBody()->getContents()); 
            //dd($responseToken);
            session(['customer_token' => $responseToken->access_token]);
        } 
    }


    /*Muestra el listado de facturas */
    public function invoices(){

        //Call a verifyToken function
        $this->verifyToken();

        //$customerToken = session('customer_token');
        if (is_null(session('customer_token') ))
        {
            return redirect('/');
        }
       
        //this response show invoices list
        $response = Http::withOptions([
            'debug' => false,
            'verify' => false
        ])->withHeaders([
            'Authorization' => 'Splynx-EA (access_token=' . session('customer_token') . ')'
        ])->get('https://beesys.beenet.com.sv/api/2.0/admin/finance/invoices', [

        ]);

        $invoices = json_decode($response);
    
	    return view('facturas',compact('invoices'));
    }


    /*Funcion de descarga de factura */
    public function download(Request $request){

    
        $invoiceID = $request->input('invoiceID');
        //dd($invoiceID);
        //this response show invoices list
        $response = Http::withOptions([
            'debug' => false,
            'verify' => false
        ])->withHeaders([
            
            'Authorization' => 'Splynx-EA (access_token=' . session('customer_token') . ')'
        ])->get('https://beesys.beenet.com.sv/api/2.0/admin/config/download/invoices--' . $invoiceID, [

        ]);

        $invoicePDF = json_decode($response);
       // dd($invoicePDF);

        // Extract PDF content from the JSON data
        $pdfContent = base64_decode($invoicePDF->content);

        // Set the response headers for the file download
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename=' . $invoicePDF->name,
        ];

        // Return the PDF content as a download
        return response()->stream(
            function () use ($pdfContent) {
                echo $pdfContent;
            },
            200,
            $headers
        );
        
        //return response()($invoicePDF->content);
    }

    
    /* Recupera datos del formulario oculto que se completa al seleccionar las facturas a pagar */
    public function payInvoices(Request $request)
    {
        $incoming = $request->all();
        $email = $request->email;
        $amount= $request->total;
        $invoicesGrid= $request->invoicesGrid;
        //dd($incoming);
       return view('checkout', compact('invoicesGrid', 'email', 'amount'));

    }


    /*Funcion para realizar pago en Banco y CRM */
    public function pay(Request $request)
    {
        $incoming = $request->all();
        dd($incoming);
    }


    public function profile(){
    
        //Call a verifyToken function
        $this->verifyToken();

        //Get customer id 
        $customerId = session('customer_info')[0]->id;

        try {
          
            //this response show the customer info 
            $response1 = Http::withOptions([
                'debug' => false,
                'verify' => false
            ])->withHeaders([
                'Authorization' => 'Splynx-EA (access_token=' . session('customer_token') . ')'
            ])->get("https://beesys.beenet.com.sv/api/2.0/admin/customers/customer-billing/$customerId", [

            ]);

            $responseBillingInfo = json_decode($response1->getBody()->getContents());
           // dd($responseBillingInfo);

            //this response show the service information 
            $response2 = Http::withOptions([
                'debug' => false,
                'verify' => false
            ])->withHeaders([
                'Authorization' => 'Splynx-EA (access_token=' . session('customer_token') . ')'
            ])->get("https://beesys.beenet.com.sv/api/2.0/admin/customers/customer/$customerId/internet-services", [

            ]);

            $responseCustomerSevices = json_decode($response2->getBody()->getContents());
            //dd($responseCustomerSevices);
 
            //retur view  client info
            return view('perfil', compact('responseBillingInfo','responseCustomerSevices'));

        } catch (ClientException $e) {
            return back();
        }  
       
    }


    


    




}
