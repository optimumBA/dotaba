<?php defined('SYSPATH') or die('No direct script access.');

class Model_Item extends ORM {

	protected $_has_many = array(
		'matches_teams_users' => array(
			'model'   => 'Match_Team_User',
			'through' => 'matches_teams_users_items',
		),
		'matches_teams_users_items' => array(
			'model' => 'Match_Team_User_Item',
		),
	);

	public static function populate($remote_items, $update)
	{
		$db = Database::instance();

		$db->begin();

		$changes['added']   = array();
		$changes['altered'] = array();

		foreach ($remote_items as $remote_item)
		{
			$item = ORM::factory('item', $remote_item->id);

			$image = 'http://media.steampowered.com/apps/dota2/images/items/'.substr($remote_item->name, 5).'_lg.png';

			if ( ! $item->loaded())
			{
				$changes['added'][] = $remote_item;

				$item->values(array(
					'id'             => $remote_item->id,
					'name'           => $remote_item->name,
					'localized_name' => $remote_item->localized_name,
					'image'          => $image,
				))->create();

				Media_Item::cache($remote_item->id, $image);
			}
			else
			{
				foreach ($item as $key => $value)
				{
					if (strpos($key, '_') === 0)
						continue;

					if ($remote_item->{$key} != $value)
					{
						$changes['altered'][] = array('remote' => $remote_item, 'local' => $item);

						if ($update == TRUE)
						{
							$item->values(array(
								'name'           => $remote_item->name,
								'localized_name' => $remote_item->localized_name,
								'image'          => $image,
							))->update();
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