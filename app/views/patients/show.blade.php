@extends('layout.main')

@section('title', 'Patient Chart ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{ URL::route('patient-chart-get') }}">Chart</a></li>
					<li><a href="{{ URL::route('registrations-visit-get', $patient->id) }}">Start Visit</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')

	<!-- <div class="table-responsive"> -->
		
		<table class="table">
			<thead>
				<tr>
					<th>{{ "Chart ID - " . $patient->id }}</th>
					<th>{{ $patient->first_name . " " . $patient->last_name}}</th>
					<th>{{ ($patient->gender == 0) ? "Male" : "Female" }}</th>
					<th>{{ $patient->age . " Years" }}</th>
				</tr>
			</thead>
		</table>

	<!-- </div> -->

	<fieldset> 
		<legend>Lab Tests</legend>
		<div class="table-responsive">
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th><a href="{{ URL::route('medication-create-get', $patient->id) }}">New Test</a></th>
						<th></th>
						<th>Test</th>
						<th>Result</th>
						<th>Diagnosis</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@if (isset($tests) && $tests->count())
						@foreach ($tests as $test)
							<tr>
								<td><a href="{{ URL::route('medication-update-get', $test->id) }}">Edit</a></td>
								<td><a href="{{ URL::route('test-destroy', $test->id) }}">Delete</a></td>
								<td>{{ $test->item }}</td>
								<td>{{ $test->result }}</td>
								<td>{{ $test->diagnosis }}</td>
								<td>{{ $test->created_at }}</td>
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

	<fieldset> 
		<legend>Medication</legend>
		<div class="table-responsive">
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th><a href="{{ URL::route('medication-create-get', $patient->id) }}">New Medication</a></th>
						<th></th>
						<th>Prescription</th>
						<th>Dosage</th>
						<th>Start Date</th>
						<th>End Date</th>
					</tr>
				</thead>
				<tbody>
					@if (isset($medications) && $medications->count())
						@foreach ($medications as $medication)
							<tr>
								<td><a href="{{ URL::route('medication-update-get', $medication->id) }}">Edit</a></td>
								<td><a href="{{ URL::route('medication-destroy', $medication->id) }}">Delete</a></td>
								<td>{{ $medication->item }}</td>
								<td>{{ $medication->dosage }}</td>
								<td>{{ $medication->start_date }}</td>
								<td>{{ $medication->end_date }}</td>
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