<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0, user-scalable=yes" name="viewport">

	<title>@yield('title')</title>
	<meta content="" name="descriptison">
	<meta content="" name="keywords">
	<meta name="google-signin-client_id" content="191807098939-q4fi2pb6v5enf5mfa01mksalh0kb9dn5.apps.googleusercontent.com">
	<meta name="token" content="{{ csrf_token() }}">
	<!-- Favicons -->
	<link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
	<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('assets/vendor/icofont/css/icofont.min.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/venobox/venobox.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('assets/vendor/ionicons/css/ionicons.min.css') }}"> --}}
	{{-- <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl.carousel2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl.carousel2/assets/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/lightbox2/css/lightbox.min.css') }}">

	<!-- Template Main CSS File -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Plugins CSS Files -->
	<link rel="stylesheet" href="{{ asset('plugins/themify/css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/swiper/swiper.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap-touchpin/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/devices.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	


    <div id="preloader"></div>
	<a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

	<script src="https://apis.google.com/js/platform.js" async defer></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	 <!-- Custom styles for this page -->
 	<link href="{{ asset('adm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<!-- Vendor JS Files -->
	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
	<script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/counterup/counterup.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
	<script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/owl.carousel2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/lightbox2/js/lightbox.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous"></script>

	
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYY-wMcvr6cGuSynbDsfyABKsGzOlz9X0&libraries=places&callback=initMap">
    </script>

	
	<!-- Page level plugins -->
  <script src="{{ asset('adm/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adm/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  

  <script> const BASE_URL = "{{ env('APP_URL') }}" </script>
</head>