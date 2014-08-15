<?php

use Carbon\Carbon;

class TransactionsController extends \BaseController {

	public function appendURL($data, $prefix)
	{
		foreach ($data as $key => & $item){
			$item['url'] = url($prefix.'/'.$item['id']);
		}
		return $data;
	}

	public function index()
	{
		$query = e(Input::get('q', ''));

		if (!$query && $query == '') return Response::json(array(), 400);

		$patients = Patient::where('first_name', 'like', '%'.$query.'%')
					->orWhere('last_name', 'like', '%'.$query.'%')
					->orderBy('first_name', 'asc')
					->take(5)
					->get(array('id','first_name', 'last_name'))
					->toArray();

		$patients = $this->appendURL($patients, 'transactions');

		return Response::json(array(
			'data' => $patients
		));

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /transactions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('transactions.create');
	}

	/**
	 * Patient helper function
	 *
	 * @return array
	 */
	public function getPatient($id)
	{
		return Patient::findOrFail($id);
	}

	/**
	 * Visit helper function
	 *
	 * @return array
	 */
	public function getVisit($id)
	{
		return Visit::where('patient_id', '=', $id)->where('done', '=', 0)->first();
	}

	/**
	 * Consultation helper function
	 *
	 * @return float
	 */
	public function getFixedCharges()
	{
		return Billing::where('type', '=', 'Fixed Charges')->get();
	}

	/**
	 * Medication bills helper function
	 *
	 * @return array
	 */
	public function getMedicationBills($id)
	{
		return Medication::select('item', 'type', 'price', 'prescription', 'dosage', 'medications.created_at')
						->where('medications.visit_id', '=', $this->getVisit($id)->id)
						->join('billings', 'billings.id', '=', 'prescription')
						->where('medications.patient_id', '=', $id)
						->get();
	}

	/**
	 * Test bills helper function
	 *
	 *@return array
	 */
	public function getTestBills($id)
	{
		return	Test::select('item', 'type', 'price', 'test', 'tests.created_at')
					->where('visit_id', '=', $this->getVisit($id)->id)
					->join('billings', 'billings.id', '=', 'test')
					->where('tests.patient_id', '=', $id)
					->get();
	}

	/**
	 * Fixed charges total helper function
	 *
	 * @return float
	 */
	public function getFixedChargesTotal()
	{
		$fixed_charges 	= $this->getFixedCharges();

		if (isset($fixed_charges) && $fixed_charges->count())
		{
			foreach ($fixed_charges as $fixed_charge) 
			{
				$fixed_charges_total = $fixed_charge->price;
				$fixed_charges_total =+ $fixed_charges_total;
			}

			return $fixed_charges_total;	
		}  
	}

	/**
	 * Medication total helper function
	 *
	 * @return float
	 */
	public function getMedicationTotal($id)
	{
		$medication_bills 	= $this->getMedicationBills($id);

		if (isset($medication_bills) && $medication_bills->count())
		{
			foreach ($medication_bills as $medication_bill) 
			{
				$medication_total = $medication_bill->price;
				$medication_total =+ $medication_total;
			}

			return $medication_total;	
		}  
	}

	/**
	 * Test total helper function
	 *
	 * @return float
	 */
	public function getTestTotal($id)
	{
		$test_bills		= $this->getTestBills($id);

		if (isset($test_bills) && $test_bills->count())
		{
			foreach ($test_bills as $test_bill)
			{
				$test_total = $test_bill->price;
				$test_total	=+ $test_total;
			}

			return $test_total;
		}  
	}

	/**
	 * Total helper function
	 *
	 * @return float
	 */
	public function getTotal($id)
	{
		$fixed_charges_total	= $this->getFixedChargesTotal();
		$test_total				= $this->getTestTotal($id);
		$medication_total 		= $this->getMedicationTotal($id);

		$total = $test_total + $medication_total + $fixed_charges_total;

		return $total;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /transactions
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$visit 		= $this->getVisit($id);
		if ( ! isset($visit) || $visit->done != 0 )
		{
			return Redirect::back()->with('global', 'Bill already settled or No Pending Bills!');
		}
		$data = [
			'patient_id'	=> $id,
			'visit_id'		=> $visit->id,
			'total'			=> $this->getTotal($id),
			'payment_mode'  => Input::get('payment_mode')  
		];

		$validator = Validator::make($data, Transaction::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}  

		if ($trans = Transaction::create($data))
		{
			$bima = Bima::where('company', '=', $trans->payment_mode)
						->where('medical_insurance', '=', $this->getPatient($id)->medical_insurance)
						->first();

			if ($bima)
			{
				$bima_balance = $bima->balance;

				if($bima_balance < 0 && $bima_balance < $trans['total'] )
				{
					return Redirect::back()->with('global', 'You have an insufficient account to make this transaction!');
				} 
				else 
				{
					$balance	= $bima_balance - $trans['total'];
					$bima->balance 	= $balance;
					$bima->save();
				} 	
			}			
			
			$visit = $this->getVisit($id);

			$visit->done = 1;
			$visit->save();

			return Redirect::route('transaction-create-get')
							->with('global', 'Bill successfully settled with ' . $trans->payment_mode);
		} 

		return Redirect::route('transaction-create-get')->with('global', 'Error, please try again!'); 
	}

	/**
	 * Display the specified resource.
	 * GET /transactions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$patient 			= $this->getPatient($id);
		$visit				= $this->getVisit($id);
		$fixed_charges		= $this->getFixedCharges();
		$fixed_charges_total= $this->getFixedChargesTotal();
		$medication_bills	= $this->getMedicationBills($id);
		$test_bills			= $this->getTestBills($id);
		$medication_total	= $this->getMedicationTotal($id);
		$test_total			= $this->getTestTotal($id);
		$total 				= $this->getTotal($id);
		
		return View::make('transactions.show', compact(
			'medication_bills', 'test_bills', 'patient', 'test_total',
			'medication_total', 'total', 'fixed_charges', 'fixed_charges_total'
		));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /transactions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /transactions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /transactions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}