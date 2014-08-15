<?php

class AccountController extends BaseController 
{
	/**
	 * Show the form for creating a new staff user
	 * 
	 * @return response
	 */
	public function getCreate()
	{
		return View::make('account.create');
	}

	/**
	 * Store a newly created staff user
	 *
	 * @return response
	 */
	public function postCreate()
	{
		$validator = Validator::make(Input::all(),
			array(
				'first_name'		=> 'required|min:2',
				'last_name'			=> 'required|min:2',
				'email'				=> 'required|email|max:50|unique:users',
				'password'			=> 'required|min:6',
				'confirm_password'	=> 'required|same:password'
			)
		);

		if ($validator->fails())
		{
			return Redirect::route('account-create')
					->withErrors($validator)
					->withInput();
		} 
		else
		{
			try 
			{
				$user = Sentry::createUser(array(
					'first_name'	=>	Input::get('first_name'),
					'last_name'		=>	Input::get('last_name'),
					'email'			=>	Input::get('email'),
					'password'		=>	Input::get('password'),
					'activated'		=>	true
				));	

				if ($user)
				{
					$staffGroup = Sentry::findGroupById(3);
					$user->addGroup($staffGroup);

					return Redirect::route('users')
							->with('global', 'New ' . $staffGroup->name . ' has been created!');
				}  
			} 
			catch (\Exception $e)
			{
				return Redirect::route('account-create')->with('error', $e->getMessage())->withInput();
			}
			
		} 
	}

	/**
	 * Show the form for registering a new member
	 *
	 * @return response
	 **/
	public	function getRegister()
	{
		return View::make('account.register');
	}

	/**
	 * Store a newly registered member
	 *
	 * @return response
	 **/
	public function postRegister()
	{
		$validator = Validator::make(Input::all(),
			array(
				'first_name'		=> 'required|min:2',
				'last_name'			=> 'required|min:2',
				'membership_no' 	=> 'required',
				'email'				=> 'required|email|max:50|unique:users',
				'password'			=> 'required|min:6',
				'confirm_password'	=> 'required|same:password'
			)
		);

		if ($validator->fails())
		{
			return Redirect::route('account-register')
					->withErrors($validator)
					->withInput();
		}
		else
		{
			try 
			{
				$user = Sentry::createUser(array(
					'first_name'		=>	Input::get('first_name'),
					'last_name'			=>	Input::get('last_name'),
					'membership_no'		=>	Input::get('membership_no'),
					'email'				=>	Input::get('email'),
					'password'			=>	Input::get('password'),
					'activated'			=> 	true
				));

				if ($user)
				{
					$userGroup = Sentry::findGroupById(2);
					$user->addGroup($userGroup);

					return Redirect::route('home')
							->with('global', 'A new '. $userGroup->name .' has been created!');
				}	
			} 
			catch (\Exception $e) 
			{
				return Redirect('account-register')->with('error', $e->getMessage()); 
			}
		}  
	}

	/** 
	 * Show the login form
	 *
	 * @return response
	 */
	public function getLogin()
	{
		return View::make('account.login');
	}

	/**
	 * Authenticate a user
	 * 
	 * @return response
	 */
	public function postLogin()
	{
		$validator = Validator::make(Input::all(),
			array(
				'email' 	=> 'required|email',
				'password'	=> 'required'
			)	
		);

		if ($validator->fails())
		{
			return Redirect::route('account-log-in')
					->withErrors($validator)
					->withInput();
		}
		else
		{
			try 
			{
				$credentials = array(
					'email'		=>	Input::get('email'),
					'password'	=>	Input::get('password')
				);

				$user = Sentry::authenticate($credentials, false);

				if ($user)
				{
					$userGroup = Sentry::findGroupByName('User');
					if ($user->inGroup($userGroup))
					{
						$bima	= Bima::select('id')
										->where('medical_insurance', '=', $user->membership_no)
										->first();

						return Redirect::route('client-get', $bima->id);
					}
					else
					{
						return Redirect::route('health');
					}  
				}  

			} 
			catch (\Exception $e) 
			{
				return Redirect::route('account-log-in')->with('error', $e->getMessage());
			}
		}  
	}

	/**
	 * Ends a user session
	 *
	 * @return response
	 **/
	public function getLogOut()
	{
		Sentry::logout();
		return Redirect::route('home');
	}

	/**
	 * Displays all users
	 *
	 * @return response
	 **/
	public function getUsers()
	{
		$users = Sentry::findAllUsers();

		return View::make('account.users', compact('users'));
	}

	/**
	 * Display the form to update a user
	 *
	 * @return response
	 */
	public function edit($id)
	{
		$user 	= Sentry::findUserById($id);

		return View::make('account.edit', compact('user'));
	}

	/**
	 * Update a user
	 *
	 * @return response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(),
			array(
				'first_name'		=> 'required|min:2',
				'last_name'			=> 'required|min:2',
				'email'				=> 'required|email|max:50',
				'password'			=> 'required|min:6',
				'confirm_password'	=> 'required|same:password'
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			try
			{
				$user = Sentry::findUserById($id);

				$user->first_name		= Input::get('first_name');
				$user->last_name		= Input::get('last_name');
				$user->membership_no	= Input::get('membership_no');
				$user->email 			= Input::get('email');
				$user->password 		= Input::get('password');

				if ($user->save())
				{
					return Redirect::route('users')->with('global', "User '" . $user->first_name . "' has been updated!");
				} 
			}
			catch (\Exception $e)
			{
				return Redirect::back()->with('error', $e->getMessage());
			}
		}  
		
	}


}// End AccountController.php