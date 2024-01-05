@include('template')
<!-- ======== sidebar-nav start =========== -->
@include('nav') 


  <!-- ======== main-wrapper start =========== -->
  <main class="main-wrapper">

    <!-- ========== header start ========== -->
    @include('header')
    <!-- ========== header end ========== -->

    <!-- ========== header end ========== -->

    <!-- ========== section start ========== -->
    <section class="table-components">
      <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="title">
                <h2>Mis facturas</h2>
              </div>
            </div>
            <!-- end col -->
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- ========== tables-wrapper start ========== -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card-style mb-30">
              <div class="table-wrapper table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>
                        <h6>#</h6>
                      </th>
                      <th>
                        <h6>Numero de Factura</h6>
                      </th>
                      <th>
                        <h6>Fecha de Creación</h6>
                      </th>
                      <th>
                        <h6>Fecha de Vencimiento</h6>
                      </th>
                      <th>
                        <h6>Monto</h6>
                      </th>
                      <th>
                        <h6>Estado</h6>
                      </th>
                      <th>
                        <h6>Seleccionar Factura</h6>
                      </th>
                      <th>
                        <h6>Acciones</h6>
                      </th>
                    </tr>
                    <!-- end table row-->
                  </thead>
                  <tbody>
                  @foreach ($invoices as $invoice)
                    <tr>
                      <td> {{ $invoice->id }} </td>
                      <td class="min-width"> <p>{{ $invoice->number }}</p></td>
                      <td class="min-width"> <p><a href="#0">{{ date('d-m-Y', strtotime($invoice->date_created)) }}</a></p></td>
                      <td class="min-width"> <p>{{ date('d-m-Y', strtotime($invoice->date_till)) }}</p> </td>
                      <td class="min-width"> ${{ number_format((float)$invoice->total , 2, '.', '')}} </td>
                      <td>
                        <div class="action">
                          @if ($invoice->status == 'not_paid')
                           <span class="status-btn active-btn">No pagado</span>
                          @endif
                          @if ($invoice->status == 'paid')
                            <span class="status-btn active-btn">Pagada</span>
                          @endif
                          @if ($invoice->status == 'Pending')
                          <span class="status-btn active-btn">Pendiente</span>
                          @endif
                          @if ($invoice->status == 'Deleted')
                          <span class="status-btn active-btn">Eliminada</span>
                          @endif
                          
                          <!--span class="status-btn active-btn">Pendiente</span-->
                        </div>
                      </td>
                      <td>
                        <center>
                          <div class="check-input-primary">
                            @if ($invoice->status != 'paid')
                            <input name="facturas" type="checkbox" value=" {{ $invoice->number }} "  tu-attr-precio="{{ $invoice->total }}"  tu-attr-id="{{$invoice->id}} " class="mis-checkboxes"></td>
                              <!--input name="facturas" class="form-check-input" type="checkbox" value=" {{ $invoice->number }} "  tu-attr-precio="{{ $invoice->total }}"  tu-attr-id="{{$invoice->id}} " class="mis-checkboxes"></td-->
                            @endif
                          </div>
                        </center>
                      </td>
                      <td>
                        <div class="action">
                          <center>
                          <a href="{{ route('pdfinvoices', ['invoiceID' =>  $invoice->id ]) }}" class="btn btn-primary"><span class="micon dw dw-download"></span></a>

                            <button>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                              </svg>
                            </button>
                          </center>
                        </div>
                      </td>
                    </tr>
                    <!-- end table row -->
                    <!-- end table row -->
                    @endforeach     
                  </tbody>

                  <form   method="POST" action="{{ route('payInvoices') }}"  >
                    @csrf
                    <th colspan="5"></th> 
                    <th> Total a pagar:  </th>
                    <th colspan="1" > 
                    <input  style="background: #393e46; border-radius: 25px; color: white; width:150px; height: 55px; text-align: center;" id="total" name=" total" type="text"  placeholder="0.00" class="form-control"  value="$ 0.00"  readonly/>
                    </th>
                    
                    <input type="hidden" class="form-control" id="email" name="email" value="{{session('customer_info')[0]->email}}" required/>
            
                    <input  type="hidden"  class="form-control"  name="invoicesGrid"  id="invoicesGrid"  value=""><br>

                    <th>
                        <input class="btn btn-primary" id="btnPagar" type="submit" value="Pagar">       
                    </th>
                
                  </form>
                </table>
                <!-- end table -->
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- ========== tables-wrapper end ========== -->
      </div>
      <!-- end container -->
    </section>
    <!-- ========== section end ========== -->


    <!-- ========== footer start =========== -->
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 order-last order-md-first">
            <div class="copyright text-center text-md-start">
              <p class="text-sm">
                Designed and Developed by
                Click Networks
                </a>
              </p>
            </div>
          </div>
          <!-- end col-->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </footer>
    <!-- ========== footer end =========== -->
  </main>
  <!-- ======== main-wrapper end =========== -->
  @include('sweetalert::alert')
  <!-- ========= All Javascript files linkup ======== -->
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script src="{{asset('js/dynamic-pie-chart.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/fullcalendar.js')}}"></script>
    <script src="{{asset('js/jvectormap.min.js')}}"></script>
    <script src="{{asset('js/world-merc.js')}}"></script>
    <script src="{{asset('js/polyfill.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <!--script>
    // ======== jvectormap activation
    var markers = [
      { name: "Egypt", coords: [26.8206, 30.8025] },
      { name: "Russia", coords: [61.524, 105.3188] },
      { name: "Canada", coords: [56.1304, -106.3468] },
      { name: "Greenland", coords: [71.7069, -42.6043] },
      { name: "Brazil", coords: [-14.235, -51.9253] },
    ];

    var jvm = new jsVectorMap({
      map: "world_merc",
      selector: "#map",
      zoomButtons: true,

      regionStyle: {
        initial: {
          fill: "#d1d5db",
        },
      },

      labels: {
        markers: {
          render: (marker) => marker.name,
        },
      },

      markersSelectable: true,
      selectedMarkers: markers.map((marker, index) => {
        var name = marker.name;

        if (name === "Russia" || name === "Brazil") {
          return index;
        }
      }),
      markers: markers,
      markerStyle: {
        initial: { fill: "#4A6CF7" },
        selected: { fill: "#ff5050" },
      },
      markerLabelStyle: {
        initial: {
          fontWeight: 400,
          fontSize: 14,
        },
      },
    });
    // ====== calendar activation
    document.addEventListener("DOMContentLoaded", function () {
      var calendarMiniEl = document.getElementById("calendar-mini");
      var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
        initialView: "dayGridMonth",
        headerToolbar: {
          end: "today prev,next",
        },
      });
      calendarMini.render();
    });

    // =========== chart one start
    const ctx1 = document.getElementById("Chart1").getContext("2d");
    const chart1 = new Chart(ctx1, {
      type: "line",
      data: {
        labels: [
          "Jan",
          "Fab",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "",
            backgroundColor: "transparent",
            borderColor: "#365CF5",
            data: [
              600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
            ],
            pointBackgroundColor: "transparent",
            pointHoverBackgroundColor: "#365CF5",
            pointBorderColor: "transparent",
            pointHoverBorderColor: "#fff",
            pointHoverBorderWidth: 5,
            borderWidth: 5,
            pointRadius: 8,
            pointHoverRadius: 8,
            cubicInterpolationMode: "monotone", // Add this line for curved line
          },
        ],
      },
      options: {
        plugins: {
          tooltip: {
            callbacks: {
              labelColor: function (context) {
                return {
                  backgroundColor: "#ffffff",
                  color: "#171717"
                };
              },
            },
            intersect: false,
            backgroundColor: "#f9f9f9",
            title: {
              fontFamily: "Plus Jakarta Sans",
              color: "#8F92A1",
              fontSize: 12,
            },
            body: {
              fontFamily: "Plus Jakarta Sans",
              color: "#171717",
              fontStyle: "bold",
              fontSize: 16,
            },
            multiKeyBackground: "transparent",
            displayColors: false,
            padding: {
              x: 30,
              y: 10,
            },
            bodyAlign: "center",
            titleAlign: "center",
            titleColor: "#8F92A1",
            bodyColor: "#171717",
            bodyFont: {
              family: "Plus Jakarta Sans",
              size: "16",
              weight: "bold",
            },
          },
          legend: {
            display: false,
          },
        },
        responsive: true,
        maintainAspectRatio: false,
        title: {
          display: false,
        },
        scales: {
          y: {
            grid: {
              display: false,
              drawTicks: false,
              drawBorder: false,
            },
            ticks: {
              padding: 35,
              max: 1200,
              min: 500,
            },
          },
          x: {
            grid: {
              drawBorder: false,
              color: "rgba(143, 146, 161, .1)",
              zeroLineColor: "rgba(143, 146, 161, .1)",
            },
            ticks: {
              padding: 20,
            },
          },
        },
      },
    });
    // =========== chart one end

    // =========== chart two start
    const ctx2 = document.getElementById("Chart2").getContext("2d");
    const chart2 = new Chart(ctx2, {
      type: "bar",
      data: {
        labels: [
          "Jan",
          "Fab",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "",
            backgroundColor: "#365CF5",
            borderRadius: 30,
            barThickness: 6,
            maxBarThickness: 8,
            data: [
              600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
            ],
          },
        ],
      },
      options: {
        plugins: {
          tooltip: {
            callbacks: {
              titleColor: function (context) {
                return "#8F92A1";
              },
              label: function (context) {
                let label = context.dataset.label || "";

                if (label) {
                  label += ": ";
                }
                label += context.parsed.y;
                return label;
              },
            },
            backgroundColor: "#F3F6F8",
            titleAlign: "center",
            bodyAlign: "center",
            titleFont: {
              size: 12,
              weight: "bold",
              color: "#8F92A1",
            },
            bodyFont: {
              size: 16,
              weight: "bold",
              color: "#171717",
            },
            displayColors: false,
            padding: {
              x: 30,
              y: 10,
            },
          },
        },
        legend: {
          display: false,
        },
        legend: {
          display: false,
        },
        layout: {
          padding: {
            top: 15,
            right: 15,
            bottom: 15,
            left: 15,
          },
        },
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            grid: {
              display: false,
              drawTicks: false,
              drawBorder: false,
            },
            ticks: {
              padding: 35,
              max: 1200,
              min: 0,
            },
          },
          x: {
            grid: {
              display: false,
              drawBorder: false,
              color: "rgba(143, 146, 161, .1)",
              drawTicks: false,
              zeroLineColor: "rgba(143, 146, 161, .1)",
            },
            ticks: {
              padding: 20,
            },
          },
        },
        plugins: {
          legend: {
            display: false,
          },
          title: {
            display: false,
          },
        },
      },
    });
    // =========== chart two end

    // =========== chart three start
    const ctx3 = document.getElementById("Chart3").getContext("2d");
    const chart3 = new Chart(ctx3, {
      type: "line",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "Revenue",
            backgroundColor: "transparent",
            borderColor: "#365CF5",
            data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
            pointBackgroundColor: "transparent",
            pointHoverBackgroundColor: "#365CF5",
            pointBorderColor: "transparent",
            pointHoverBorderColor: "#365CF5",
            pointHoverBorderWidth: 3,
            pointBorderWidth: 5,
            pointRadius: 5,
            pointHoverRadius: 8,
            fill: false,
            tension: 0.4,
          },
          {
            label: "Profit",
            backgroundColor: "transparent",
            borderColor: "#9b51e0",
            data: [
              120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
            ],
            pointBackgroundColor: "transparent",
            pointHoverBackgroundColor: "#9b51e0",
            pointBorderColor: "transparent",
            pointHoverBorderColor: "#9b51e0",
            pointHoverBorderWidth: 3,
            pointBorderWidth: 5,
            pointRadius: 5,
            pointHoverRadius: 8,
            fill: false,
            tension: 0.4,
          },
          {
            label: "Order",
            backgroundColor: "transparent",
            borderColor: "#f2994a",
            data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
            pointBackgroundColor: "transparent",
            pointHoverBackgroundColor: "#f2994a",
            pointBorderColor: "transparent",
            pointHoverBorderColor: "#f2994a",
            pointHoverBorderWidth: 3,
            pointBorderWidth: 5,
            pointRadius: 5,
            pointHoverRadius: 8,
            fill: false,
            tension: 0.4,
          },
        ],
      },
      options: {
        plugins: {
          tooltip: {
            intersect: false,
            backgroundColor: "#fbfbfb",
            titleColor: "#8F92A1",
            bodyColor: "#272727",
            titleFont: {
              size: 16,
              family: "Plus Jakarta Sans",
              weight: "400",
            },
            bodyFont: {
              family: "Plus Jakarta Sans",
              size: 16,
            },
            multiKeyBackground: "transparent",
            displayColors: false,
            padding: {
              x: 30,
              y: 15,
            },
            borderColor: "rgba(143, 146, 161, .1)",
            borderWidth: 1,
            enabled: true,
          },
          title: {
            display: false,
          },
          legend: {
            display: false,
          },
        },
        layout: {
          padding: {
            top: 0,
          },
        },
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false,
        },
        scales: {
          y: {
            grid: {
              display: false,
              drawTicks: false,
              drawBorder: false,
            },
            ticks: {
              padding: 35,
            },
            max: 350,
            min: 50,
          },
          x: {
            grid: {
              drawBorder: false,
              color: "rgba(143, 146, 161, .1)",
              drawTicks: false,
              zeroLineColor: "rgba(143, 146, 161, .1)",
            },
            ticks: {
              padding: 20,
            },
          },
        },
      },
    });
    // =========== chart three end

    // ================== chart four start
    const ctx4 = document.getElementById("Chart4").getContext("2d");
    const chart4 = new Chart(ctx4, {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        datasets: [
          {
            label: "",
            backgroundColor: "#365CF5",
            borderColor: "transparent",
            borderRadius: 20,
            borderWidth: 5,
            barThickness: 20,
            maxBarThickness: 20,
            data: [600, 700, 1000, 700, 650, 800],
          },
          {
            label: "",
            backgroundColor: "#d50100",
            borderColor: "transparent",
            borderRadius: 20,
            borderWidth: 5,
            barThickness: 20,
            maxBarThickness: 20,
            data: [690, 740, 720, 1120, 876, 900],
          },
        ],
      },
      options: {
        plugins: {
          tooltip: {
            backgroundColor: "#F3F6F8",
            titleColor: "#8F92A1",
            titleFontSize: 12,
            bodyColor: "#171717",
            bodyFont: {
              weight: "bold",
              size: 16,
            },
            multiKeyBackground: "transparent",
            displayColors: false,
            padding: {
              x: 30,
              y: 10,
            },
            bodyAlign: "center",
            titleAlign: "center",
            enabled: true,
          },
          legend: {
            display: false,
          },
        },
        layout: {
          padding: {
            top: 0,
          },
        },
        responsive: true,
        // maintainAspectRatio: false,
        title: {
          display: false,
        },
        scales: {
          y: {
            grid: {
              display: false,
              drawTicks: false,
              drawBorder: false,
            },
            ticks: {
              padding: 35,
              max: 1200,
              min: 0,
            },
          },
          x: {
            grid: {
              display: false,
              drawBorder: false,
              color: "rgba(143, 146, 161, .1)",
              zeroLineColor: "rgba(143, 146, 161, .1)",
            },
            ticks: {
              padding: 20,
            },
          },
        },
      },
    });
    // =========== chart four end
  </script-->

  
  <script>
        
    $(document).ready(function() {

      // Validacion de boton de pago cuando tiene amount igual a 0
      if( $("#total").val() == "$ 0.00" ) {
          $("#btnPagar").hide();
      } 

      $("input:checkbox").on('click', function() {
          var ids = [];
          var prices = [];
          var invoicesGrid = {};

          var tot = $('#total');
          tot.val(0);
      
          $('input[name=facturas]').each(function () {

              if($(this).is(':checked')) { 
                  
                  var id = $.trim($(this).attr("tu-attr-id"));
                  var price = $.trim($(this).attr("tu-attr-precio"));

                  if(id in invoicesGrid == false) {
                      invoicesGrid[id] = price; 
                  } else {
                  $('#invoicesGrid').val('');
                  }

                  $('#invoicesGrid').val(JSON.stringify(invoicesGrid));
              } // Crear json

              if($(this).hasClass('mis-checkboxes')) {
                  tot.val(($(this).is(':checked') ? parseFloat($(this).attr('tu-attr-precio')) : 0) + parseFloat(tot.val()));  
              }
              else {
                  tot.val(parseFloat(tot.val()) + (isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val())));
              }

          });

          var totalParts = parseFloat(tot.val()).toFixed(2).split('.');
          tot.val('' + totalParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '.' +  (totalParts.length > 1 ? totalParts[1] : '00'));   
          $("#btnPagar").show();  // Mostrar btnPagar
      });
      
    });

  </script>


</body>

</html>