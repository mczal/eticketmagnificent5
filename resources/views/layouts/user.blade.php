<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>PARAHYANGAN FAIR 2016</title>
      <!-- favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
        <!-- Bootstrap -->
      <link href="{{url('/assets/css/bootstrap.css')}}" rel="stylesheet">
      <link href="{{url('/assets/css/custom.css')}}" rel="stylesheet">

      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body style="background:@yield('background')">

        <div class = "container">
          <!-- HERE-->
          <div class="content-wrapper">
              <!-- Main content -->
              <section class="content">

                  <!-- Your Page Content Here -->
                  @yield('content')

              </section><!-- /.content -->
          </div><!-- /.content-wrapper -->
       </div>
       <h5 align='center'><a href="http://instagram.com/parahyanganfair">@PARAHYANGANFAIR</a></h5>


    <!-- REQUIRED JS SCRIPTS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{url('/assets/js/bootstrap.min.js')}}"></script>

    </body>
</html>
