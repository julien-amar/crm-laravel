<?php

class ProfileController extends BaseController {
	protected $layout = "layouts.main";

	private function getUser() {
		if (Session::get('user.original')->admin && Input::has('user_id'))
			$id = Input::get('user_id');
		else
			$id = Auth::user()->id;
		
		$user = DB::table('users')
			->where('id', '=', $id)
			->get();

		return $user[0];
	}

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth');
	}

	// TODO : Admin only
	public function getProfiles() {
		$users = DB::table('users')->get();

        return View::make('profiles.profiles', array(
        	'users' => $users
    	));
    }

	public function getProfile() {
		$emails = DB::select('select distinct username from roundcubemail.users;');

		$user = $this->getUser();

        return View::make('profiles.profile', array(
        	'user' => $user,
        	'emails' => $emails
    	));
    }

	public function postProfile() {
		// TODO : Vérifier que l'on change les datas du user courant & qu'on a le droit
		$user = $this->getUser();

		return Redirect::to('profile/profile')
			->with('message', 'User profile updated successfully.')
			->withInput();
    }

	public function postPassword() {
		// TODO : Vérifier que l'on change les datas du user courant & qu'on a le droit :)
		$user = $this->getUser();

		return Redirect::to('profile/profile')
			->with('message', 'User profile updated successfully.')
			->withInput();
    }
}

?>
