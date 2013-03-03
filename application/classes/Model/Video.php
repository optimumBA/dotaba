<?php defined('SYSPATH') or die('No direct script access.');

class Model_Video extends ORM {

	protected $_belongs_to = array(
		'user' => array(),
	);

	public function labels()
	{
		return array(
			'name' => 'naziv',
			'vid'  => 'YouTube ID',
		);
	}

	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			),
			'vid' => array(
				array('not_empty'),
				array('alpha_numeric'),
				array('exact_length', array(':value', 11)),
			),
		);
	}

}