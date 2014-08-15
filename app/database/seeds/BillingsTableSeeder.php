<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class BillingsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('billings')->delete();

		$billings = [
			[
				'item'	=> 'Consultation Fee',
				'type'	=> 'Consultation',
				'price'	=> 200
			],
			[
				'item'	=> 'VCT',
				'type'	=> 'Laboratory',
				'price'	=> 100
			],
			[
				'item'	=> 'Malaraquin',
				'type'	=> 'Medication',
				'price'	=> 200
			],
			[
				'item'	=> 'Pregnancy Test',
				'type'	=> 'Laboratory',
				'price'	=> 100
			],
			[
				'item'	=> 'ARV',
				'type'	=> 'Medication',
				'price'	=> 0
			]
		];

		DB::table('billings')->insert($billings);
	}

}