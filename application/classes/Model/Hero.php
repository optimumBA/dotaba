<?php defined('SYSPATH') or die('No direct script access.');

class Model_Hero extends ORM {

	protected $_has_many = array(
		'slots' => array(),
		'users' => array(
			'foreign_key' => 'featured_hero_id',
		),
	);

	public static function populate($remote_heroes)
	{
		$changes = array(
			'added'   => array(),
			'altered' => array(),
		);

		foreach ($remote_heroes as $remote_hero)
		{
			$hero = ORM::factory('Hero', array('name' => $remote_hero->name));

			if ($hero->loaded())
			{
				if ($remote_hero->id != $hero->remote_id)
				{
					$changes['altered'][] = array('remote' => $remote_hero, 'local' => $hero);

					$hero->values(array(
						'remote_id' => $remote_hero->id,
					))->update();
				}
			}
			else
			{
				$changes['added'][] = $remote_hero;

				$image = 'http://media.steampowered.com/apps/dota2/images/heroes/'.substr($remote_hero->name, 14).'_full.png';

				$values = array(
					'name'           => $remote_hero->name,
					'localized_name' => $remote_hero->localized_name,
					'image'          => $image,
					'remote_id'      => $remote_hero->id,
				);

				$hero->values($values)->create();

				Media_Remote_Hero::cache($hero->id, $image);
			}
		}

		if (empty($changes['added']) AND empty($changes['altered']))
		{
			$changes = FALSE;
		}

		return $changes;
	}

}