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

    private function updateLastConnectionDate()
    {
        $user = Auth::user();

        $user->last_authentication = DB::raw('NOW()');

        $user->save();
    }

    public function postSignin() {

        if (Auth::attempt(array('login' => Input::get('login'), 'password' => Input::get('password'), 'lock' => 0))) {
            Session::put('user.original', Auth::user());

            $this->updateLastConnectionDate();

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
            ->where('clients.user_id', '=', Auth::user()->id)
            ->where('state', '=', 'ActiveSeller')
            ->orWhere('state', '=', 'ActiveBuyer')
            ->leftJoin('histories', 'clients.id', '=', 'histories.client_id')
            ->groupBy('clients.id', 'clients.firstname', 'clients.lastname')
            ->having('last_comment', '>', 'DATE_SUB(NOW(),INTERVAL 3 MONTH)')
            ->select('clients.id', 'clients.firstname', 'clients.lastname', DB::raw('MAX(histories.created_at) as last_comment'))
            ->remember(10)
            ->get();

        // Nombre & liste de clients sans envoi mails depuis 1 mois (pour acheteur actifs)
        $clientWithoutMailings = DB::table('clients')
            ->where('clients.user_id', '=', Auth::user()->id)
            ->where('clients.state', '=', 'ActiveBuyer')
            ->where('mailings.state', '=', 'Success')
            ->leftJoin('mailings', 'clients.id', '=', 'mailings.client_id')
            ->groupBy('clients.id', 'clients.firstname', 'clients.lastname')
            ->having('last_comment', '>', 'DATE_SUB(NOW(),INTERVAL 1 MONTH)')
            ->select('clients.id', 'clients.firstname', 'clients.lastname', DB::raw('MAX(mailings.created_at) as last_comment'))
            ->remember(10)
            ->get();

        // Nombre de clients acheteurs de la session (acheteur actifs)
        $activeBuyers = DB::table('clients')
            ->where('state', '=', 'ActiveBuyer')
            ->where('user_id', '=', Auth::user()->id)
            ->remember(10)
            ->get();

        // Nombre de clients vendeurs de la session (vendeur actifs)
        $activeSellers = DB::table('clients')
            ->where('state', '=', 'ActiveSeller')
            ->where('user_id', '=', Auth::user()->id)
            ->remember(10)
            ->get();

        return View::make('users.dashboard',array(
            'clientWithoutComments' => $clientWithoutComments,
            'clientWithoutMailings' => $clientWithoutMailings,
            'activeBuyers' => $activeBuyers,
            'activeSellers' => $activeSellers
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
