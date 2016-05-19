<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class userController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		return view('user.create') -> with([
			'company_id' => $request -> company_id,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		User::create([
				'name' => $request -> name,
				'email' => $request -> email,
				'password' => bcrypt('temporary'),
				'company_id' => $request -> company_id,
				'color' => $request -> color,
				'permission_id' => $request -> permission,
		]);

		return redirect(action('companyController@show', $request -> company_id));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		$company = Input::get('zmienna', '1');
		try{
			User::find($id)->delete();
			$request->session()->flash('alert-success', 'Operacja się powiodła');
		}catch (\Exception $e){
			$request->session()->flash('alert-danger', 'Operacja się nie powiodła');
		}finally{
			return redirect(action('companyController@show', $company));
		}
	}
}
