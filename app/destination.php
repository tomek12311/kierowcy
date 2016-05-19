<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class destination extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'destinations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dlugosc', 'szerokosc', 'order', 'user_id'];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function pozycja(){
        $tab = [
            'szerokosc' => $this -> szerokosc,
            'dlugosc'	=> $this -> dlugosc
        ];
        return $tab;
    }

}