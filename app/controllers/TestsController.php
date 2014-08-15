<?php

class TestsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /tests
	 *
	 * @return Response
	 */
	public function index()
	{
		$tests = Test::all();

		return View::make('tests.index', compact('tests'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tests/create
	 *
	 * @return Response
	 */
	public function create($id)
	{
		return View::make('tests.create', compact('id'));
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
	 * POST /tests
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$visit = $this->getVisit($id);
		
		if ( is_null($visit) )
		{
			return Redirect::route('patient-chart-get', $id)
							->with('global', 'No visit found, kindly start a new visit for this patient to proceed!');
		}  

		$validator = Validator::make($data = Input::all(), Test::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$data['patient_id'] = $id;
		$data['visit_id']	= $visit->id; 

		Test::create($data);

		return Redirect::route('patient-chart-get', $id)->with('global', 'New test created.');
	}

	/**
	 * Display the specified resource.
	 * GET /tests/{id}
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
	 * GET /tests/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$test = Test::find($id);

		return View::make('tests.edit', compact('test'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tests/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$test = Test::findOrFail($id);
		$validator = Validator::make($data = Input::all(), Test::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		} 

		$test->update($data);

		return Redirect::route('patient-chart-get', $test->patient_id)->with('global', "Test successfully updated");

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tests/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$test = Test::find($id);
		Test::destroy($id);

		return Redirect::route('patient-chart-get', $test->patient_id)->with('global', "Test successfully deleted");
	}

}