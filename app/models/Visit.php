<?php

class Visit extends \Eloquent {
	protected $fillable = ['patient_id', 'done'];

	public function patients()
	{
		return $this->belongsTo('patients');
	}
}