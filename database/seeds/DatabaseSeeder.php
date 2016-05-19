<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		DB::table('companies')->insert([
				'name' => 'System',
		]);

		DB::table('permissions')->insert([
				'Opis' => 'Administrator_systemu',
		]);

		DB::table('permissions')->insert([
				'Opis' => 'Administrator_firmy',
		]);

		DB::table('permissions')->insert([
				'Opis' => 'Dyspozytor',
		]);

		DB::table('permissions')->insert([
				'Opis' => 'Pracownik',
		]);

		DB::table('users')->insert([
				'name' => 'tomek',
				'email' => 'tomek@gmail.com',
				'password' => bcrypt('zpffzp3d'),
				'company_id' => '1',
				'permission_id' => '1',
				'color'	=>	'#4b32dc',
		]);

		DB::table('users')->insert([
				'name' => 'tmp',
				'email' => 'tmp@gmail.com',
				'password' => bcrypt('zpffzp3d'),
				'company_id' => '1',
				'permission_id' => '2',
				'color'	=>	'#D93E0F',
		]);

		DB::table('users')->insert([
				'name' => 'tmp2',
				'email' => 'tmp2@gmail.com',
				'password' => bcrypt('zpffzp3d'),
				'company_id' => '1',
				'permission_id' => '3',
				'color'	=>	'#ff00aa',
		]);

		DB::table('coordinates')->insert([
				'szerokosc' => '52.381128999999990000',
				'dlugosc' => '0.470085000000040000',
				'user_id' => '1',
				'czas' => '2016-03-03 06:26:37',
		]);

		DB::table('coordinates')->insert([
				'szerokosc' => '53.381128999999990000',
				'dlugosc' => '-1.470085000000040000',
				'user_id' => '1',
				'czas' => '2016-03-03 06:26:37',
		]);

		DB::table('coordinates')->insert([
				'szerokosc' => '53.381128999999990000',
				'dlugosc' => '-0.470085000000040000',
				'user_id' => '1',
				'czas' => '2016-03-03 06:26:37',
		]);

		DB::table('coordinates')->insert([
				'szerokosc' => '52.381128999999990000',
				'dlugosc' => '-1.470085000000040000',
				'user_id' => '2',
				'czas' => '2016-03-03 06:26:37',
		]);

		DB::table('coordinates')->insert([
				'szerokosc' => '53.381128999999990000',
				'dlugosc' => '-0.110085000000040000',
				'user_id' => '2',
				'czas' => '2016-03-03 06:26:37',
		]);


		// $this->call('UserTableSeeder');
	}

}
