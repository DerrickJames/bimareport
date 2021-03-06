@extends('layout.main')

@section('title', 'User: ' . $user->first_name)

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<?php $userGroup 	= Sentry::findGroupByName('User'); ?>
			<?php $user 		= Sentry::getUser(); ?>
			
			@if( ! $user->inGroup($userGroup) )
				<div class="pull-right">
					<ul class="nav nav-pills">
						<li><a href="{{ URL::route('users') }}">Users</a></li>
						<li class="active"><a href="{{ URL::route('account-create') }}">New User</a></li>
						<li><a href="{{ URL::route('account-register') }}">New Member</a></li>
					</ul>
				</div>
			@endif

		</div>
	</div>
@stop

@section('content')
	
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-info">
			<div class="panel-heading">Update User</div>
			<div class="panel-body">
				{{ Form::model($user, array('method' => 'PUT', 'route' => array('user-update-put', isset($user->id) ? $user->id : ""))) }}
					@if(Session::has('error'))
						<div class="alert alert-danger"> {{ Session::get('error') }} </div>
					@elseif($errors->has())
						<div class="alert alert-danger"> {{ $errors->first() }} </div>
					@endif

					<div class="form-group">
						<label for="first_name">Firstname</label>
						<input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}" >
					</div>
					<div class="form-group">
						<label for="last_name">Lastname</label>
						<input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}" >
					</div>
					<div class="form-group">
						<label for="membership_no">Membership Number</label>
						<input type="text" name="membership_no" id="membership_no" class="form-control" value="{{ $user->membership_no }}" >
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" >
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control" />
					</div>
					<div class="form-group">
						<label for="confirm_password">Confirm Password</label>
						<input type="password" name="confirm_password" id="confirm_password" class="form-control">
					</div>
					<div class="form-group">
						{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
						{{ HTML::link('/', 'Cancel', array('class' => 'btn btn-danger')) }}
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>

@stop