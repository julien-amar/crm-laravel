<?php

class ClientsController extends BaseController {
    protected $layout = "layouts.main";

    private $criterias = array(
        'search' => array('-', 'agregatePredicate'),

        'id' => array('id', 'equalityPredicate'),
        'user_id' => array('user_id', 'equalityPredicate'),
        'email' => array('mail', 'equalityPredicate'),
        'phone' => array('phone', 'equalityPredicate'),
        'company' => array('company', 'equalityPredicate'),
        'number' => array('address_number', 'equalityPredicate'),
        'city' => array('address_city', 'equalityPredicate'),
        'zip-code' => array('address_zipcode', 'equalityPredicate'),
        'mandat' => array('mandat', 'equalityPredicate'),
        'user' => array('user_id', 'equalityPredicate'),
        'terrace' => array('terrace', 'equalityPredicate'),
        'extraction' => array('extraction', 'equalityPredicate'),
        'apartment' => array('apartment', 'equalityPredicate'),
        'licenseII' => array('licenseII', 'equalityPredicate'),
        'licenseIII' => array('licenseIII', 'equalityPredicate'),
        'licenseIV' => array('licenseIV', 'equalityPredicate'),

        'with-mandat' => array('mandat', 'isNullOrEmptyPredicate'),

        'state' => array('state', 'mutipleValuePredicate'),
        'users' => array('user_id', 'mutipleValuePredicate'),

        'last-call-from' => array('last_relance_from', 'dateRangeEqualityPredicate'),
        'last-call-to' => array('last_relance_to', 'dateRangeEqualityPredicate'),
        'next-call-from' => array('next_relance_from', 'dateRangeEqualityPredicate'),
        'next-call-to' => array('next_relance_to', 'dateRangeEqualityPredicate'),
        'creation-date-from' => array('created_at_from', 'dateRangeEqualityPredicate'),
        'creation-date-to' => array('created_at_to', 'dateRangeEqualityPredicate'),
        'update-date-from' => array('updated_at_from', 'dateRangeEqualityPredicate'),
        'update-date-to' => array('updated_at_to', 'dateRangeEqualityPredicate'),

        'price-from' => array('prix_from', 'rangeEqualityPredicate'),
        'price-to' => array('prix_to', 'rangeEqualityPredicate'),
        'rent-from' => array('loyer_from', 'rangeEqualityPredicate'),
        'rent-to' => array('loyer_to', 'rangeEqualityPredicate'),
        'surface-from' => array('surface_from', 'rangeEqualityPredicate'),
        'surface-to' => array('surface_to', 'rangeEqualityPredicate'),
        'surface-sell-from' => array('surface_sell_from', 'rangeEqualityPredicate'),
        'surface-sell-to' => array('surface_sell_to', 'rangeEqualityPredicate'),

        'activities' => array('activity_id', 'mutipleValueJoinPredicate', 'clients_activities', 'clients.id', 'clients_activities.client_id'),
        'sectors' => array('sector_id', 'mutipleValueJoinPredicate', 'clients_sectors', 'clients.id', 'clients_sectors.client_id'),

        'comment' => array('message', 'valueContainsJoinPredicate', 'histories', 'clients.id', 'histories.client_id'),

        'lastname' => array('lastname', 'containsPredicate'),
        'firstname' => array('firstname', 'containsPredicate'),
        'street' => array('address_street', 'containsPredicate'),

        'subject' => array('m1.subject', 'valueContainsJoinPredicate', 'mailings as m1', 'clients.id', 'm1.client_id'),
        'reference' => array('m2.reference', 'valueContainsJoinPredicate', 'mailings as m2', 'clients.id', 'm2.client_id'),
    );

    private static function agregatePredicate($collection, $criteria, $value)
    {
        return $collection
            ->where('lastname', 'like', '%' . $value . '%')
            ->orWhere('phone', 'like', '%' . $value . '%')
            ->orWhere('mail', 'like', '%' . $value . '%')
            ->orWhere('company', 'like', '%' . $value . '%');
    }


    private static function isNullOrEmptyPredicate($collection, $criteria, $value)
    {
        if (in_array('1', $value)) {
            $collection = $collection
                ->whereNull($criteria)
                ->orWhere($criteria, '=', '');

            if (in_array('0', $value)) {
                $collection = $collection
                    ->orWhere($criteria, '!=', '');
            }
        } else {
            $collection = $collection
                ->where($criteria, '!=', '');
        }

        return $collection;
    }

    private static function equalityPredicate($collection, $criteria, $value)
    {
        return $collection->where($criteria, '=', $value);
    }

    private static function containsPredicate($collection, $criteria, $value)
    {
        return $collection->where($criteria, 'like', '%' . $value . '%');
    }

    private static function rangeEqualityPredicate($collection, $criteria, $value)
    {
        if (strstr($criteria, '_from') === FALSE) {
            return $collection->where($criteria, '<=', $value);
        }
        else {
            return $collection->where($criteria, '>=', $value);
        }
    }

    private static function dateRangeEqualityPredicate($collection, $criteria, $value)
    {
        $criteriaShort = str_replace('_to', '', $criteria);
        $criteriaShort = str_replace('_from', '', $criteriaShort);

        if (strstr($criteria, '_from') === FALSE) {
            return $collection->where($criteriaShort, '<=', $value);
        }
        else {
            return $collection->where($criteriaShort, '>=', $value);
        }
    }

    private static function mutipleValuePredicate($collection, $criteria, $value)
    {
        return $collection->whereIn($criteria, $value);
    }

    private static function mutipleValueJoinPredicate($collection, $table, $col1, $col2, $criteria, $value)
    {
        return $collection->join($table, $col1, '=', $col2)
            ->whereIn($criteria, $value);
    }

    private static function valueContainsJoinPredicate($collection, $table, $col1, $col2, $criteria, $value)
    {
        return $collection->join($table, $col1, '=', $col2)
            ->where($criteria, 'like', '%' . $value . '%');
    }


    private function getSelectableClient($queryFilters) {
        $clients = DB::table('clients')
            ->select(
                'clients.id',
                'clients.firstname',
                'clients.lastname',
                'clients.company'
            );

        foreach ($queryFilters as $queryFilter => $queryFilterValue) {
            if (empty($queryFilterValue)) {
                continue;
            }

            if (array_key_exists($queryFilter, $this->criterias)) {
                $criteriaInfo = $this->criterias[$queryFilter];

                list($criteria, $criteriaPredicate) = $criteriaInfo;

                if (count($criteriaInfo) == 5) {
                    list($criteria, $criteriaPredicate, $table, $col1, $col2) = $criteriaInfo;

                    $clients = $this->$criteriaPredicate($clients, $table, $col1, $col2, $criteria, $queryFilterValue);
                } else  {
                    $clients = $this->$criteriaPredicate($clients, $criteria, $queryFilterValue);
                }
            }
        }

        $results = $clients->distinct()->get();

        return $results;
    }

    private function getExportableClient($queryFilters) {
        $results = $this->getSelectableClient($queryFilters);

        foreach ($results as $result) {
            $id = $result->id;

            $result->mailings = DB::table('mailings')
                ->where('client_id', '=', $id)
                ->select('reference')
                ->get();

            $result->activities = DB::table('clients_activities')
                ->join('activities', 'activities.id', '=', 'clients_activities.activity_id')
                ->where('client_id', '=', $id)
                ->select('label')
                ->get();
        }

        return $results;
    }

    private function getClient($queryFilters) {
        $clients = DB::table('clients')
            ->select('clients.*');

        foreach ($queryFilters as $queryFilter => $queryFilterValue) {
            if (empty($queryFilterValue)) {
                continue;
            }

            if (array_key_exists($queryFilter, $this->criterias)) {
                $criteriaInfo = $this->criterias[$queryFilter];

                list($criteria, $criteriaPredicate) = $criteriaInfo;

                if (count($criteriaInfo) == 5) {
                    list($criteria, $criteriaPredicate, $table, $col1, $col2) = $criteriaInfo;

                    $clients = $this->$criteriaPredicate($clients, $table, $col1, $col2, $criteria, $queryFilterValue);
                } else  {
                    $clients = $this->$criteriaPredicate($clients, $criteria, $queryFilterValue);
                }
            }
        }

        $results = $clients
            ->distinct()
            ->paginate(50);

        foreach ($results as $result) {
            $id = $result->id;

            $first_comment = DB::table('histories')
                ->where('client_id', '=', $id)
                ->orderBy('created_at', 'asc')
                ->first();

            $last_comment = DB::table('histories')
                ->where('client_id', '=', $id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($first_comment) {
                $result->first_comment = $first_comment->message;
            } else {
                $result->first_comment = '';
            }

            if ($last_comment) {
                $result->last_comment = $last_comment->message;
            } else {
                $result->last_comment = '';
            }
        }

        return $results;
    }

    private function getOperations() {
        $currentPath = dirname(__FILE__) . '/../../templates/';
        $operations = scandir($currentPath);

        $operations = array_filter($operations, function($v) {
            return $v != '.' && $v != '..';
        });

        $map = array();

        foreach ($operations as $operation) {
            $map[$operation] = file_get_contents($currentPath . $operation);
        }

        return $map;
    }

    public function __construct() {
        $this->beforeFilter('auth');
        $this->beforeFilter('canUserAccessClient', array('only' => array('getEdit', 'postEdit', 'getDelete', 'postDelete')));
    }

    private function flattenExportableField($collection, $property) {
        $array = array();

        foreach ($collection as $item) {
            $array[] =  $item->$property;
        }

        return join(",", $array);
    }

    public function getExport() {
        $criterias = Input::all();
        
        if (!$this->HasAdminRole()) {
            $criterias['user_id'] = Auth::user()->id;
        }

        $results = $this->getExportableClient($criterias);

        $filename = tempnam('/tmp', 'export-');
        $fp = fopen ($filename, 'w+');

        foreach ($results as $result) {
            fputcsv($fp, array(
                $result->firstname,
                $result->lastname,
                $result->company,
                $this->flattenExportableField($result->activities, 'label'),
                $this->flattenExportableField($result->mailings, 'reference')
            ), ';');
        }

        fclose($fp);

        return Response::download($filename, 'export.csv', array());
    }

    public function postSelection() {
        $criterias = Input::all();
        
        if (!$this->HasAdminRole()) {
            $criterias['user_id'] = Auth::user()->id;
        }

        $results = $this->getSelectableClient($criterias);

        return Response::json($results);
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
                'ActiveBuyer',
                'PassiveBuyer',
                'ActiveSeller',
                'PassiveSeller'
            ),
            'operations' => $this->getOperations(),
            'activities' => Activity::all(),
            'sectors' => Sector::all()
        ));
    }

    public function getSearch() {
        $criterias = Input::all();

        if (!$this->HasAdminRole()) {
            $criterias['user_id'] = Auth::user()->id;
        }

        $results = $this->getClient($criterias);

        return View::make('clients.results', array(
            'results' => $results,
            'canExport' => !Input::has('search')
        ));
    }

    public function postSearch() {
        $criterias = Input::all();
        
        if (!$this->HasAdminRole()) {
            $criterias['user_id'] = Auth::user()->id;
        }

        $results = $this->getClient($criterias);

        return View::make('clients.results', array(
            'results' => $results,
            'canExport' => !Input::has('search')
        ));
    }

    public function getCreate() {
        $selection = [
            'activities' => [],
            'sectors' => []
        ];

        return View::make('clients.create', array(
            'client' => new Client(),
            'states' => array(
                'ActiveBuyer',
                'PassiveBuyer',
                'ActiveSeller',
                'PassiveSeller'
            ),
            'activities' => Activity::all(),
            'sectors' => Sector::all(),
            'selection' => $selection
        ));
    }

    private function SaveOrUpdateClient($client)
    {
        if (Input::has('user_id') && $this->HasOriginalUserAdminRole()) {
            $client->user_id = Input::get('user_id');
        }

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
        $client->terrace = Input::get('terrace') ? '0' : '1';
        $client->extraction = Input::get('extraction') ? '0' : '1';
        $client->apartment = Input::get('apartment') ? '0' : '1';
        $client->licenseII = Input::get('licenseII') ? '0' : '1';
        $client->licenseIII = Input::get('licenseIII') ? '0' : '1';
        $client->licenseIV = Input::get('licenseIV') ? '0' : '1';
        $client->surface_sell_from = Input::get('surface_sell_from');
        $client->surface_sell_to = Input::get('surface_sell_to');

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

            $history->user_id = Auth::user()->id;
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
                ->with('message', trans('clients.validation.create.success'))
                ->with('message-type', 'success');
        } else {
            return Redirect::to('clients/create')
                ->with('message', trans('general.errors.occured'))
                ->with('message-type', 'danger')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function getEdit() {
        $client_id = Session::get('client_id');

        if (!isset($client_id)) {
            $client_id = Input::get('client_id');
        }

        $users = User::all();
        $client = Client::find($client_id);

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
            'clientId' => $client_id,
            'client' => $client,
            'states' => array(
                'ActiveBuyer',
                'PassiveBuyer',
                'ActiveSeller',
                'PassiveSeller'
            ),
            'activities' => Activity::all(),
            'sectors' => Sector::all(),
            'selection' => $selection,
            'comments' => $client->getComments(),
            'users' => $users
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
                ->with('message', trans('clients.validation.edit.success'))
                ->with('message-type', 'success');
        } else {
            return Redirect::to('clients/edit?client_id=' . $client->id)
                ->with('message', trans('general.errors.occured'))
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
            ->with('message', trans('clients.validation.delete.success'))
            ->with('message-type', 'success');
    }
}

?>
