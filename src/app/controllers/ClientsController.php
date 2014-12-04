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

                $this->layout->content = View::make('clients.list', array(
                        'results' => $results
                ));
        }

	public function getCreate() {
                $this->layout->content = View::make('clients.create');
        }

	public function getEdit() {
                $this->layout->content = View::make('clients.edit');
        }

	public function getDelete() {
                $this->layout->content = View::make('clients.delete');
        }

	public function getImport() {
                $this->layout->content = View::make('clients.import');
        }

	public function getRelances() {
                $this->layout->content = View::make('clients.relances');
        }
}

?>
