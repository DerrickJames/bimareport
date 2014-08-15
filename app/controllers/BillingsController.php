<?php

class BillingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /billings
	 *
	 * @return Response
	 */
	public function index()
	{
		$billings = Billing::all();

		return View::make('billings.index', compact('billings'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /billings/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('billings.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /billings
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Billing::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		} 

		Billing::create($data);

		return Redirect::route('billings-item-get')->with('global', 'Item successfully created!');

	}

	/**
	 * Display the specified resource.
	 * GET /billings/{id}
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
	 * GET /billings/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$billing = Billing::find($id);

		return View::make('billings.edit', compact('billing'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /billings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$billing 	= Billing::findOrFail($id);

		$validator 	= Validator::make($data = Input::all(), Billing::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}  

		$billing->update($data);

		return Redirect::route('billings-item-get')->with('global', 'Item successfully updated');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /billings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Billing $billing)
	{
		$billing->delete();

		return Redirect::route('billings-item-get')->with('global', 'Item deleted successfully');
	}

}