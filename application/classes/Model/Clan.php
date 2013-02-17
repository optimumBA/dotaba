<?php defined('SYSPATH') or die('No direct script access.');

class Model_Clan extends ORM {

	protected $_belongs_to = array(
		'lord' => array(
			'model'       => 'User',
			'foreign_key' => 'lord_id',
		),
	);

	protected $_has_many = array(
		'matches_teams' => array(
			'model' => 'Match_Team',
		),
		'users' => array(),
		'tournaments' => array(
			'through' => 'clans_tournaments',
		),
	);

}