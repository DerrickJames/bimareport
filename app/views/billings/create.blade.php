@extends('layout.main')

@section('title', 'Billing Management ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li><a href="{{ URL::route('billings-item-get') }}">Items</a></li>
					<li class="active"><a href="{{ URL::route('create-item-get') }}">New Item</a></li>
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
			<form action="{{ URL::route('create-item-post') }}" method="post" class="">
				<fieldset>
					<legend>Create a new billing item</legend>
					<div class="col-md-6">
						<div class="control-group">
							<label for="item" class="control-label">Item</label>
							<input type="text" name="item" id="item" class="form-control input-xlarge" {{ Input::old('item') ? 'value="' .Input::old('item'). '"' : "" }} >
						</div>
						<div class="control-group">
							<label for="type" class="control-label">Type</label>
							<select name="type" id="type" class="form-control">
								<option value="">Select Type</option>
								<option value="Fixed Charges">Fixed Charges</option>
								<option value="Laboratory Test">Laboratory Test</option>
								<option value="Medication">Medication</option>
							</select>
						</div>
						<div class="control-group">
							<label for="price" class="control-label">Price</label>
							<input type="text" name="price" id="price" class="form-control input-xlarge" {{ Input::old('price') ? 'value="' .Input::old('price'). '"' : "" }} >
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