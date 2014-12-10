<?php

class ClientsController extends BaseController {
	protected $layout = "layouts.main";

        private function getClient($criterias) {
                $user = DB::table('clients');

                if (isset($criterias['id']))
                        $user = $user->where('id', '=', $criterias['id']);
                        
                return $user->get();
        }

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth');
	}

	public function getList() {
                $results = $this->getClient(array());

                return View::make('clients.list', array(
                        'results' => $results
                ));
        }

	public function getCreate() {
                return View::make('clients.create');
        }

	public function getEdit() {
                $id = Input::has('client_id');

                $result = $this->getClient(array(
                        'id' => $id
                ));

                return View::make('clients.edit', array(
                        'clientId' => $id,
                        'client' => $result[0],
                        'prices' => array(),
                        'rents' => array(),
                        'surfaces' => array(),
                        'states' => array()
                ));
        }

	public function getDelete() {
                return View::make('clients.delete');
        }

	public function getImport() {
                return View::make('clients.import');
        }

	public function getRelances() {
                return View::make('clients.relances');
        }
}

?>
