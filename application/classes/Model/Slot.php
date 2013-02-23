<?php defined('SYSPATH') or die('No direct script access.');

class Model_Slot extends ORM {

	protected $_belongs_to = array(
		'hero'   => array(),
		'item_0' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_0',
		),
		'item_0' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_0',
		),
		'item_1' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_1',
		),
		'item_2' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_2',
		),
		'item_3' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_3',
		),
		'item_4' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_4',
		),
		'match'  => array(),
		'user'   => array(),
	);

}