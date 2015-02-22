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

	public function __construct() {
		$this->beforeFilter('auth');
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
                                foreach ($clients as $client) {
                                        $mailing = new Mailing();

                                        $mailing->user_id = Auth::user()->id;

                                        $mailing->client_id = $client;
                                        
                                        $mailing->message = Input::get('message');
                                        $mailing->state = Input::get('state');
                                        
                                        $mailing->save();
                                }
                        }                        

                        return Redirect::to('mailing/list')
                                ->with('message', 'Mailing added successfully') // TODO : Translate
                                ->with('message-type', 'success');
                } else {
                        return Redirect::to('mailing/create')
                                ->with('message', 'The following errors occurred') // TODO : Translate
                                ->with('message-type', 'danger')
                                ->withErrors($validator)
                                ->withInput();
                }
        }
}

?>
