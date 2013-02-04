<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match_Team_User_Item extends ORM {

	protected $_table_name = 'matches_teams_users_items';

	protected $_belongs_to = array(
		'item'            => array(),
		'match_team_user' => array(),
	);

}