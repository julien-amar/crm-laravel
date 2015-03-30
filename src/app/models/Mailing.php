<?php

class Mailing extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mailings';

    public static $rules = array(
        'create' => array(
            'subject' => 'required|max:1024',
            'reference' => 'required|max:32',
            'message' => 'required',
        ),
    );

    public function Client()
    {
        return $this->hasOne('clients', 'id', 'client_id');
    }

    public function Uploads() {
        return $this->belongsToMany('Upload', 'mailings_uploads');
    }
}
