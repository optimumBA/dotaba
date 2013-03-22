<?php defined('SYSPATH') or die('No direct script access.');

class Model_Topic extends ORM {

	protected $_belongs_to = array(
		'user' => array(),
	);

	protected $_has_many = array(
		'posts' => array(),
	);

}