<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('patient_id');
			$table->integer('visit_id');
			$table->integer('prescription');
			$table->string('dosage');
			$table->datetime('start_date');
			$table->datetime('end_date');
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
		Schema::drop('medications');
	}

}
