<?php defined('SYSPATH') or die('No direct script access.');

class Model_Post extends ORM {

	protected $_belongs_to = array(
		'topic' => array(),
		'user'  => array(),
	);

	public function labels()
	{
		return array(
			'content' => 'tekst',
		);
	}

	public function rules()
	{
		return array(
			'content' => array(
				array('not_empty'),
			),
		);
	}

}