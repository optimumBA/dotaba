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

	public function labels()
	{
		return array(
			'name' => 'naziv',
		);
	}

	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			),
			'tag' => array(
				array('not_empty'),
				array('max_length', array(':value', 15)),
			),
		);
	}

}