<?php defined('SYSPATH') or die('No direct script access.');

class Model_Comment extends ORM {

	protected $_belongs_to = array(
		'user' => array(),
	);

	public function labels()
	{
		return array(
			'body' => 'tekst',
		);
	}

	public function rules()
	{
		return array(
			'body' => array(
				array('not_empty'),
			),
		);
	}

}