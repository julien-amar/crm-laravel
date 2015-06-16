<?php

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }

    protected function HasOriginalUserAdminRole()
    {
        return Session::get('user.original')->admin;
    }

    protected function HasAdminRole()
    {
        return Auth::user()->admin;
    }

    protected function RedirectToLoginPage() {
        return Redirect::to('users/login')
            ->with('message', trans('general.permission.access.denied'))
            ->with('message-type', 'danger');
    }
}
