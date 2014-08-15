<?php 
namespace Api;

use BaseController;
use Patient;
use Input;
use Response;

class ApiSearchController extends BaseController
{
	public function appendURL($data, $prefix)
	{
		foreach ($data as $key => & $item){
			$item['url'] = url($prefix.'/'.$item['id']);
		}
		return $data;
	}

	public function index()
	{
		$query = e(Input::get('q', ''));

		if (!$query && $query == '') return Response::json(array(), 400);

		$patients = Patient::where('first_name', 'like', '%'.$query.'%')
					->orWhere('last_name', 'like', '%'.$query.'%')
					->orderBy('first_name', 'asc')
					->take(5)
					->get(array('id','first_name', 'last_name'))
					->toArray();

		$patients = $this->appendURL($patients, 'patient');

		return Response::json(array(
			'data' => $patients
		));

	}
}