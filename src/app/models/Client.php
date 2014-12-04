<?php

class Client extends Eloquent {

	public static $rules = array(
		'firstname'=>'required|alpha|min:2',
		'lastname'=>'required|alpha|min:2',
		'email'=>'required|email|unique:users',
		'password'=>'required|alpha_num|between:6,12|confirmed',
		'password_confirmation'=>'required|alpha_num|between:6,12'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'clients';
}
