<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Solex Project</title>

  <!-- Bootstrap -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="{{asset('bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
	<!-- FancyBox -->
	<link  href="{{asset('js/fancybox-3.0/dist/jquery.fancybox.min.css')}}" rel="stylesheet">

	<!-- Font -->
	<link href='http://fonts.googleapis.com/css?family=Allan:bold' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'>

	@stack('stylesheet')


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

	<title>Solex Project</title>
</head>

 <body class="nav-md">
			<!-- Content Here -->
			@yield('content')
			<!-- Footer -->
			@include('webpage.layout.webpage_footer')
	</div>


	<!-- REQUIRED JS SCRIPTS -->
	<!-- jQuery -->
	<script src="{{asset('bower_components/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/webpage.js') }}"></script>
	<!-- FancyBox -->
	<script src="{{asset('js/fancybox-3.0/dist/jquery.fancybox.min.js')}}"></script>
	@stack('script')

  </body>
</html>
