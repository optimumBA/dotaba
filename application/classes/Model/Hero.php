<?php defined('SYSPATH') or die('No direct script access.');

class Model_Hero extends ORM {

	protected $_has_many = array(
		'slots' => array(),
	);

	public static function populate($remote_heroes, $update)
	{
		$db = Database::instance();

		$db->begin();

		$changes['added']   = array();
		$changes['altered'] = array();

		foreach ($remote_heroes as $remote_hero)
		{
			$hero = ORM::factory('hero', $remote_hero->id);

			$image = 'http://media.steampowered.com/apps/dota2/images/heroes/'.substr($remote_hero->name, 14).'_full.png';

			if ( ! $hero->loaded())
			{
				$changes['added'][] = $remote_hero;

				$hero->values(array(
					'id'             => $remote_hero->id,
					'name'           => $remote_hero->name,
					'localized_name' => $remote_hero->localized_name,
					'image'          => $image,
				))->create();

				Media_Remote_Hero::cache($remote_hero->id, $image);
			}
			else
			{
				foreach ($hero as $key => $value)
				{
					if (strpos($key, '_') === 0)
						continue;

					if ($remote_hero->{$key} != $value)
					{
						$changes['altered'][] = array('remote' => $remote_hero, 'local' => $hero);

						if ($update == TRUE)
						{
							$hero->values(array(
								'name'           => $remote_hero->name,
								'localized_name' => $remote_hero->localized_name,
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