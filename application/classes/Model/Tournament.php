<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tournament extends ORM {

	protected $_belongs_to = array(
		'mode'   => array(),
		'color'  => array(),
		'user'   => array(),
		'winner' => array(
			'model'       => 'Clan',
			'foreign_key' => 'winner_id',
		),
	);

	protected $_has_many = array(
		'clans' => array(
			'through' => 'participations',
		),
		'matches' => array(),
		'participations' => array(),
	);

	public function filters()
	{
		return array(
			'is_auto_approvable' => array(
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
			'name'      => 'naziv',
			'num_clans' => 'broj klanova',
		);
	}

	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			),
			'num_clans' => array(
				array('not_empty'),
				array('digit'),
				array('range', array(':value', 7, 33)),
			),
		);
	}

}