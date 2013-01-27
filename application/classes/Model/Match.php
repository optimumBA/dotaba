<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match extends ORM {

	protected $_belongs_to = array(
		'mode'   => array(),
		'region' => array(),
		'winner' => array(
			'model'       => 'Team',
			'foreign_key' => 'winner_id',
		),
	);

	protected $_has_many = array(
		'teams' => array(
			'model'   => 'Team',
			'through' => 'matches_teams',
		),
	);

}