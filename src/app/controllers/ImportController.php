<?php

class ImportController extends BaseController {
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth', array('only' => array('getDashboard')));
	}

	public function getData() {
		$this->layout->content = View::make('import.import');
	}

	public function postData() {
		return Redirect::to('import/data')
			->with('message', 'Thanks for registering!');
	}
}

?>
