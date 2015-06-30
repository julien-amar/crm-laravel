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
            'results' => Session::get('import-data'),
            'state' => Session::get('state')
        ));
    }

    public function postData() {
        if (Input::hasFile('file') && Input::file('file')->isValid())
        {
            $inputFileType = 'Excel2007';
            $originalFileName = Input::file('file')->getClientOriginalName();
            $inputFileName = Input::file('file')->getRealPath();

            try {
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setLoadAllSheets();
                $objPHPExcel = $objReader->load($inputFileName);
                $objWorksheet = $objPHPExcel->getSheet(0);

                $results = array();
                $row = 2;
                while (TRUE) {
                    $row_data = array();

                    for ($col = 0; $col < 30; $col++) {
                        $row_data[] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    }
                    $emptyArray = array_filter($row_data, create_function('$x','return empty($x);'));

                    if (count($emptyArray) == 30)
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
                    $client->surface_sell_from = $row_data[13];
                    $client->surface_sell_to = $row_data[14];

                    if ($row_data[15] == 'Oui') {
                        $client->terrace = TRUE;
                    } else {
                        $client->terrace = FALSE;
                    }

                    if ($row_data[16] == 'Oui') {
                        $client->extraction = TRUE;
                    } else {
                        $client->extraction = FALSE;
                    }

                    if ($row_data[17] == 'Oui') {
                        $client->apartment = TRUE;
                    } else {
                        $client->apartment = FALSE;
                    }

                    if ($row_data[18] == 'Oui') {
                        $client->licenseII = TRUE;
                    } else {
                        $client->licenseII = FALSE;
                    }

                    if ($row_data[19] == 'Oui') {
                        $client->licenseIII = TRUE;
                    } else {
                        $client->licenseIII = FALSE;
                    }

                    if ($row_data[20] == 'Oui') {
                        $client->licenseIV = TRUE;
                    } else {
                        $client->licenseIV = FALSE;
                    }
                    
                    $client->company = $row_data[21];
                    $client->mandat = $row_data[22];
                    $client->address_number = $row_data[23];
                    $client->address_street = $row_data[24];
                    $client->address_zipcode = $row_data[25];
                    $client->address_city = $row_data[26];

                    $activities = preg_split ("/;/", $row_data[27]);
                    $sectors = preg_split ("/;/", $row_data[28]);
                    $comment = $row_data[29];

                    $validator = Validator::make($client->toArray(), Client::$rules['create']);

                    if ($validator->passes()) {
                        $state = 'success';
                        $errors = array();
                    } else {
                        $state = 'error';
                        $errors = $validator->messages();
                    }

                    if(count(Activity::whereIn('label', $activities)->get()) != count($activities)) {
                        $errors[] = trans('import.validation.error.activity');
                        $state = 'error';
                    }

                    if(count(Sector::whereIn('label', $sectors)->get()) != count($sectors)) {
                        $errors[] = trans('import.validation.error.sector');
                        $state = 'error';
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

                $errors = array_filter($results, create_function('$x','return $x["state"] == "error";'));

                if (count($errors) == 0) {

                    foreach ($results as $result) {
                        $client = $result['client'];
                        $activities = $result['activities'];
                        $sectors = $result['sectors'];
                        $comment = $result['comment'];

                        $client->save();

                        if (isset($activities)) {
                            $activities = Activity::whereIn('label', $activities)->lists('id');
                            $client->activities()->sync($activities);
                        } else {
                            $client->activities()->sync([]);
                        }

                        if (isset($sectors)) {
                            $sectors = Sector::whereIn('label', $sectors)->lists('id');
                            $client->sectors()->sync($sectors);
                        } else {
                            $client->sectors()->sync([]);
                        }

                        $history = new History;

                        $history->client_id = $client->id;
                        $history->message = str_replace(':file', $originalFileName, trans('import.comment.default'));

                        $history->save();

                        if (!empty($comment)) {
                            $history = new History;

                            $history->client_id = $client->id;
                            $history->message = $comment;

                            $history->save();
                        }
                    }

                    return Redirect::to('import/results')
                        ->with('message', '<strong>' . count($results) . ' clients</strong> had been imported !') // TODO : Translate
                        ->with('message-type', 'success')
                        ->with('import-data', $results)
                        ->with('state', 'success');
                } else {
                    return Redirect::to('import/results')
                        ->with('message', '<strong>' . count($errors) . ' errors </strong> had occured !') // TODO : Translate
                        ->with('message-type', 'danger')
                        ->with('import-data', $errors)
                        ->with('state', 'error');
                }
            } catch (Exception $e) {
                return Redirect::to('import/results')
                    ->with('message', trans('general.errors.occured.excel'))
                    ->with('message-type', 'danger')
                    ->with('import-data', array())
                    ->with('state', 'error');
            }
        }
        else {
            return Redirect::to('import/data');
        }
    }
}

?>
