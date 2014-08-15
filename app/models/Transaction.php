<?php

class Transaction extends \Eloquent {
	protected $fillable = ['patient_id', 'visit_id', 'total', 'payment_mode'];

	public static $rules = [
		'payment_mode'	=> 'required'
	];
}