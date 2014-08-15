<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class TestsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tests')->delete();

		$tests = array(
			[
				'item_id'			=> 1,
				'result'			=> 95.5,
				'diagnosis'			=> 'Diabetes',
				'patient_id'		=> 9,
				'created_at'		=> '2014-01-01 01:01:01',
				'updated_at'		=> '2014-01-01 01:01:01'
			],
			[
				'item_id'			=> 2,
				'result'			=> 95.5,
				'diagnosis'			=> 'Diabetes',
				'patient_id'		=> 10,
				'created_at'		=> '2014-01-01 01:01:01',
				'updated_at'		=> '2014-01-01 01:01:01'
			]
		);
			
		DB::table('tests')->insert($tests);
	}

}