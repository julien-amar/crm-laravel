<?php

class Client extends Eloquent {

	public static $rules = array(
		'firstname'=>'required|alpha|min:2',
		'lastname'=>'required|alpha|min:2',
		'email'=>'required|email|unique:users'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'clients';

	public function sectors() {
		return $this->belongsToMany('Sector', 'clients_sectors');
	}

	public function activities() {
		return $this->belongsToMany('Activity', 'clients_activities');
	}
}
