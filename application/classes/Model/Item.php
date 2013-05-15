<?php defined('SYSPATH') or die('No direct script access.');

class Model_Item extends ORM {

	protected $_has_many = array(
		'slots_as_0' => array(
			'model'       => 'Slot',
			'foreign_key' => 'item_0_id',
		),
		'slots_as_1' => array(
			'model'       => 'Slot',
			'foreign_key' => 'item_1_id',
		),
		'slots_as_2' => array(
			'model'       => 'Slot',
			'foreign_key' => 'item_2_id',
		),
		'slots_as_3' => array(
			'model'       => 'Slot',
			'foreign_key' => 'item_3_id',
		),
		'slots_as_4' => array(
			'model'       => 'Slot',
			'foreign_key' => 'item_4_id',
		),
		'slots_as_5' => array(
			'model'       => 'Slot',
			'foreign_key' => 'item_5_id',
		),
	);

	public static function populate($remote_items)
	{
		$changes = array(
			'added'   => array(),
			'altered' => array(),
		);

		foreach ($remote_items as $remote_item)
		{
			$item = ORM::factory('Item', array('name' => $remote_item->name));

			if ($item->loaded())
			{
				if ($remote_item->id != $item->remote_id)
				{
					$changes['altered'][] = array('remote' => $remote_item, 'local' => $item);

					$item->values(array(
						'remote_id' => $remote_item->id,
					))->update();
				}
			}
			else
			{
				$changes['added'][] = $remote_item;

				$image = 'http://media.steampowered.com/apps/dota2/images/items/'.substr($remote_item->name, 5).'_lg.png';

				$values = array(
					'name'           => $remote_item->name,
					'localized_name' => $remote_item->localized_name,
					'image'          => $image,
					'remote_id'      => $remote_item->id,
				);

				$item->values($values)->create();

				Media_Remote_Item::cache($item->id, $image);
			}
		}

		if (empty($changes['added']) AND empty($changes['altered']))
		{
			$changes = FALSE;
		}

		return $changes;
	}

}