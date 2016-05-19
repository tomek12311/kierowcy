<?php namespace App\Http\Controllers;



use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

		$this->middleware('auth', ['except' => ['android']]);
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	public function map()
	{
		//generacja seriala
		//dd(Str::quickRandom(4).'-'.Str::quickRandom(4).'-'.Str::quickRandom(4).'-'.Str::quickRandom(4));

		$employees = \App\User::where('company_id', Auth::User()->company_id)->get();

		Mapper::map(52.381128999999990000, 0.470085000000040000, ['marker' => false, 'eventAfterLoad' => 'mapClick()']);

		foreach($employees as $employee){
//			if($employee -> id == '2')
//				break;

//			dd($employee -> coordinates() -> count());
			if($employee -> coordinates() -> count() == 0){
				continue;
			}

			//dd('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|'.$employee -> color);
			Mapper::marker($employee -> pozycja()['szerokosc'],$employee -> pozycja()['dlugosc'],
					[
							'icon'	=> 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|'.$employee -> kolor(),
							'name'	=> 'mapa',
//							'eventClick' => 'my_function('.$employee -> pozycja()['szerokosc'].','.$employee -> pozycja()['dlugosc'].')',
							'eventMouseOver' => 'pokaz_na_mapie('.$employee->id.');',
							'eventMouseOut' => 'usun_z_mapy();',
					]);

			$points = $employee -> coordinates();

			$i = 0;
			$array = [
			];


			foreach($points -> get() as $point){
				$array = array_add(
						$array,
						$i++,
						[
								'latitude' 	=> $point->pozycja()['szerokosc'],
								'longitude' => $point->pozycja()['dlugosc'],
						]
				);
			}
//			dd($employee->kolor());
			Mapper::polyline($array, ['strokeColor' => $employee->color]);
		}


		return view('map');
	}



	public function test(Request $request)
	{
//		if ($request->isJson()) {
//			$data = $request->json()->all();
//		} else {
//			$data = $request->all();
//		}
		dd($request);
	}

	public function android(Request $request)
	{
		$credentials = $request->only('email', 'password');
		$email = $request -> email;
		$password = $request -> password;
//		if ($this->auth->attempt($credentials, $request->has('remember'))) {
//		if ($this->attempt($credentials, false)) {
//			return 'trasdsadue';
//		}
//		return 'false';

		if (Auth::attempt($credentials))
		{
			return 'true;Jan Kowalksi;Kowalski@gmail.com;1';
		}

		return 'false;';

	}

	public function sendmail(){
		Mail::send('emails.email', ['key' => 'value'], function($message)
		{
			$message->to('tomek12311@gmail.com', 'John Smith')->subject('Welcome!');
		});
	}

}
