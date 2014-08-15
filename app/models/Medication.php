<?php

class Medication extends \Eloquent {
	protected $fillable = ['prescription', 'dosage', 'start_date', 'end_date', 'patient_id', 'visit_id'];

	public static $rules = [
		'prescription'	=> 'required',
		'dosage'		=> 'required',
		'start_date'	=> 'required',
		'end_date'		=> 'required'
	];
}