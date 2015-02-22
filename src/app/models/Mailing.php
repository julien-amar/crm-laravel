<?php

class Mailing extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mailings';

    public function Client()
    {
        return $this->hasOne('clients', 'id', 'client_id');
    }
}
