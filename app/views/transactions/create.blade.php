@extends('layout.main')

@section('title', 'Cashier Till ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{ URL::route('registrations-get') }}">Visits</a></li>
					<li><a href="{{ URL::route('patients-create-get') }}">New Patient</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')

	<!-- pass the URL of the root to javascript -->
	<script type="text/javascript">
		var root = '{{ url("/") }}';
	</script>

	<!-- Selectized select element -->
	<select name="q" id="transactionSearchBox" placeholder="Search Firstname"></select>

@stop