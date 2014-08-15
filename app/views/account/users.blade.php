@extends('layout.main')

@section('title', 'User Management ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{ URL::route('users') }}">Users</a></li>
					<li><a href="{{ URL::route('account-create') }}">New User</a></li>
					<li><a href="{{ URL::route('account-register') }}">New Member</a></li>
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
					<th>Email</th>
					<th>Membership Number</th>
					<th>Last Login</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@if (isset($users) && is_array($users))
					@foreach ($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td><a href="{{ URL::route('user-update-get', $user->id) }}">{{ $user->first_name }}</a></td>
							<td>{{ $user->last_name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->membership_no }}</td>
							<td>{{ (!isset($user->last_login)) ? '---' : $user->last_login }}</td>
							<td>
								{{ (!isset($user->last_login)) ? '<span class="label label-warning">Inactive</span>' : '<span class="label label-success">Active</span>' }}
							</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="6"> <div class="alert alert-warning">No Records Found.</div> </td>
					</tr>
				@endif
			</tbody>
		</table>

	</div>

@stop