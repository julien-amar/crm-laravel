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

	public function getResults() {
		return View::make('import.results', array(
			'results' => Session::get('import-data')
		));
	}

	public function postData() {
		if (Input::hasFile('file') && Input::file('file')->isValid())
		{
			$inputFileType = 'Excel2007';
			$inputFileName = Input::file('file')->getRealPath();

			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objReader->setLoadAllSheets();
			$objPHPExcel = $objReader->load($inputFileName);
			$objWorksheet = $objPHPExcel->getSheet(0);

			$results = array();
			$row = 2;
			while (TRUE) {
				$row_data = array();

				for ($col = 0; $col < 22; $col++) {
					$row_data[] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
				}
				$emptyArray = array_filter($row_data, create_function('$x','return empty($x);'));

				if (count($emptyArray) == 22)
					break;

				$client = new Client;

				$client->user_id = Auth::user()->id;
				$client->lastname = $row_data[0];
	            $client->firstname = $row_data[1];
	            $client->phone = $row_data[2];
	            $client->mail = $row_data[3];
	            $client->last_relance = $row_data[4];
	            $client->next_relance = $row_data[5];

	            $client->state = $row_data[6];
	            $client->prix_from = $row_data[7];
	            $client->prix_to = $row_data[8];
	            $client->loyer_from = $row_data[9];
	            $client->loyer_to = $row_data[10];
	            $client->surface_from = $row_data[11];
	            $client->surface_to = $row_data[12];

	            $client->company = $row_data[13];
	            $client->mandat = $row_data[14];
	            $client->address_number = $row_data[15];
	            $client->address_street = $row_data[16];
	            $client->address_zipcode = $row_data[17];
	            $client->address_city = $row_data[18];
	            
	            $activities = preg_split ("/;/", $row_data[19]);
	            $sectors = preg_split ("/;/", $row_data[20]);
	            $comment = $row_data[21];

				$validator = Validator::make($client->toArray(), Client::$rules['create']);

                if ($validator->passes()) {
                	$state = 'success';
                	$errors = array();
				} else {
                	$state = 'error';
                	$errors = $validator->messages();
		        }

	            $results[] = array(
	            	'client' => $client,
	            	'activities' => $activities,
	            	'sectors' => $sectors,
	            	'comment' => $comment,
	            	'state' => $state,
	            	'line' => $row - 1,
	            	'errors' => $errors
	        	);

				$row++;
			}

			// TODO : Check validation errors on activities & sectors :)

			$errors = array_filter($results, create_function('$x','return $x["state"] == "error";'));
			
			if (count($errors) == 0) {
				// TODO : Importing

				return Redirect::to('import/results')
					->with('message', '<strong>' . count($results) . ' clients</strong> had been imported !') // TODO : Translate
					->with('message-type', 'success')
					->with('import-data', $results);
			} else {
				return Redirect::to('import/results')
					->with('message', '<strong>' . count($errors) . ' errors </strong> had occured !') // TODO : Translate
					->with('message-type', 'danger')
					->with('import-data', $errors);
			}
		}
		else {
			return Redirect::to('import/data');
		}
	}
}

?>
