@extends('layout.main')

@section('title', 'Billing Management ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{ URL::route('billings-item-get') }}">Items</a></li>
					<li><a href="{{ URL::route('create-item-get') }}">New Item</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')

	<fieldset>
		<legend>Billing Items</legend>

		<div class="table-responsive">
		
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Item</th>
						<th>Type</th>
						<th>Price (Ksh)</th>
						<th>Date Created</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					@if (isset($billings) && $billings->count())
						@foreach ($billings as $billing)
							<tr>
								<td>{{ e($billing->id) }}</td>
								<td><a href="{{ URL::route('item-update-get', $billing->id) }}">
									{{ e($billing->item) }}
								</a></td>
								<td>{{ e($billing->type) }}</td>
								<td>{{ $billing->price }}</td>
								<td>{{ $billing->created_at }}</td>
								<td><a href="{{ URL::route('item-destroy', $billing->id) }}">Delete</a></td>
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
	</fieldset>

@stop