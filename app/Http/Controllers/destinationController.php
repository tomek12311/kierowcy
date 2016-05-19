<?php namespace App\Http\Controllers;

use App\destination;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class destinationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return "dziala #phpMasterrace";
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
	public function store(Request $request)
	{
		$order = User::find($request -> user_id) -> lastdestinationorder();

		//dd($request -> dlugosc);
		destination::create([
			'user_id' => $request->user_id,
			'dlugosc' => $request -> dlugosc,
			'szerokosc' => $request -> szerokosc,
			'order' => $order,
		]);
		return redirect(action('HomeController@map'));
	}

	public function sort(Request $request){
		$ids = $request->get('id');

		$i = 0;
		foreach($ids as $id){
			$tmp = destination::find($id);
//				dd($tmp);
			$tmp -> order = $i++;
			$tmp -> save();
			//dd($tmp);
		}

		return $request->get('id');

//		DB::transaction(function($ids) use($ids)
//		{
//			$i = 0;
//			foreach($ids as $id){
//				$tmp = destination::find($id);
////				dd($tmp);
//
//				$tmp->order = $i++;
//				$tmp -> save();
//
//
//			}
//
//
//		});

	}

	public function getPunktyAndroid(Request $request){
		$id = $request->id;

		$punkty = User::find($id)->destinations()->get()->sortby('order');
		$response = '';

		foreach($punkty as $punkt){
			$response = $response.$punkt->id.';'.$punkt->dlugosc.';'.$punkt->szerokosc.';opis'.'|';
		}

		return($response);
	}

	public function getPunkty(Request $request){
		$id = $request->id;

		$punkty = User::find($id)->destinations()->get()->sortby('order');
		$response = '';

		foreach($punkty as $punkt){
			$response = $response.$punkt->dlugosc.';'.$punkt->szerokosc.'|';
		}

		return($response);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cele = User::find($id)->destinations()->get()->sortby('order')->all();

		$body = '';
		$i=0;
		foreach($cele as $cel){
			//$linia = '<li id="id_'.$cel->id.'" class="ui-state-default"><b>'.$cel->order.' '.$cel -> id.'</b> '.$cel -> szerokosc.' '.$cel -> dlugosc.'</li>';

//			$linia = '<li id="id_'.$cel->id.'" class="ui-state-default"><b>'.$cel -> szerokosc.' '.$cel -> dlugosc.'</li>';

			$linia = '<li id="id_'.$cel->id.'" class="ui-state-default"><b>Punkt numer '.$cel -> order.'</li>';

			$body = $body . $linia;
		}

		//dd($body);
		$response = '<ul id="sortable">'.$body.'</ul>';

		//dd($response);
		return $response;
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
	public function destroy($id)
	{
		//
	}

}
