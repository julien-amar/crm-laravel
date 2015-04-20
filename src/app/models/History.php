<?php

class History extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'histories';

    public function user()
    {
        return $this->hasOne('user', 'id', 'user_id');
    }
}
