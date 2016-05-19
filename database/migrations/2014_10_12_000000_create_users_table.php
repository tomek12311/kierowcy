<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();

			$table	->integer('company_id')
					->unsigned()
					->index();

			$table	->foreign('company_id')
					->references('id')
					->on('companies')
					->onDelete('restrict');

			$table	->integer('permission_id')
					->unsigned()
					->index();

			$table	->foreign('permission_id')
					->references('id')
					->on('permissions')
					->onDelete('restrict');

			//company_id

			$table->string('color');
			$table->string('password', 60);
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
