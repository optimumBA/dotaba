<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tournament extends ORM {

	protected $_belongs_to = array(
		'user' => array(),
	);

	protected $_has_many = array(
		'matches' => array(),
		'clans' => array(
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
		);
	}

}