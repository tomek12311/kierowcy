<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'company_id', 'permission_id', 'color'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function isAnEmployee(){
		if($this->permission_id==4)
			return true;
		else
			return false;
	}

	public function isACompanyAdmin(){
		if($this->permission_id==2)
			return true;
		else
			return false;
	}

	public function company(){
		return $this->belongsTo('App\company');
	}

	/*public function permission(){
		return $this->belongsTo('App\company');
	}*/

	public function coordinates(){
		return $this->hasMany('App\coordinate');
	}

	public function destinations(){
		return $this->hasMany('App\destination');
	}

//	public function nextdestination(){
//		$cele = $this->destinations();
//
//		$next = null;
//
//		foreach($cele as $cel){
//			$next = $cel;
//			if($cel -> order == 0)
//				break;
//		}
//
//		return $next;
//	}

	public function lastdestinationorder(){
		$cele = $this->destinations() -> get() -> all();

		$order = -1;
		$next = 0;

		foreach($cele as $cel){
			$next+=1;
			if($cel -> order >= $order)
				$order = $cel -> order;
		}
		//if($order != 0)
			$order = $order + 1;
		return $order;
	}

//	przeladowane funkcje???
//	public function coordinates($od_kiedy){
//		return $this->hasMany('App\coordinate');
//	}
//
//	public function coordinates($od_kiedy, $do_kiedy){
//		return $this->hasMany('App\coordinate');
//	}

	public function pozycja(){
		$wsp = $this->coordinates()->get() -> last();

		$tab = [
			'szerokosc' => $wsp -> szerokosc,
			'dlugosc'	=> $wsp -> dlugosc
		];
		return $tab;
	}

	public function kolor(){
		$color = $this -> color;
		return substr($color, 1);
	}

}
