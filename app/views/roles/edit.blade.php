@extends('layout.main')

@section('title', 'Edit Role : ' . $group->name)

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

	{{ Form::model($group, array('method' => 'PUT', 'route' => array('roles-update', $group->id))) }}
		@if(Session::has('error'))
			<div class="alert alert-danger"> {{ Session::get('error') }} </div>
		@elseif($errors->has())
			<div class="alert alert-danger"> {{ $errors->first() }} </div>
		@endif

		<fieldset>
			<legend>Role Details</legend>
			<div class="col-md-6">
				<div class="control-group">
					{{ Form::label('name', 'Role Name', array('class' => 'control-label')) }}
					{{ Form::text('name', $group->name, array('id' => 'name', 'class' => 'form-control')) }}
				</div>
				<div class="control-group">
					{{ Form::label('description', 'Description', array('class' => 'control-label')) }}
					{{ Form::textarea('description', $group->description, array('id' => 'description', 'class' => 'form-control', 'cols' => 10, 'rows' => 4) ) }}
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Permissions</legend>
			<p class="intro">Check all the permissions that apply to this role.</p>
			<div class="table-responsive">

				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Permissions</th>
							<th>Create</th>
							<th>View</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>General</td>
							<td>{{ Form::checkbox('create', 1, (array_get($group->permissions, 'create')) ? 1 : 0) }}</td>
							<td>{{ Form::checkbox('view', 1, (array_get($group->permissions, 'view')) ? 1 : 0) }}</td>
							<td>{{ Form::checkbox('update', 1, (array_get($group->permissions, 'update')) ? 1 : 0) }}</td>
							<td>{{ Form::checkbox('delete', 1, (array_get($group->permissions, 'delete')) ? 1 : 0) }}</td>
						</tr>
					</tbody>
				</table>

			</div>
		</fieldset>
		<div class="form-actions">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }} or
			{{ HTML::link('/', 'Cancel') }}
			{{ HTML::link(URL::route('roles-destroy', $group->id), 'Delete Role', array('class' => 'btn btn-danger')) }}
		</div>
		{{ Form::token() }}
	{{ Form::close() }}

@stop