<?php defined('SYSPATH') or die('No direct script access.');

class Model_Announcement extends ORM {

	protected $_belongs_to = array(
		'match'  => array(),
		'stream' => array(),
	);

}