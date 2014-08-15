@extends('layout.main')

@section('content')
	
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-info">
			<div class="panel-heading">Register Member</div>
			<div class="panel-body">
				<form action="{{ URL::route('account-register-post') }}" method="post">
					@if(Session::has('error'))
						<div class="alert alert-danger"> {{ Session::get('error') }} </div>
					@elseif($errors->has())
						<div class="alert alert-danger"> {{ $errors->first() }} </div>
					@endif

					<div class="form-group">
						<label for="first_name">Firstname</label>
						<input type="text" name="first_name" id="first_name" class="form-control" {{ Input::old('first_name') ? 'value="' .Input::old('first_name'). '"' : "" }} >
					</div>
					<div class="form-group">
						<label for="last_name">Lastname</label>
						<input type="text" name="last_name" id="last_name" class="form-control" {{ Input::old('last_name') ? 'value="' .Input::old('last_name'). '"' : "" }} >
					</div>
					<div class="form-group">
						<label for="membership_no">Medical Insurance</label>
						<input type="text" name="membership_no" id="membership_no" class="form-control" {{ Input::old('membership_no') ? 'value="' .Input::old('membership_no'). '"' : "" }} >
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control" {{ Input::old('email') ? 'value="' .Input::old('email'). '"' : "" }} >
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
						{{ Form::submit('Register', array('class' => 'btn btn-primary')) }}
						{{ HTML::link('/', 'Cancel', array('class' => 'btn btn-danger')) }}
					</div>
					{{ Form::token() }}
				</form>
			</div>
		</div>
	</div>

@stop