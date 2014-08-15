<?php

class Patient extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'first_name'		=> 'required|min:2|max:20',
		'last_name'			=> 'required|min:2|max:20',
		'national_id'		=> 'required|min:5',
		'medical_insurance'	=> 'required',
		'gender'			=> 'required',
		'age'				=> 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['first_name', 'last_name', 'national_id', 'medical_insurance', 'gender', 'age'];

	public function visits()
	{
		return $this->hasOne('Visit', 'patient_id');
	}

	public function labs()
	{
		return $this->hasMany('Lab', 'patient_id');
	}

}