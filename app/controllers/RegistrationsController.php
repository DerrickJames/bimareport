<?php

class RegistrationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /registrations
	 *
	 * @return Response
	 */
	public function index()
	{
		$visits = DB::table('patients')
							->join('visits', 'patients.id', '=', 'visits.patient_id')
							->orderBy('patients.id', 'desc')
							->get();

			$sample = array('name' => 'Ricky', 'user' => 'James');

		return View::make('registrations.index', compact('visits', 'sample'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /registrations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /registrations
	 *
	 * @return Response
	 */
	public function store(Patient $patient)
	{
		$visits = Visit::where('patient_id', '=', $patient->id)->get();

		if (isset($visits) && $visits->count())
		{
			foreach ($visits as $visit) 
			{
				if ($visit->done == 1)
				{
					$visit = [
						'patient_id'	=> $patient->id,
						'done'			=> 0
					];

					Visit::create($visit);

					return Redirect::route('patient-chart-get', $patient->id)->with('global', "New Visit Started");
				}  
				elseif ($visit->done == 0)
				{
					return Redirect::route('patient-chart-get', $patient->id)->with('global', "Visit in progress");
				}
			}
		} 

		$visit = [
			'patient_id'	=> $patient->id,
			'done'			=> 0
		];

		Visit::create($visit);

		return Redirect::route('patient-chart-get', $patient->id)->with('global', "New Visit Started");
	}

	/**
	 * Display the specified resource.
	 * GET /registrations/{id}
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
	 * GET /registrations/{id}/edit
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
	 * PUT /registrations/{id}
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
	 * DELETE /registrations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}