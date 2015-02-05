<?php

class ImportController extends BaseController {
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth');
		$this->beforeFilter('hasOriginalUserAdminRole');
	}

	public function getData() {
		return View::make('import.import');
	}

	public function postData() {
		$inputFileName = Input::file('file')->getFilename();

		/** Load $inputFileName to a PHPExcel Object  **/
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		
		return Redirect::to('import/data')
			->with('message', '<strong>146 results</strong> had been imported.!') // TODO : Translate
			->with('message-type', 'success');
	}
}

?>
