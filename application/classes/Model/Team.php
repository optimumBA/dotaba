<?php defined('SYSPATH') or die('No direct script access.');

class Model_Team extends ORM {

	protected $_has_many = array(
		'matches_won' => array(
			'model'       => 'Match',
			'foreign_key' => 'winner_id',
		),
		'matches' => array(
			'model'   => 'Match',
			'through' => 'matches_teams',
		),
	);

}