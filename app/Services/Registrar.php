<?php namespace App\Services;

use App\User;
use Illuminate\Support\Facades\App;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$company = \App\company::create([
			'name' => $data['company_name'],
		]);

		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
//			'company_id' => $data['company_id'],
			'company_id' => $company -> id,
			'color' => '#000000',
			'permission_id' => '2',
//			'color' => $data['color'],
		]);
	}

}
