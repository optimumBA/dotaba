<?php defined('SYSPATH') or die('No direct script access.');

class Model_Topic extends ORM {

	protected $_belongs_to = array(
		'main_post' => array(
			'model'       => 'Post',
			'foreign_key' => 'main_post_id',
		),
		'user' => array(),
	);

	protected $_has_many = array(
		'posts' => array(),
	);

	public function filters()
	{
		return array(
			'is_hidden' => array(
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
		);
	}

}