<?php

class BimasController extends \BaseController {

	/**
	 * Display a listing of bimas
	 *
	 * @return Response
	 */
	public function index()
	{
		$bimas = Bima::all();

		return View::make('bimas.index', compact('bimas'));
	}

	/**
	 * Show the form for creating a new bima
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('bimas.create');
	}

	/**
	 * Store a newly created bima in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator 	= Validator::make($data = Input::all(), Bima::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if (Bima::create($data))
		{
			$bima = Bima::where('medical_insurance', '=', $data['medical_insurance'])->first();

			$bima->balance 	= $data['monthly_rate'];
			$bima->save();
		}

		return Redirect::route('bimas-get')->with('global', 'Client Created Successfully');
	}

	/**
	 * Display the specified bima.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$bima = Bima::findOrFail($id);
		$transactions = Transaction::select('transactions.id', 'transactions.patient_id', 'total', 'transactions.created_at')
									->join('patients', 'patients.id', '=', 'transactions.patient_id')
									->where('payment_mode', '=', $bima->company)
									->get();

		return View::make('bimas.show', compact('bima', 'transactions'));
	}

	/**
	 * Show the form for editing the specified bima.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$bima = Bima::find($id);

		return View::make('bimas.edit', compact('bima'));
	}

	/**
	 * Update the specified bima in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$bima = Bima::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Bima::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if ($bima->update($data))
		{
			$bima->balance = $bima->balance + $data['monthly_rate'];
			$bima->save();
		}  

		return Redirect::route('bimas-get')->with('global', 'Client Updated Successfully');
	}

	/**
	 * Remove the specified bima from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Bima $bima)
	{
		Bima::destroy($bima->id);

		return Redirect::route('bimas-get')->with('global', 'Client Deleted Successfully');
	}

}
