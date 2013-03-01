<?php defined('SYSPATH') or die('No direct script access.');

class Model_Slot extends ORM {

	protected $_belongs_to = array(
		'hero'   => array(),
		'item_0' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_0_id',
		),
		'item_1' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_1_id',
		),
		'item_2' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_2_id',
		),
		'item_3' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_3_id',
		),
		'item_4' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_4_id',
		),
		'item_5' => array(
			'model'       => 'Item',
			'foreign_key' => 'item_4_id',
		),
		'match'  => array(),
		'user'   => array(),
	);

}