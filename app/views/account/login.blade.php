@extends('layout.main')

@section('content')
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-info">
			<div class="panel-heading">Login</div>
			<div class="panel-body">
				<form action="{{ URL::route('account-log-in-post') }}" method="post">
					@if(Session::has('error'))
						<div class="alert alert-danger"> {{ Session::get('error') }} </div>
					@elseif($errors->has())
						<div class="alert alert-danger"> {{ $errors->first() }} </div>
					@endif
					
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control" {{ Input::old('email') ? 'value="' .Input::old('email'). '"' : "" }} >
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control" />
					</div>
					<div class="form-group">
						{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
						{{ HTML::link('/', 'Cancel', array('class' => 'btn btn-danger')) }}
					</div>
					{{ Form::token() }}
					{{ HTML::link('/account/register', 'Register New Member') }}
				</form>
			</div>
		</div>
	</div>

@stop