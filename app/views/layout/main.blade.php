<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title') : : BimaReports</title>
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
	@include('layout.navigation')

	@yield('subnav')

	<div class="container">
		@if (Session::has('global'))
			<div class="alert alert-success"> {{ Session::get('global') }} </div>
		@endif
		
		@yield('content')
	</div>

	@include('layout.footer')
	
	<script type="text/javascript" src="{{ URL::asset('js/jquery-1.7.2.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('selectize/js/standalone/selectize.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>	
</body>
</html>