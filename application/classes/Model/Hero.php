<?php defined('SYSPATH') or die('No direct script access.');

class Model_Hero extends ORM {

	protected $_has_many = array(
		'matches_teams_users' => array(
			'model' => 'Match_Team_User'
		),
	);

}