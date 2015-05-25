<?php

class UsersController extends BaseController {
    protected $layout = "layouts.main";

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
        $this->beforeFilter('hasOriginalUserAdminRole', array('only' => array(
            'getAuthentication',
            'postImpersonate'
        )));
    }

    public function getRegister() {
        return View::make('users.register');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), User::$rules['register']);

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
                ->with('message', trans('users.registration.success'))
                ->with('message-type', 'success');
        } else {
            return Redirect::to('users/register')
                ->with('message', trans('general.errors.occured'))
                ->with('message-type', 'danger')
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
                    ->with('message', trans('users.login.success'))
                    ->with('message-type', 'success');
            }
        } else {
            return Redirect::to('users/login')
                ->with('message', trans('users.login.fail'))
                ->with('message-type', 'danger')
                ->withInput();
        }
    }

    public function getAuthentication() {
        $users = User::all();

        return View::make('users.authentication', array(
            'users' => $users,
            'userId' => Auth::user()->id
        ));
    }

    public function postImpersonate() {
        $userId = Input::get('authenticate_id');

        Auth::loginUsingId($userId);

        return Redirect::to('users/dashboard')
            ->with('message', trans('users.login.success'))
            ->with('message-type', 'success');
    }

    public function getDashboard() {
        // Nombre & liste des clients sans commentaires depuis 3 mois (pour acheteur vendeur actifs)
        $clientWithoutComments = DB::table('clients')
            ->where('state', '=', 'ActiveSeller')
            ->orWhere('state', '=', 'ActiveBuyer')
            ->leftJoin('histories', 'clients.id', '=', 'histories.client_id')
            ->groupBy('clients.id')
            ->having('last_comment', '>', 'DATE_SUB(NOW(),INTERVAL 3 MONTH)')
            ->select('clients.id', DB::raw('MAX(histories.created_at) as last_comment'))
            ->get();

        return View::make('users.dashboard',array(
            'clientWithoutComments' => $clientWithoutComments
        ));
    }

    public function getLogout() {
        Auth::logout();

        return Redirect::to('users/login')
            ->with('message', trans('users.logout.success'))
            ->with('message-type', 'success');
    }
}

?>
