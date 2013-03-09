<?php defined('SYSPATH') or die('No direct script access.');

class Model_PickBan extends ORM {

	protected $_belongs_to = array(
		'hero'  => array(),
		'match' => array(),
	);

}