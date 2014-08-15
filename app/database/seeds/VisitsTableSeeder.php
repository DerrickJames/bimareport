<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VisitsTableSeeder extends Seeder {

	public function run()
	{
		// $faker = Faker::create();

		// foreach(range(1, 10) as $index)
		// {
		// 	Visit::create([

		// 	]);
		// }
		DB::table('visits')->delete();

		$visits = array(
			array(
				'patient_id'	=> 9,
				'done'			=> 1,
				'created_at'	=> '2014-01-01 01:01:01'
			),

			array(
				'patient_id'	=> 10,
				'done'			=> 0,
				'created_at'	=> '2014-01-01 01:01:01'
			)
			
		);

		DB::table('visits')->insert($visits);
	}

}