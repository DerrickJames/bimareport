@extends('layout.main')

@section('title', 'Manage User Roles')

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

	<p class="intro">Roles allow you to define the abilities of a user.</p>
	<div class="table-responsive">

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@if (isset($groups) && is_array($groups))
					@foreach ($groups as $group)
						<tr>
							<td><a href="{{ URL::route('edit-roles', $group->id) }}">{{ $group->name }}</a></td>
							<td>{{ $group->description }}</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="2"> <div class="alert alert-warning">No Roles Found.</div> </td>
					</tr>
				@endif
			</tbody>
		</table>

	</div>

@stop