<?php defined('SYSPATH') or die('No direct script access.');

class Model_Item extends Model_Database {

	public static $table_name = 'items';

	public static function populate($remote_items, $update)
	{
		$db = Database::instance();

		$db->begin();

		$changes['added']   = array();
		$changes['altered'] = array();

		foreach ($remote_items as $remote_item)
		{
			$item = self::find($remote_item->id);

			$image = 'http://media.steampowered.com/apps/dota2/images/items/'.substr($remote_item->name, 5).'_lg.png';

			if ($item === FALSE)
			{
				$changes['added'][] = $remote_item;

				self::insert(array(
					'id'             => $remote_item->id,
					'name'           => $remote_item->name,
					'localized_name' => $remote_item->localized_name,
					'image'          => $image,
				));

				Media_Item::cache($remote_item->id, $image);
			}
			else
			{
				foreach ($item as $key => $value)
				{
					if ($remote_item->{$key} != $value)
					{
						$changes['altered'][] = array('remote' => $remote_item, 'local' => $item);

						if ($update == TRUE)
						{
							self::update($remote_item->id, array(
								'name'           => $remote_item->name,
								'localized_name' => $remote_item->localized_name,
								'image'          => $image,
							));
						}

						break;
					}
				}
			}
		}

		if (empty($changes['altered']) OR $update == TRUE)
		{
			$db->commit();
		}

		if (empty($changes['added']) AND empty($changes['altered']))
		{
			$changes = FALSE;
		}

		return $changes;
	}

}