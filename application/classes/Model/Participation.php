<?php defined('SYSPATH') or die('No direct script access.');

class Model_Participation extends ORM {

	protected $_belongs_to = array(
		'clan'       => array(),
		'tournament' => array(),
	);

}