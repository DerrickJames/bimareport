@extends('layout.main')

@section('title', 'Patient Management ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{ URL::route('patients-get') }}">Patients</a></li>
					<li><a href="{{ URL::route('patients-create-get') }}">New Patient</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')

	<div class="table-responsive">
		
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Gender</th>
					<th>Age</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@if (isset($patients) && $patients->count())
					@foreach ($patients as $patient)
						<tr>
							<td>{{ $patient->id }}</td>
							<td><a href="{{ URL::route('patient-chart-get', $patient->id) }}">{{ $patient->first_name }}</a></td>
							<td>{{ $patient->last_name }}</td>
							<td>{{ ($patient->gender == 0) ? 'Male' : 'Female' }}</td>
							<td>{{ $patient->age }}</td>
							<td><a href="{{ URL::route('patient-edit-get', $patient->id) }}">Edit</a></td>
							<td><a href="{{ URL::route('patient-destroy', $patient->id) }}">Delete</a></td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="8"> <div class="alert alert-warning">No Records Found.</div> </td>
					</tr>
				@endif
			</tbody>
		</table>

	</div>

@stop