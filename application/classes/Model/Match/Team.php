<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match_Team extends ORM {

	protected $_table_name = 'matches_teams';

	protected $_belongs_to = array(
		'clan'  => array(),
		'match' => array(),
		'team'  => array(),
	);

	protected $_has_many = array(
		'users' => array(
			'model'   => 'User',
			'through' => 'matches_teams_users',
		),
	);

}