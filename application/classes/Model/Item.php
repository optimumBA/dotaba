<?php defined('SYSPATH') or die('No direct script access.');

class Model_Item extends ORM {

	protected $_has_many = array(
		'matches_teams_users' => array(
			'model'   => 'Match_Team_User',
			'through' => 'matches_teams_users_items',
			'far_key' => 'match_team_user_id',
		),
	);

}