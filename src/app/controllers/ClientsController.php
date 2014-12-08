<?php

class ClientsController extends BaseController {
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth');
	}

	public function getList() {
                $results = DB::table('clients')
                        ->get();

                return View::make('clients.list', array(
                        'results' => $results
                ));
        }

	public function getCreate() {
                return View::make('clients.create');
        }

	public function getEdit() {
                return View::make('clients.edit');
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
