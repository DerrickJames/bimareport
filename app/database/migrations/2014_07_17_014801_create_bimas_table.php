<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBimasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bimas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->integer('national_id');
			$table->integer('medical_insurance');
			$table->string('company');
			$table->float('monthly_rate');
			$table->float('balance');
			$table->integer('age');
			$table->boolean('gender');
			$table->string('email');
			$table->integer('phone_number');
			$table->string('location');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bimas');
	}

}
