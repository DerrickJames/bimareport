<?php

class Test extends \Eloquent {
	protected $fillable = ['test', 'result', 'diagnosis', 'patient_id', 'visit_id'];

	public static $rules = [
		'test'			=> 'required',
		// 'patient_id'	=> 'required' 
	];
}