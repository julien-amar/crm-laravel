<?php

class ClientsController extends BaseController {
    protected $layout = "layouts.main";

    private $criterias = array(
        'id' => array('id', 'equalityPredicate'),
        'email' => array('mail', 'equalityPredicate'),
        'phone' => array('phone', 'equalityPredicate'),
        'company' => array('company', 'equalityPredicate'),
        'number' => array('address_number', 'equalityPredicate'),
        'city' => array('address_city', 'equalityPredicate'),
        'zip-code' => array('address_zipcode', 'equalityPredicate'),
        'mandat' => array('mandat', 'equalityPredicate'),
        'user' => array('user_id', 'equalityPredicate'),
        'state' => array('state', 'equalityPredicate'),

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

        'activities' => array('activity_id', 'mutipleValueJoinPredicate', 'clients_activities', 'clients.id', 'clients_activities.client_id'),
        'sectors' => array('sector_id', 'mutipleValueJoinPredicate', 'clients_sectors', 'clients.id', 'clients_sectors.client_id'),

        'comment' => array('message', 'valueContainsJoinPredicate', 'histories', 'clients.id', 'histories.client_id'),

        'lastname' => array('lastname', 'containsPredicate'),
        'firstname' => array('firstname', 'containsPredicate'),
        'street' => array('address_street', 'containsPredicate'),

        'subject' => array('m1.subject', 'valueContainsJoinPredicate', 'mailings as m1', 'clients.id', 'm1.client_id'),
        'reference' => array('m2.reference', 'valueContainsJoinPredicate', 'mailings as m2', 'clients.id', 'm2.client_id'),
    );

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

        return $clients
            ->distinct()
            ->paginate(10);
    }


    private function getOperations() {
        $currentPath = dirname(__FILE__) . '/../../templates/';
        $operations = scandir($currentPath);

        $operations = array_filter($operations, function($v) {
            return $v != '.' && $v != '..';
        });

        return $operations;
    }

    public function __construct() {
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
            'operations' => $this->getOperations(),
            'activities' => Activity::all(),
            'sectors' => Sector::all()
        ));
    }

    public function getSearch() {
        $results = $this->getClient(Input::all());

        return View::make('clients.results', array(
            'results' => $results
        ));
    }

    public function postSearch() {
        $results = $this->getClient(Input::all());

        return View::make('clients.results', array(
            'results' => $results
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
