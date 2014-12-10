<?php

class UsersController extends BaseController {
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth', array('only' => array('getDashboard')));
	}

	public function getRegister() {
		return View::make('users.register');
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			$user = new User;

			$user->login = Input::get('login');
			$user->fullname = Input::get('fullname');
			$user->email = Input::get('email');
			$user->phone = Input::get('phone');
			$user->address = Input::get('address');
			$user->password = Hash::make(Input::get('password'));
			$user->admin = FALSE;
			$user->lock = TRUE;

			$user->save();

			return Redirect::to('users/login')
				->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('users/register')
				->with('message', 'The following errors occurred')
				->withErrors($validator)
				->withInput();
		}
	}

	public function getLogin() {
		return View::make('users.login');
	}

	public function postSignin() {

		if (Auth::attempt(array('login' => Input::get('login'), 'password' => Input::get('password'), 'lock' => 0))) {
			Session::put('user.original', Auth::user());

			if (Auth::user()->admin) {
				return Redirect::to('users/authentication');
			} else {
				return Redirect::to('users/dashboard')
					->with('message', 'You are now logged in!');
			}
		} else {
			return Redirect::to('users/login')
				->with('message', 'Your username/password combination was incorrect')
				->withInput();
		}
	}

	public function getAuthentication() {
		$users = DB::table('users')->get();

		return View::make('users.authentication', array(
			'users' => $users,
			'userId' => Auth::user()->id
		));
	}

	public function postImpersonate() {
		// TODO : Verifier qu'on est logge et admin
		$userId = Input::get('authenticate_id');

		// TODO : Verifier que le user existe
		Auth::loginUsingId($userId);


		return Redirect::to('users/dashboard')
			->with('message', 'You are now logged in!');
	}

	public function getDashboard() {
		return View::make('users.dashboard');
	}

	public function getLogout() {
		Auth::logout();

		return Redirect::to('users/login')
			->with('message', 'Your are now logged out!');
	}
}

?>
