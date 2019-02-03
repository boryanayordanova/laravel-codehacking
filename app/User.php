<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'role_id', 'is_active','photo_id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token'
	];

	//this one user belog to one role (each user is matching some role) 1:1
	public function role() {
		return $this->belongsTo('App\Role');
	}

	//the user is with just one photo
	public function photo(){
		return $this->belongsTo('App\Photo');
	}

	public function isAdmin(){
		//dd($this);
		if($this->role->name == "administrator" && $this->is_active == 1){

			return true;
		}
	return false;
	}

	public function posts(){

		return $this->hasMany('App\Post');
	}



	public function getGravatarAttribute(){
		$hash = md5(strtolower(trim($this->attributes['email']))) . "?d=mm"; //in case something happand it will display mystery man "?d=mm&s="; <-for size of the image
		return "http://www.gravatar.com/avatar/$hash";
		
		//on the view post change the pic path with:
		//src="{{Auth::user()->gravatar}}"
	}
	
}
