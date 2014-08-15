@extends('layout.main')

@section('title', 'Insurance Company: ' . $bima->company )

@section('subnav')
	<div class="subnav navbar-fixed-top">
		<div class="container">
			<h4>@yield('title')</h4>
			
		</div>
	</div>
@stop

@section('content')

		<table class="table">
			<thead>
				<tr>
					<th>Fullnames</th>
					<th>Insurance No.</th>
					<th>Gender</th>
				</tr>
			</thead>
			<tbody>
				@if (isset($bima))
					<tr>
						<td>{{ $bima->first_name . "&nbsp;&nbsp". $bima->last_name}}</td>
						<td>{{ $bima->medical_insurance }}</td>
						<td>{{ ($bima->gender == 0) ? 'Male' : 'Female' }}</td>
					</tr>
				@endif
			</tbody>
		</table>

		<fieldset>
			<legend>Transactions Report</legend>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Transaction ID</th>
							<th>EMR No.</th>
							<th>Total</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@if (isset($transactions) && $transactions->count())
							@foreach ($transactions as $transaction)
								<tr>
									<td>{{ $transaction->id }}</td>
									<td>{{ $transaction->patient_id }}</td>
									<td>{{ $transaction->total }}</td>
									<td>{{ $transaction->created_at }}</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="8"> <div class="alert alert-warning">No Transactions Recorded.</div> </td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>	
		</fieldset>
		
		<!-- <div class="table-responsive"> -->
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Balance</th>
						<th>{{ (isset($bima) ? $bima->balance : "0") }}</th>
					</tr>
				</thead>
				
			</table>
		<!-- </div> -->

@stop