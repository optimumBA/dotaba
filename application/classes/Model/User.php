<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends ORM {

	protected $_has_many = array(
		'matches_teams' => array(
			'model'   => 'Team_Match',
			'through' => 'matches_teams_users',
		),
	);

}