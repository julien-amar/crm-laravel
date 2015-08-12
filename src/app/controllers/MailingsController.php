<?php

class MailingsController extends BaseController {
    protected $layout = "layouts.main";

    private function getMailings($queryFilter) {
        $mailings =  DB::table('mailings')
            ->join('clients', 'clients.id', '=', 'mailings.client_id')
            ->select(
                'mailings.*',
                'clients.firstname',
                'clients.lastname',
                'clients.mail'
            );

        $mailings = $mailings
            ->where('mailings.state', '=', 'Todo')
            ->orWhere('mailings.state', '=', 'InProgress')
            ->orWhere('mailings.state', '=', 'Error');

        return $mailings
            ->orderBy('state')
            ->distinct()
            ->paginate(50);
    }

    private function getMessage($client) {
        $message = Input::get('message');

        $message = str_replace('%firstname%', $client->firstname, $message);
        $message = str_replace('%lastname%', $client->lastname, $message);
        $message = str_replace('%subject%', Input::get('subject'), $message);
        $message = str_replace('%user fullname%', Auth::user()->fullname, $message);
        $message = str_replace('%reference%', Input::get('reference'), $message);

        return $message;
    }

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth');
        $this->beforeFilter('hasOriginalUserAdminRole');
    }

    public function getRetry() {
        $mailing_id = Input::get('mailing_id');

        $mailing = Mailing::find($mailing_id);

        if ($mailing) {
            $mailing->state = 'Todo';

            $mailing->save();

            return Redirect::to('mailings/list')
                ->with('message', trans('mailings.validation.retry.success'))
                ->with('message-type', 'success');
        }

        return Redirect::to('mailings/list')
            ->with('message', trans('errors.occured'))
            ->with('message-type', 'danger');
    }

    public function getDelete() {
        $mailing_id = Input::get('mailing_id');

        $mailing = Mailing::find($mailing_id);

        return View::make('mailings.delete', array(
            'mailing' => $mailing
        ));
    }

    public function postDelete() {
        $mailing_id = Input::get('mailing_id');

        $mailing = Mailing::find($mailing_id);

        $mailing->delete();

        return Redirect::to('mailings/list')
            ->with('message', trans('mailings.validation.delete.success'))
            ->with('message-type', 'success');
    }

    public function getResults() {
        $results = $this->getMailings(Input::all());

        return View::make('mailings.results', array(
            'results' => $results
        ));
    }

    public function getList() {
        return View::make('mailings.list');
    }

    public function getCreate() {
        return View::make('mailings.create', array(
            'mailing' => new Mailing()
        ));
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), Mailing::$rules['create']);

        if ($validator->passes()) {

            $clients = Input::get('clients');

            if (isset($clients)) {
                $clients = explode(',', $clients);
                $files = Input::file('file');

                $uploads = array();

                if (!empty($files)) {
                    foreach($files as $file) {
                        
                        if (empty($file)) {
                            continue;
                        }

                        $upload = new Upload();

                        $filename = $file->getClientOriginalName();
                        $targetFolder = 'Upload';
                        $targetPath = $targetFolder . '/' . $filename;

                        $upload_success = $file->move($$targetFolder, $filename);

                        $upload->path = $targetPath;

                        $uploads[] = $upload;
                    }
                }

                foreach ($clients as $client) {
                    if (!empty($client)) {
                        $clientObject = Client::getClientById($client);

                        if ($clientObject) {
                            $mailing = new Mailing();

                            $mailing->user_id = Auth::user()->id;

                            $mailing->client_id = $client;

                            $mailing->message = $this->getMessage($clientObject);
                            $mailing->operation = Input::get('operation');
                            $mailing->subject = Input::get('subject');
                            $mailing->reference = Input::get('reference');
                            $mailing->state = 'Todo';

                            $mailing->save();

                            $mailing->Uploads()->sync($uploads);
                        }
                    }
                }
            }

            return Redirect::to('clients/list')
                ->with('message', trans('mailings.validation.send.success'))
                ->with('message-type', 'success');
        } else {
            return Redirect::to('clients/list')
                ->with('message', trans('general.errors.occured'))
                ->with('message-type', 'danger')
                ->withErrors($validator)
                ->withInput();
        }
    }
}

?>
