<?php defined('SYSPATH') or die('No direct script access.');

class Model_Post extends ORM {

	protected $_belongs_to = array(
		'topic' => array(),
		'user'  => array(),
	);

}