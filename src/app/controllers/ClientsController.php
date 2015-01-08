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
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth');
                $this->beforeFilter('canUserAccessClient', array('only' => array('getEdit', 'getDelete')));
	}

	public function getList() {
                $criterias = array();

                if (!$this->HasAdminRole()) {
                        $criterias['user_id'] = Auth::user()->id;
                }

                $results = $this->getClient($criterias);

                return View::make('clients.list', array(
                        'results' => $results
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
                return View::make('clients.create');
        }

	public function getEdit() {
                $id = Input::get('client_id');

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
                        'selection' => $selection
                ));
        }

        public function postEdit() {
                // TODO
        }

	public function getDelete() {
                $clients = $this->getClient(array(
                        'id' => Input::get('client_id')
                ));

                $client = $clients[0];

                return View::make('clients.delete');
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
