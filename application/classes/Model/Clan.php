<?php defined('SYSPATH') or die('No direct script access.');

class Model_Clan extends ORM {

	protected $_belongs_to = array(
		'lord' => array(
			'model'       => 'User',
			'foreign_key' => 'lord_id',
		),
	);

	protected $_has_many = array(
		'applications' => array(),
		'matches_as_radiant' => array(
			'model'       => 'Match',
			'foreign_key' => 'radiant_clan_id',
		),
		'matches_as_dire' => array(
			'model'       => 'Match',
			'foreign_key' => 'dire_clan_id',
		),
		'participations' => array(),
		'users' => array(),
		'tournaments' => array(
			'through' => 'participations',
		),
	);

	public function filters()
	{
		return array(
			'open' => array(
				array(
					function($value)
					{
						return (bool) $value;
					}
				),
			),
		);
	}

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