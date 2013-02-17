<?php defined('SYSPATH') or die('No direct script access.');

class Model_Ban extends ORM {

	protected $_belongs_to = array(
		'user'        => array(),
		'executioner' => array(
			'model'       => 'User',
			'foreign_key' => 'executioner_id',
		),
	);

}