<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PatientsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('patients')->delete();

		$patients = array(
			array(
				'created_at'	=> '2014-01-01 01:01:01',
				'updated_at'	=> '2014-01-01 01:01:01',
				'first_name'	=> 'Derrick',
				'last_name'		=> 'James',
				'gender'		=> 0,
				'age'			=> 22
			),

			array(
				'created_at'	=> '2014-01-01 01:01:01',
				'updated_at'	=> '2014-01-01 01:01:01',
				'first_name'	=> 'Amy',
				'last_name'		=> 'Acker',
				'gender'		=> 0,
				'age'			=> 22
			),
			array(
				'created_at'	=> '2014-01-01 01:01:01',
				'updated_at'	=> '2014-01-01 01:01:01',
				'first_name'	=> 'Army',
				'last_name'		=> 'Naa',
				'gender'		=> 0,
				'age'			=> 22
			)
			
		);

		DB::table('patients')->insert($patients);
	}

}