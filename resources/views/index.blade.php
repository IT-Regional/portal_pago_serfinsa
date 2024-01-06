@include('template')
<!-- ======== sidebar-nav start =========== -->
  @include('nav') 
  <div class="overlay"></div>
      <!-- ======== main-wrapper start =========== -->
      <main class="main-wrapper">

      <!-- ========== header start ========== -->
      @include('header')
      <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section">
          <br>
          <div class="card-style text-center"
            style="background-image: url('{{ asset('images/robertodiaz_Telecommunications_company_latino_man_staff_perform_1739baf7-2286-4303-9333-c08190b3bf82-1024x574.png') }}'); background-repeat: no-repeat; background-size: cover; height:500px;">
            <div class="error-box" style="margin-top: 20%;">
              <h1 class="fw-700 mb-15 text-white">Click Networks El Salvador</h1>
              <h6 class="mb-10 text-white">El interner más rapido de todo el pais</h6>
            </div>
          </div>
          <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <div class="title">
                    <h2>Tenemos que colocar algo aqui</h2>
                  </div>
                </div>
                <!-- end col -->
                <!-- end col -->
              </div>
              <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="row">
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="icon purple">
                    <br>
                    <i class="lni lni-cart-full"></i>
                  </div>
                  <div class="content">
                    <h6 class="mb-10">Facturas Pagadas</h6>
                    <h3 class="text-bold mb-10">3</h3>
                  </div>
                </div>
                <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="icon success">
                    <i class="lni lni-dollar"></i>
                  </div>
                  <div class="content">
                    <h6 class="mb-10">Facturas Pendientes</h6>
                    <h3 class="text-bold mb-10">1</h3>
                  </div>
                </div>
                <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="icon primary">
                    <i class="lni lni-credit-cards"></i>
                  </div>
                  <div class="content">
                    <h6 class="mb-10">Balance Total</h6>
                    <h3 class="text-bold mb-10">$2,000</h3>
                  </div>
                </div>
                <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="icon orange">
                    <i class="lni lni-user"></i>
                  </div>
                  <div class="content">
                    <h6 class="mb-10">Servicios Contratados</h6>
                    <h3 class="text-bold mb-10">2</h3>
                  </div>
                </div>
                <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
            </div>
          </div>
          <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        
        <!-- ========== footer start =========== -->
        @include('footer')
        <!-- ========== footer end =========== -->
      </main>

