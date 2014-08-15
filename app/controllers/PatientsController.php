<?php

class PatientsController extends \BaseController {

	/**
	 * Display a listing of patients
	 *
	 * @return Response
	 */
	public function index()
	{
		$patients = Patient::all();

		return View::make('patients.index', compact('patients'));
	}

	/**
	 * Show the form for creating a new patient
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('patients.create');
	}

	/**
	 * Store a newly created patient in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Patient::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$patient = Patient::create($data);

		return Redirect::route('patient-chart-get', $patient->id)->with('global', 'New patient created.');
	}

	/**
	 * Display the specified patient.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$patient 		= Patient::findOrFail($id);
		$tests			= Test::select('tests.id', 'test', 'result', 'diagnosis', 'tests.created_at', 'item')
										->where('patient_id', '=', $id)
										->join('billings', 'billings.id', '=', 'tests.test')
										->get();
		$medications 	= Medication::select('medications.id', 'prescription', 'dosage', 'start_date', 'end_date', 'item')
										->where('patient_id', '=', $id)
										->join('billings', 'billings.id', '=', 'medications.prescription')
										->get();

		$visit			= Visit::where('patient_id', '=', $id)->first();

		return View::make('patients.show', compact('patient', 'tests', 'medications', 'visit'));
	}

	/**
	 * Show the form for editing the specified patient.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$patient = Patient::find($id);

		return View::make('patients.edit', compact('patient'));
	}

	/**
	 * Update the specified patient in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$patient 	= Patient::findOrFail($id);

		$validator 	= Validator::make($data = Input::all(), Patient::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$patient->update($data);

		return Redirect::route('patients-get')->with('global', 'Patient has been updated.');
	}

	/**
	 * Remove the specified patient from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Patient::destroy($id);

		return Redirect::route('patients-get')->with('global', 'Patient has been deleted.');
	}

}//end PatientsController.php
