@extends('layout.main')

@section('title', 'Patient Bill ')

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			<div class="pull-right">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{ URL::route('patient-chart-get', $patient->id) }}">Chart</a></li>
					<li><a href="{{ URL::route('registrations-visit-get', $patient->id) }}">Start Visit</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')

	<!-- <div class="table-responsive"> -->
		
		<table class="table">
			<thead>
				<tr>
					<th>{{ "Chart ID - " . $patient->id }}</th>
					<th>{{ $patient->first_name . " " . $patient->last_name}}</th>
					<th>{{ ($patient->gender == 0) ? "Male" : "Female" }}</th>
					<th>{{ $patient->age . " Years" }}</th>
				</tr>
			</thead>
		</table>

	<!-- </div> -->

	<fieldset> 
		<legend>Fixed Charges</legend>
		<div class="table-responsive">
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Title</th>
						<th colspan="2" >Type</th>
						<th style="width:50ems">Price</th>
					</tr>
				</thead>
				<tbody>
					@if (isset($fixed_charges) && $fixed_charges->count())
						@foreach ($fixed_charges as $fixed_charge)
							<tr>
								<td>{{ $fixed_charge->item }}</td>
								<td colspan="2">{{ $fixed_charge->type }}</td>
								<td style="width:50ems">{{ $fixed_charge->price }}</td>
							</tr>
							<tr>
								<td colspan="3" style="font-weight:bold">Fixed Charges Total</td>
								<td style="font-weight:bold">{{ $fixed_charges_total }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6"> <div class="alert alert-warning">No Fixed Charges.</div> </td>
						</tr>
					@endif
				</tbody>
			</table>

		</div>
	</fieldset>

	<fieldset> 
		<legend>Lab Tests</legend>
		<div class="table-responsive">
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Test</th>
						<th>Type</th>
						<th>Price</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@if (isset($test_bills) && $test_bills->count())
						@foreach ($test_bills as $test_bill)
							<tr>
								<td>{{ $test_bill->item }}</td>
								<td>{{ $test_bill->type }}</td>
								<td>{{ $test_bill->price }}</td>
								<td>{{ $test_bill->created_at }}</td>
							</tr>
							<tr>
								<td colspan="3" style="font-weight:bold">Tests Total</td>
								<td style="font-weight:bold">{{ $test_total }}</td>
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

	<fieldset> 
		<legend>Medication</legend>
		<div class="table-responsive">
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Prescription</th>
						<th>Type</th>
						<th>Dosage</th>
						<th>Price</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@if (isset($medication_bills) && $medication_bills->count())
						@foreach ($medication_bills as $medication_bill)
							<tr>
								<td>{{ $medication_bill->item }}</td>
								<td>{{ $medication_bill->type }}</td>
								<td>{{ $medication_bill->dosage }}</td>
								<td>{{ $medication_bill->price }}</td>
								<td>{{ $medication_bill->created_at }}</td>
							</tr>
							<tr>
								<td colspan="4" style="font-weight:bold">Medication Total</td>
								<td style="font-weight:bold">{{ $medication_total }}</td>
							</tr>
						@endforeach
						
					@else
						<tr>
							<td colspan="6"> <div class="alert alert-warning">No Records Found.</div> </td>
						</tr>
					@endif

					<tfoot>
						<tr>
							<td colspan="4" style="font-weight:bold">Gross Total</td>
							<td style="font-weight:bold">{{ $total }}</td>
						</tr>
					</tfoot>

				</tbody>
			</table>

		</div>
	</fieldset>

	<form action="{{ URL::route('create-transaction-post', $patient->id) }}" method="post" class="">
		@if(Session::has('error'))
			<div class="alert alert-danger"> {{ Session::get('error') }} </div>
		@elseif($errors->has())
			<div class="alert alert-danger"> {{ $errors->first() }} </div>
		@endif

		<fieldset>
			<legend>Payment Details</legend>
			<div class="col-md-2">
				<div class="control-group">
					<label for="payment_mode" class="control-label">Payment Mode</label>
					<select name="payment_mode" id="payment_mode" class="form-control">
						<option value="CASH">CASH</option>
						<option value="AON Insurance">AON Insurance</option>
						<option value="NHIF">NHIF</option>
						<option value="JUBILEE Insurance">JUBILEE Insurance</option>
					</select>
				</div>
			</div>
		</fieldset>
		<div class="form-actions">
			{{ Form::submit('Create', array('class' => 'btn btn-primary')) }} or
			{{ HTML::link('/', 'Cancel') }}
		</div>
		{{ Form::token() }}
	</form>


@stop