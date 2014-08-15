<?php 

class HealthController extends BaseController {

	public function home()
	{
		return View::make('health.home');
	}

}