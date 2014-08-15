@extends('layout.main')

@section('title', 'Registrations Desk ')

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
	<select name="q" id="searchbox" placeholder="Search Firstname"></select>

	<fieldset>
		<legend>Patient Queue</legend>
		<div class="table-responsive">
		
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Full Names</th>
						<th>Gender</th>
						<th>Age</th>
						<th>Visit</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>

					@if (isset($visits) && is_array($visits))
						@foreach ($visits as $visit)
							<tr>
								<td><a href="{{ URL::route('patient-chart-get', $visit->patient_id) }}">
									{{ e($visit->first_name . "&nbsp;&nbsp; " . $visit->last_name) }}
								</a></td>
								<td>{{ ($visit->gender == 0) ? 'Male' : 'Female' }}</td>
								<td>{{ $visit->age }}</td>
								<td>{{ ($visit->done == 1) ? '<span class="label label-danger">Attended</span>' : '<span class="label label-success">Active</span>' }}</td>
								<td>{{ $visit->created_at }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6"> <div class="alert alert-warning">No Records Found.</div> </td>
						</tr>
					@endif
					
				</tbody>
			</table>
		
		</div>
	</fieldset>

@stop