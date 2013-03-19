<?php defined('SYSPATH') or die('No direct script access.');

class Model_Request extends ORM {

	protected $_belongs_to = array(
		'user'  => array(),
		'giver' => array(
			'model'       => 'User',
			'foreign_key' => 'giver_id',
		),
	);

}