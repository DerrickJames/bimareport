@extends('layout.main')

@section('title', 'Edit Client : ' . $bima->first_name )

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li><a href="{{ URL::route('bimas-get') }}">Clients</a></li>
					<li class="active"><a href="{{ URL::route('create-client-get') }}">New Client</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')
	
	{{ Form::model($bima, array('method' => 'PUT', 'route' => array('client-update-put', $bima->id))) }}
		@if(Session::has('error'))
			<div class="alert alert-danger"> {{ Session::get('error') }} </div>
		@elseif($errors->has())
			<div class="alert alert-danger"> {{ $errors->first() }} </div>
		@endif

		<fieldset>
			<legend>Client Details</legend>
			<div class="col-md-6">
				<div class="control-group">
					<label for="first_name" class="control-label">Firstname</label>
					<input type="text" name="first_name" id="first_name" class="form-control input-xlarge" value="{{ $bima->first_name }} " >
				</div>
				<div class="control-group">
					<label for="last_name" class="control-label">Lastname</label>
					<input type="text" name="last_name" id="last_name" class="form-control input-xlarge" value="{{ $bima->last_name }}" >
				</div>
				<div class="control-group">
					<label for="national_id" class="control-label">National ID</label>
					<input type="text" name="national_id" id="national_id" class="form-control input-xlarge" value="{{ $bima->national_id }}" >
				</div>
				<div class="control-group">
					<label for="medical_insurance" class="control-label">Medical Insurance</label>
					<input type="text" name="medical_insurance" id="medical_insurance" class="form-control input-xlarge" value="{{ $bima->medical_insurance }}" >
				</div>
				<div class="control-group">
					<label for="company" class="control-label">Company</label>
					<select name="company" id="company"class="form-control">
						<option value="">Select Company</option>
						<option value="AON">AON Insurance</option>
						<option value="NHIF">NHIF</option>
						<option value="JUBILEE">JUBILEE</option>
					</select>
				</div>
				<div class="control-group">
					<label for="monthly_rate" class="control-label">Monthly Rate</label>
					<input type="text" name="monthly_rate" id="monthly_rate" class="form-control input-xlarge" value="{{ $bima->monthly_rate }}" >
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
					<input type="text" name="age" id="age" class="form-control input-xlarge" value="{{ $bima->age }}" >
				</div>
				<div class="control-group">
					<label for="email" class="control-label">Email</label>
					<input type="email" name="email" id="email" class="form-control input-xlarge" value="{{ $bima->email }}" >
				</div>
				<div class="control-group">
					<label for="phone_number" class="control-label">Phone Number</label>
					<input type="text" name="phone_number" id="phone_number" class="form-control input-xlarge" value="{{ $bima->phone_number }}" >
				</div>
				<div class="control-group">
					<label for="location" class="control-label">Location</label>
					<input type="text" name="location" id="location" class="form-control input-xlarge" value="{{ $bima->location }}" >
				</div>
			</div>
		</fieldset>
		<div class="form-actions">
			{{ Form::submit('Create', array('class' => 'btn btn-primary')) }} or
			{{ HTML::link('/', 'Cancel') }}
		</div>
		{{ Form::token() }}
	</form>

@stop