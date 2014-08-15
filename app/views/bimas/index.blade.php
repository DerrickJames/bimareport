@extends('layout.main')

@section('title', 'Client Management ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{ URL::route('bimas-get') }}">Clients</a></li>
					<li><a href="{{ URL::route('create-client-get') }}">New Client</a></li>
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
					<th>Fullnames</th>
					<th>National ID</th>
					<th>Medical Insurance</th>
					<th>Company</th>
					<th>Monthly Rate</th>
					<th>Balance</th>
					<th>Gender</th>
					<th>Age</th>
					<th>Email</th>
					<th>Phone Number</th>
					<th>Location</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@if (isset($bimas) && $bimas->count())
					@foreach ($bimas as $bima)
						<tr>
							<td><a href="{{ URL::route('client-get', $bima->id) }}">{{ $bima->first_name . "&nbsp;&nbsp". $bima->last_name}}</a></td>
							<td>{{ $bima->national_id }}</td>
							<td>{{ $bima->medical_insurance }}</td>
							<td>{{ $bima->company }}</td>
							<td>{{ $bima->monthly_rate }}</td>
							<td>{{ $bima->balance }}</td>
							<td>{{ ($bima->gender == 0) ? 'Male' : 'Female' }}</td>
							<td>{{ $bima->age }}</td>
							<td>{{ $bima->email }}</td>
							<td>{{ $bima->phone_number }}</td>
							<td>{{ $bima->location }}</td>
							<td><a href="{{ URL::route('client-update-get', $bima->id) }}">Edit</a></td>
							<td><a href="{{ URL::route('client-destroy', $bima->id) }}">Delete</a></td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="12"> <div class="alert alert-warning">No Records Found.</div> </td>
					</tr>
				@endif
			</tbody>
		</table>

	</div>

@stop