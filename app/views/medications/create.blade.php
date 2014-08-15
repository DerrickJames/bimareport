@extends('layout.main')

@section('title', 'Administer Medication ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li><a href="{{ URL::route('patients-get') }}">Patients</a></li>
					<li class="active"><a href="{{ URL::route('patients-create-get') }}">New Patient</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')

	<div class="col-md-12">
		<div class="row">
			@if(Session::has('error'))
					<div class="alert alert-danger"> {{ Session::get('error') }} </div>
				@elseif($errors->has())
					<div class="alert alert-danger"> {{ $errors->first() }} </div>
				@endif
			<form action="{{ URL::route('test-create-post', $id) }}" method="post" class="col-md-6">
				<fieldset>
					<legend>Lab Tests</legend>
					<div class="col-md-6">
						<div class="control-group">
							<label for="item_id" class="control-label">Test</label>
							<select name="test" id="item_id" class="form-control">
								<option value="">Select Test</option>
								@foreach($test_items as $test_item)
									<option value="{{ $test_item->id }}">{{ $test_item->item }}</option>
								@endforeach
							</select>
						</div>
						<div class="control-group">
							<label for="result" class="control-label">Result</label>
							<input type="text" name="result" id="result" class="form-control input-xlarge" {{ Input::old('result') ? 'value="' .Input::old('result'). '"' : "" }} >
						</div>
						<div class="control-group">
							<label for="diagnosis" class="control-label">Diagnosis</label>
							<input type="text" name="diagnosis" id="diagnosis" class="form-control input-xlarge" {{ Input::old('diagnosis') ? 'value="' .Input::old('diagnosis'). '"' : "" }} >
						</div>
					</div>
				</fieldset>
				<div class="form-actions">
					{{ Form::submit('Create', array('class' => 'btn btn-primary')) }} or
					{{ HTML::link('/', 'Cancel') }}
				</div>
				{{ Form::token() }}
			</form>

			<form action="{{ URL::route('medication-create-post', $id) }}" method="post" class="col-md-6">
				<fieldset>
					<legend>Medication</legend>
					<div class="col-md-6">
						<div class="control-group">
							<label for="prescription" class="control-label">Prescription</label>
							<select name="prescription" id="prescription" class="form-control">
								<option value="">Select Prescription</option>
								@foreach($prescription_items as $prescription_item)
									<option value="{{ $prescription_item->id }}">{{ $prescription_item->item }}</option>
								@endforeach
							</select>
						</div>
						<div class="control-group">
							<label for="dosage" class="control-label">Dosage</label>
							<input type="text" name="dosage" id="dosage" class="form-control input-xlarge" {{ Input::old('dosage') ? 'value="' .Input::old('dosage'). '"' : "" }} >
						</div>
						<div class="control-group">
							<label for="start_date" class="control-label">Start Date</label>
							<input type="text" name="start_date" id="start_date" class="form-control input-xlarge" {{ Input::old('start_date') ? 'value="' .Input::old('start_date'). '"' : "" }} >
						</div>
						<div class="control-group">
							<label for="end_date" class="control-label">End Date</label>
							<input type="text" name="end_date" id="end_date" class="form-control input-xlarge" {{ Input::old('end_date') ? 'value="' .Input::old('end_date'). '"' : "" }} >
						</div>
					</div>
				</fieldset>
				<div class="form-actions">
					{{ Form::submit('Create', array('class' => 'btn btn-primary')) }} or
					{{ HTML::link('/', 'Cancel') }}
				</div>
				{{ Form::token() }}
			</form>
		</div>
	</div>	

@stop