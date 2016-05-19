<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class administrator_systemu {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Auth::User() -> permission == 1)
			return $next($request);

		else
			return redirect()->route('company_management');
	}

}
