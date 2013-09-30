<?php defined('SYSPATH') or die('No direct script access.');

class Model_Color extends ORM {

	protected $_has_many = array(
		'colors'     => array(),
	);

}