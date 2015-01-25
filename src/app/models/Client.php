<?php

class Client extends Eloquent {

	public static $rules = array(
		'create' => array(
		),

		'edit' => array(
		)
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'clients';

	private function sortCommentPredicate($a, $b)
	{
		return $a['created_at'] < $b['created_at'];
	}

	public function getComments() {
		$histories = $this->histories()->get();
		$mailings = $this->mailings()->get();

		foreach ($histories as $index => $value) {
			$value->type = 'History';
		}

		foreach ($mailings as $index => $value) {
			$value->type = 'Mailing';
		}

		$comments = array_merge($histories->toArray(), $mailings->toArray());
		
		usort($comments, array($this, "sortCommentPredicate"));

		return $comments;
	}

	public function histories() {
		return $this->hasMany('History');
	}

	public function mailings() {
		return $this->hasMany('Mailing');
	}

	public function sectors() {
		return $this->belongsToMany('Sector', 'clients_sectors');
	}

	public function activities() {
		return $this->belongsToMany('Activity', 'clients_activities');
	}
}
