<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAnAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	public function handle($request, Closure $next)
	{
		dd('ads');
//		return $next($request);
		return new RedirectResponse(url('/home'));
	}

}
