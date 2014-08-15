<?php

class MedicationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /medications
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /medications/create
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$test_items 		= Billing::select('id', 'item')->where('type', '=', 'Laboratory Test')->get();
		$prescription_items	= Billing::select('id', 'item')->where('type', '=', 'Medication')->get();

		return View::make('medications.create', compact('id', 'test_items', 'prescription_items'));
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
	 * Store a newly created resource in storage.
	 * POST /medications
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$visit = $this->getVisit($id);

		if (is_null($visit))
		{
			return Redirect::route('patient-chart-get', $id)
							->with('global', 'No visit found, kindly start a new visit for this patient to proceed!');
		}

		$validator = Validator::make($data = Input::all(), Medication::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		} 

		$data['patient_id']	= $id;
		$data['visit_id']	= $this->getVisit($id)->id;

		Medication::create($data);

		return Redirect::route('patient-chart-get', $id)->with('global', "Medication Administered!");
	}

	/**
	 * Display the specified resource.
	 * GET /medications/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /medications/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$test_items 			= Billing::select('id', 'item')->where('type', '=', 'Laboratory Test')->get();
		$prescription_items		= Billing::select('id', 'item')->where('type', '=', 'Medication')->get();
		$medication 			= Medication::find($id);
		$test					= Test::find($id);

		return View::make('medications.edit', compact('medication', 'test_items', 'prescription_items', 'test'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /medications/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$medication = Medication::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Medication::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		} 	

		$medication->update($data);

		return Redirect::route('patient-chart-get', $medication->patient_id)->with('global', "Medication successfully updated");
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /medications/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$medication = Medication::find($id);
		
		Medication::destroy($id);

		return Redirect::route('patient-chart-get', $medication->patient_id)->with('global', "Medication record deleted successfully");
	}

}