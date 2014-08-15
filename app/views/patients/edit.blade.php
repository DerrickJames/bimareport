@extends('layout.main')

@section('title', 'Edit Patient : ' . $patient->first_name )

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li><a href="{{ URL::route('patients-get') }}">Patients</a></li>
					<li><a href="{{ URL::route('patients-create-get') }}">New Patient</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')
	
	<!-- <form action="{{ URL::route('patients-update-put') }}" method="post" class=""> -->
	{{ Form::model($patient, array('method' => 'PUT', 'route' => array('patients-update-put', $patient->id))) }}
		@if(Session::has('error'))
			<div class="alert alert-danger"> {{ Session::get('error') }} </div>
		@elseif($errors->has())
			<div class="alert alert-danger"> {{ $errors->first() }} </div>
		@endif

		<fieldset>
			<legend>Patient Details</legend>
			<div class="col-md-6">
				<div class="control-group">
					<label for="first_name" class="control-label">Firstname</label>
					<input type="text" name="first_name" id="first_name" class="form-control input-xlarge" value="{{ $patient->first_name }} " >
				</div>
				<div class="control-group">
					<label for="last_name" class="control-label">Lastname</label>
					<input type="text" name="last_name" id="last_name" class="form-control input-xlarge" value="{{ $patient->last_name }}" >
				</div>
				<div class="control-group">
					<label for="national_id" class="control-label">National ID</label>
					<input type="text" name="national_id" id="national_id" class="form-control input-xlarge" value="{{ $patient->national_id }}" >
				</div>
				<div class="control-group">
					<label for="medical_insurance" class="control-label">Medical Insurance</label>
					<input type="text" name="medical_insurance" id="medical_insurance" class="form-control input-xlarge" value="{{ $patient->medical_insurance }}" >
				</div>
				<div class="control-group">
					<label for="gender" class="control-label">Gender</label>
					<div class="radio-group">
						<label for="male"><input type="radio" name="gender" value="0" id="male">Male</label>
						<label for="female"><input type="radio" name="gender" value="1" id="female">Female</label>
					</div>
				</div>
				<div class="control-group">
					<label for="age" class="control-label">Age</label>
					<input type="text" name="age" id="age" class="form-control input-xlarge" value="{{ $patient->age }}" >
				</div>
			</div>
		</fieldset>
		<div class="form-actions">
			{{ Form::submit('Create', array('class' => 'btn btn-primary')) }} or
			{{ HTML::link('/', 'Cancel') }}
			{{ HTML::link(URL::route('patient-destroy', $patient->id), 'Delete Patient', array('class' => 'btn btn-danger')) }}
		</div>
		{{ Form::token() }}
	</form>

@stop