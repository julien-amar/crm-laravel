<?php

class ClientsController extends BaseController {
	protected $layout = "layouts.main";

        private function getClient($criterias) {
                if (isset($criterias['id']))
                        $user = Client::where('id', '=', $criterias['id'])->get();
                if (isset($criterias['user_id']))
                        $user = Client::where('user_id', '=', $criterias['user_id'])->get();

                if (!isset($user))
                        $user = Client::all();

                return $user;
        }

	public function __construct() {
		//$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth');
                $this->beforeFilter('canUserAccessClient', array('only' => array('getEdit', 'postEdit', 'getDelete', 'postDelete')));
	}

	public function getList() {
                $criterias = array();

                if (!$this->HasAdminRole()) {
                        $criterias['user_id'] = Auth::user()->id;
                }

                $users = User::all();

                $results = $this->getClient($criterias);

                return View::make('clients.list', array(
                        'results' => $results,
                        'users' => $users,
                        'states' => array(
                                'Acheteur' => 'Buyer',
                                'Vendeur' => 'Seller'
                        ),
                        'activities' => Activity::all(),
                        'sectors' => Sector::all()
                ));
        }

        public function postSearch() {
                // TODO

                // search

                //firstname
                // lastname
                // email
                // phone
                // birthday-from
                // birthday-to
                // last-call-from
                // last-call-to
                // next-call-from
                // next-call-to
                // creation-date-from
                // creation-date-to
                // update-date-from
                // update-date-to
                // comment
                
                // company
                // street
                // city
                // zip-code

                // user
                // activity
                // price
                // rent
                // surface
                // state
        }

	public function getCreate() {
                $selection = [
                        'activities' => [],
                        'sectors' => []
                ];

                return View::make('clients.create', array(
                        'client' => new Client(),
                        'states' => array(
                                'Acheteur' => 'Buyer',
                                'Vendeur' => 'Seller'
                        ),
                        'activities' => Activity::all(),
                        'sectors' => Sector::all(),
                        'selection' => $selection
                ));
        }

        private function SaveOrUpdateClient($client)
        {
                $client->lastname = Input::get('lastname');
                $client->firstname = Input::get('firstname');
                $client->mail = Input::get('email');
                $client->phone = Input::get('phone');
                $client->next_relance = Input::get('next_relance');
                $client->company = Input::get('company');
                $client->address_number = Input::get('address_number');
                $client->address_street = Input::get('address_street');
                $client->address_zipcode = Input::get('address_zipcode');
                $client->address_city = Input::get('address_city');
                $client->mandat = Input::get('mandat');
                $client->state = Input::get('state');
                $client->prix_from = Input::get('prix_from');
                $client->prix_to = Input::get('prix_to');
                $client->loyer_from = Input::get('loyer_from');
                $client->loyer_to = Input::get('loyer_to');
                $client->surface_from = Input::get('surface_from');
                $client->surface_to = Input::get('surface_to');
                
                $client->save();

                $activites = Input::get('activities');
                if (isset($activites)) {
                        $client->activities()->sync($activites);
                } else {
                        $client->activities()->sync([]);
                }

                $sectors = Input::get('sectors');
                if (isset($sectors)) {
                        $client->sectors()->sync($sectors);
                } else {
                        $client->sectors()->sync([]);
                }

                if (!empty(Input::get('comment'))) {
                        $history = new History;

                        $history->client_id = $client->id;
                        $history->message = Input::get('comment');

                        $history->save();
                }
        }

        public function postCreate() {
                $validator = Validator::make(Input::all(), Client::$rules['create']);

                if ($validator->passes()) {
                        $client = new Client;

                        $client->user_id = Auth::user()->id;

                        $this->SaveOrUpdateClient($client);
                        
                        return Redirect::to('clients/edit?client_id=' . $client->id)
                                ->with('message', 'Client added successfully') // TODO : Translate
                                ->with('message-type', 'success');
                } else {
                        return Redirect::to('clients/create')
                                ->with('message', 'The following errors occurred') // TODO : Translate
                                ->with('message-type', 'danger')
                                ->withErrors($validator)
                                ->withInput();
                }
        }

	public function getEdit() {
                $id = Session::get('client_id');

                if (!isset($id)) {
                        $id = Input::get('client_id');
                }

                $clients = $this->getClient(array(
                        'id' => $id
                ));

                $client = $clients[0];
                
                $selection = [
                        'activities' => array_map(
                                create_function('$o', 'return $o["id"];'),
                                $client->activities->toArray()
                        ),
                        'sectors' => array_map(
                                create_function('$o', 'return $o["id"];'),
                                $client->sectors->toArray()
                        )
                ];

                return View::make('clients.edit', array(
                        'clientId' => $id,
                        'client' => $client,
                        'states' => array(
                                'Acheteur' => 'Buyer',
                                'Vendeur' => 'Seller'
                        ),
                        'activities' => Activity::all(),
                        'sectors' => Sector::all(),
                        'selection' => $selection,
                        'comments' => $client->getComments()
                ));
        }

        public function postEdit() {
                $validator = Validator::make(Input::all(), Client::$rules['edit']);

                if ($validator->passes()) {
                        $client_id = Input::get('client_id');

                        $client = Client::find($client_id);

                        $client->last_relance = Input::get('last_relance');

                        $this->SaveOrUpdateClient($client);

                        return Redirect::to('clients/edit?client_id=' . $client->id)
                                ->with('message', 'Client added successfully') // TODO : Translate
                                ->with('message-type', 'success');
                } else {
                        return Redirect::to('clients/edit?client_id=' . $client->id)
                                ->with('message', 'The following errors occurred') // TODO : Translate
                                ->with('message-type', 'danger')
                                ->withErrors($validator)
                                ->withInput();
                }
        }

	public function getDelete() {
                $client_id = Input::get('client_id');

                $client = Client::find($client_id);

                return View::make('clients.delete', array(
                        'client' => $client
                ));
        }

        public function postDelete() {
                $client_id = Input::get('client_id');

                $client = Client::find($client_id);

                $client->delete();

                return Redirect::to('clients/list')
                        ->with('message', 'Client deleted successfully') // TODO : Translate
                        ->with('message-type', 'success');
        }

	public function getRelance() {
                $clients = $this->getClient(array(
                        'id' => Input::get('client_id')
                ));

                $client = $clients[0];

                return View::make('clients.relance');
        }
}

?>
