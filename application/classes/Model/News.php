<?php defined('SYSPATH') or die('No direct script access.');

class Model_News extends ORM {

	protected $_belongs_to = array(
		'user' => array(),
	);

	public function labels()
	{
		return array(
			'title'   => 'naslov',
			'content' => 'tekst',
			'source'  => 'izvor',
			'url'     => 'URL izvora',
		);
	}

	public function rules()
	{
		return array(
			'title' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			),
			'content' => array(
				array('not_empty'),
			),
			'source' => array(
				array('max_length', array(':value', 255)),
			),
			'url' => array(
				array('url'),
				array('max_length', array(':value', 255)),
			),
		);
	}

}