<?php defined('SYSPATH') or die('No direct script access.');

class Model_Application extends ORM {

	protected $_belongs_to = array(
		'clan' => array(),
		'user' => array(),
	);

}