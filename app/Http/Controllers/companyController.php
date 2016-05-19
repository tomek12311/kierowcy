<?php namespace App\Http\Controllers;

use App\company;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class companyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('administrator_systemu', ['except' => ['show']]);
	}

	public function index($zmienna = false)
	{
		$companies = \App\company::all();
		return view('companies/index') -> with([
			'items'	=>	$companies,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = \App\company::find($id);
		$users = $company -> users() -> get();

		return view('user/index') -> with([
				'items'	=>	$users,
				'company'	=> $company,
		]);
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
		try{
			company::find($id)->delete();
			$request->session()->flash('alert-success', 'Operacja się powiodła');
		}catch (\Exception $e){
			$request->session()->flash('alert-danger', 'Operacja się nie powiodła');
		}finally{
			return $this->index();
		}
	}

}