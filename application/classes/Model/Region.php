<?php defined('SYSPATH') or die('No direct script access.');

class Model_Region extends ORM {

	protected $_has_many = array(
		'matches' => array(),
	);

}