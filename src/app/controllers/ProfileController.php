<?php

class ProfileController extends BaseController {
    protected $layout = "layouts.main";

    private function getUser() {
        if ($this->HasOriginalUserAdminRole() && Input::has('user_id'))
            $id = Input::get('user_id');
        else
            $id = Auth::user()->id;

        $user = User::find($id);

        return $user;
    }

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth');
        $this->beforeFilter('hasOriginalUserAdminRole', array('only' => array('getProfiles', 'getAdmin', 'getLock', 'getDelete')));
    }

    public function getProfiles() {
        $users = User::all();

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
        $validator = Validator::make(Input::all(), User::$rules['profile']);

        if ($validator->passes()) {
            $user = $this->getUser();

            $user->fullname = Input::get('fullname');
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');
            $user->address = Input::get('address');

            $user->save();

            return Redirect::to('profile/profile')
                ->with('message', trans('profile.validation.edit.success'))
                ->with('message-type', 'success');
        } else {
            return Redirect::to('profile/profile')
                ->with('message', trans('general.errors.occured'))
                ->with('message-type', 'danger')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function postPassword() {
        $validator = Validator::make(Input::all(), User::$rules['password']);

        $user = $this->getUser();

        if ($validator->passes() && Auth::attempt(array('login' => $user->login, 'password' => Input::get('password_old'))))
        {
            $user->password = Hash::make(Input::get('password'));

            $user->save();

            return Redirect::to('profile/profile')
                ->with('message', trans('profile.validation.edit.success'))
                ->with('message-type', 'success');
        } else {
            return Redirect::to('profile/profile')
                ->with('message', trans('general.errors.occured'))
                ->with('message-type', 'danger')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function getAdmin() {
        $user = $this->getUser();

        $user->admin = Input::get('value') == "True" ? 1 : 0;

        $user->save();

        return Redirect::to('profile/profiles')
            ->with('message', trans('profile.validation.edit.success'))
            ->with('message-type', 'success');
    }

    public function getLock() {
        $user = $this->getUser();

        $user->lock = Input::get('value') == "True" ? 1 : 0;

        $user->save();

        return Redirect::to('profile/profiles')
            ->with('message', trans('profile.validation.edit.success'))
            ->with('message-type', 'success');
    }

    public function getDelete() {
        $userId = Input::get('user_id');
        $user = User::find($userId);

        if ($user && !$user->clients()->count()) {
            $user->delete();

            return Redirect::to('profile/profiles')
                ->with('message', trans('profile.validation.delete.success'))
                ->with('message-type', 'success');
        }

        return Redirect::to('profile/profiles')
            ->with('message', trans('general.permission.access.denied'))
            ->with('message-type', 'danger');
    }
}

?>
