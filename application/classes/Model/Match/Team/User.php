<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match_Team_User extends ORM {

	protected $_table_name = 'matches_teams_users';

	protected $_belongs_to = array(
		'hero'       => array(),
		'match_team' => array(),
		'user'       => array(),
	);

	protected $_has_many = array(
		'items' => array(
			'model'   => 'Item',
			'through' => 'matches_teams_users_items',
		),
	);

}