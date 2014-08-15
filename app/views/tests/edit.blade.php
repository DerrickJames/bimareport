@extends('layout.main')

@section('title', 'Edit Test : ' . $test->test )

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
	{{ Form::model($test, array('method' => 'PUT', 'route' => array('test-update-put', $test->id))) }}
		@if(Session::has('error'))
			<div class="alert alert-danger"> {{ Session::get('error') }} </div>
		@elseif($errors->has())
			<div class="alert alert-danger"> {{ $errors->first() }} </div>
		@endif

		<fieldset>
			<legend>Lab Test</legend>
			<div class="col-md-6">
				<div class="control-group">
					<label for="test" class="control-label">Test</label>
					<input type="text" name="test" id="test" class="form-control input-xlarge" value="{{ $test->test }} " >
				</div>
				<div class="control-group">
					<label for="result" class="control-label">Result</label>
					<input type="text" name="result" id="result" class="form-control input-xlarge" value="{{ $test->result }}" >
				</div>
				<div class="control-group">
					<label for="diagnosis" class="control-label">Diagnosis</label>
					<input type="text" name="diagnosis" id="diagnosis" class="form-control input-xlarge" value="{{ $test->diagnosis }}" >
				</div>
			</div>
		</fieldset>
		<div class="form-actions">
			{{ Form::submit('Create', array('class' => 'btn btn-primary')) }} or
			{{ HTML::link('/', 'Cancel') }}
			{{ HTML::link(URL::route('patient-destroy', $test->id), 'Delete Patient', array('class' => 'btn btn-danger')) }}
		</div>
		{{ Form::token() }}
	</form>

@stop