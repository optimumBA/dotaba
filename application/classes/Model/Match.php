<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match extends ORM {

	protected $_belongs_to = array(
		'radiant_clan' => array(
			'model'       => 'Clan',
			'foreign_key' => 'radiant_clan_id',
		),
		'dire_clan' => array(
			'model'       => 'Clan',
			'foreign_key' => 'dire_clan_id',
		),
		'mode'         => array(),
		'tournament'   => array(),
		'type'         => array(),
		'winner'       => array(
			'model'       => 'Team',
			'foreign_key' => 'winner_id',
		),
	);

	protected $_has_many = array(
		'slots' => array(),
		'users' => array(
			'through' => 'slots',
		),
	);

	public static function details($id)
	{
		$match = ORM::factory('match')
			->with('type')
			->with('tournament')
			->with('radiant_clan')
			->with('dire_clan')
			->with('mode')
			->find($id);

		if ( ! $match->loaded())
		{
			return FALSE;
		}

		$slots = $match->slots
			->with('user')
			->with('hero')
			->with('item_0')
			->with('item_1')
			->with('item_2')
			->with('item_3')
			->with('item_4')
			->with('item_5')
			->find_all();

		$match = $match->as_array();

		$match['radiant_slots'] = array();
		$match['dire_slots']    = array();

		foreach ($slots as $slot)
		{
			$team = ($slot->player_slot <= 4) ? 'radiant' : 'dire';

			$match[$team.'_slots'][] = $slot->as_array();
		}

		unset($slots);

		return json_decode(json_encode($match));
	}

	public static function process($id, $result)
	{
		$db = Database::instance();

		try
		{
			$db->begin();

			$match = ORM::factory('match', $id)
				->values(array(
					'mode_id'                 => $result->game_mode,
					'cluster'                 => $result->cluster,
					'radiant_win'             => $result->radiant_win,
					'tower_status_radiant'    => $result->tower_status_radiant,
					'tower_status_dire'       => $result->tower_status_dire,
					'barracks_status_radiant' => $result->barracks_status_radiant,
					'barracks_status_dire'    => $result->barracks_status_dire,
					'human_players'           => $result->human_players,
					'duration'                => $result->duration,
					'first_blood_time'        => $result->first_blood_time,
					'date'                    => date('Y-m-d H:i:s', $result->start_time),
					'updated_at'              => DB::expr('NOW()'),
				))->update();

			foreach ($result->players as $player)
			{
				$user = ORM::factory('user', array('accountid' => $player->account_id));

				if ( ! $user->loaded())
					continue;

				$values = array(
					'player_slot'   => Steam::convert_player_slot($player->player_slot),
					'hero_id'       => $player->hero_id,
					'item_0_id'     => $player->item_0,
					'item_1_id'     => $player->item_1,
					'item_2_id'     => $player->item_2,
					'item_3_id'     => $player->item_3,
					'item_4_id'     => $player->item_4,
					'item_5_id'     => $player->item_5,
					'kills'         => $player->kills,
					'deaths'        => $player->deaths,
					'assists'       => $player->assists,
					'leaver_status' => $player->leaver_status,
					'gold'          => $player->gold,
					'last_hits'     => $player->last_hits,
					'denies'        => $player->denies,
					'gold_per_min'  => $player->gold_per_min,
					'xp_per_min'    => $player->xp_per_min,
					'gold_spent'    => $player->gold_spent,
					'hero_damage'   => $player->hero_damage,
					'tower_damage'  => $player->tower_damage,
					'hero_healing'  => $player->hero_healing,
					'level'         => $player->level,
				);

				$slot = ORM::factory('slot', array(
					'match_id' => $match->id,
					'user_id'  => $user->id
				));

				if ($slot->loaded())
				{
					$slot->values($values)->update();
				}
				else
				{
					$values = array_merge($values, array(
						'match_id' => $match->id,
						'user_id'  => $user->id,
					));

					$slot->values($values)->create();
				}
			}

			$db->commit();
		}
		catch (Exception $e)
		{
			$db->rollback();
		}
	}

}