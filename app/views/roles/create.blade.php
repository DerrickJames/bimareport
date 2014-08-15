@extends('layout.main')

@section('title', 'Create New Role')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{ URL::route('roles') }}">Roles</a></li>
					<li><a href="{{ URL::route('create-roles') }}">New Role</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')
	
	<form action="{{ URL::route('roles-post') }}" method="post" class="">
		@if(Session::has('error'))
			<div class="alert alert-danger"> {{ Session::get('error') }} </div>
		@elseif($errors->has())
			<div class="alert alert-danger"> {{ $errors->first() }} </div>
		@endif

		<fieldset>
			<legend>Role Details</legend>
			<div class="col-md-6">
			<div class="control-group">
				<label for="name" class="control-label">Role Name</label>
				<input type="text" name="name" id="name" class="form-control input-xlarge" {{ Input::old('name') ? 'value="' .Input::old('name'). '"' : "" }} >
			</div>
			<div class="control-group">
				<label for="description" class="control-label">Description</label>
				<textarea name="description" id="description" class="form-control" cols="10" rows="4"></textarea>
			</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Permissions</legend>
			<div class="alert alert-info">You will be able to edit permissions once the role has been created.</div>
		</fieldset>
		<div class="form-actions">
			{{ Form::submit('Create', array('class' => 'btn btn-primary')) }} or
			{{ HTML::link('/', 'Cancel') }}
		</div>
		{{ Form::token() }}
	</form>

@stop