<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mode extends ORM {

	protected $_has_many = array(
		'matches'     => array(),
		'tournaments' => array(),
	);

}