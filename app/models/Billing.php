<?php

class Billing extends \Eloquent {
	protected $fillable = ['item', 'type', 'price'];

	public static $rules = [
		'item'	=> 'required',
		'type'	=> 'required',
		'price'	=> 'required|numeric'
	];
}