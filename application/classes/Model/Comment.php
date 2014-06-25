<?php defined('SYSPATH') or die('No direct script access.');

class Model_Comment extends ORM {

	protected $_belongs_to = array(
		'user'   => array(),
		'parent' => array(
			'model'       => 'Comment',
			'foreign_key' => 'parent_id',
		),
	);

	protected $_has_many = array(
		'children' => array(
			'model'       => 'Comment',
			'foreign_key' => 'parent_id',
		),
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