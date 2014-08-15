<?php

class Bima extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'first_name'		=> 'required',
		'last_name'			=> 'required',
		'national_id'		=> 'required|numeric|min:5',
		'medical_insurance'	=> 'required',
		'company'			=> 'required',
		'monthly_rate'		=> 'required|numeric',
		'age'				=> 'required|max:3',
		'gender'			=> 'required',
		'email'				=> 'required|email',
		'phone_number'		=> 'required|numeric|min:5',
		'location'			=> 'required|alpha_num',
	];

	// Don't forget to fill this array
	protected $fillable = [
		'first_name', 'last_name', 'national_id', 
		'medical_insurance', 'company', 'monthly_rate', 'balance', 
		'age', 'gender', 'email', 'phone_number', 'location'
	];

}