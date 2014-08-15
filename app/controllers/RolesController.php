<?php

class RolesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /roles
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = Sentry::findAllGroups();

		return View::make('roles.index', compact('groups'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /roles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /roles
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),
			array(
				'name'			=> 'required|max:20|min:2',
				'description'	=> 'max:255'
			)
		);

		if ($validator->fails())
		{
			return Redirect::route('create-roles')
					->withErrors($validator)
					->withInput();
		} 
		else
		{
			try 
			{
				$group = Sentry::createGroup(array(
						'name'	=> Input::get('name'),
						'description'	=> Input::get('description')	
					)
				);		

				if ($group)
				{
					return Redirect::route('roles')
							->with('global', 'A new Role has been created.');
				}  
			} 
			catch (\Exception $e) 
			{
				return Redirect::route('create-roles')->with('error', $e->getMessage());
			}
		} 
	}// end store()

	/**
	 * Display the specified resource.
	 * GET /roles/{id}
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
	 * GET /roles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$group = Sentry::findGroupById($id);

		return View::make('roles.edit', compact('group'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(),
			array(
				'name'			=> 'required|max:20|min:2',
				'description'	=> 'max:255'
			)
		);

		if ($validator->fails())
		{
			return Redirect::route('create-roles')
					->withErrors($validator)
					->withInput();
		}
		else
		{
			try 
			{
				$group = Sentry::findGroupById($id);

				$permissions = array(
					'create'	=> ((Input::get('create') == 1) ? 1 : 0),
					'view'		=> ((Input::get('view') == 1) ? 1 : 0),
					'update'	=> ((Input::get('update') == 1) ? 1 : 0),
					'delete'	=> ((Input::get('delete') == 1) ? 1 : 0)
				);

				$group->name 		= Input::get('name');
				$group->description = Input::get('description');
				$group->permissions	= $permissions;

				if ($group->save())
				{
					return Redirect::route('roles')
							->with('global', 'The role has been updated.');
				}  
			} 
			catch (\Exception $e) 
			{
				return Redirect::route('edit-roles')->with('error', $e->getMessage());
			}			
		} 
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try 
		{
			$group = Sentry::findGroupById($id);

			if ($group->delete())
			{
				return Redirect::route('roles')
						->with('global', 'The role has been deleted.');
			}  
		} 
		catch (\Exception $e) 
		{
			return Redirect::route('edit-roles')->with('error', $e->getMessage());
		}
	}
}