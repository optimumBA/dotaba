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
		'stream'       => array(),
		'tournament'   => array(),
		'type'         => array(),
		'winner'       => array(
			'model'       => 'Team',
			'foreign_key' => 'winner_id',
		),
	);

	protected $_has_many = array(
		'picksbans'     => array(),
		'slots'         => array(),
		'users' => array(
			'through' => 'slots',
		),
	);

	public function filters()
	{
		return array(
			'date' => array(
				array(
					function($value)
					{
						return ($value) ? $value : NULL;
					}
				),
			),
		);
	}

	public function labels()
	{
		return array(
			'radiant_clan_id' => 'Radiant',
			'dire_clan_id'    => 'Dire',
			'date'            => 'vrijeme odigravanja',
		);
	}

	public function rules()
	{
		return array(
			'date' => array(
				array('exact_length', array(':value', 19)),
				array('date'),
			),
		);
	}

	public static function process($mid, $result, $type)
	{
		$db = Database::instance();

		try
		{
			$db->begin();

			if ($result->lobby_type != $type->lobby_type)
				return FALSE;

			$match = ORM::factory('Match', array('mid' => $mid));

			if ( ! $match->loaded())
			{
				$match->values(array(
					'mid'                     => $mid,
					'type_id'                 => $type->id,
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
					'created_at'              => DB::expr('NOW()'),
					'updated_at'              => DB::expr('NOW()'),
				))->create();

				if (isset($result->picks_bans))
				{
					$count = ORM::factory('Pickban')
						->where('match_id', '=', $match->id)
						->count_all();

					if ($count == 0)
					{
						foreach ($result->picks_bans as $pick_ban)
						{
							$hero = ORM::factory('Hero', array('remote_id' => $pick_ban->hero_id));

							$values = array(
								'match_id' => $match->id,
								'is_pick'  => $pick_ban->is_pick,
								'hero_id'  => $hero->id,
								'team'     => $pick_ban->team,
								'order'    => $pick_ban->order,
							);

							ORM::factory('Pickban')->values($values)->create();
						}
					}
				}
			}

			foreach ($result->players as $player)
			{
				$user = ORM::factory('User', array('accountid' => $player->account_id));

				if ( ! $user->loaded())
					continue;

				$slot = ORM::factory('Slot', array(
					'match_id' => $match->id,
					'user_id'  => $user->id
				));

				if ($slot->loaded())
					continue;

				$hero = ORM::factory('Hero', array('remote_id' => $player->hero_id));

				$values = array(
					'match_id'      => $match->id,
					'user_id'       => $user->id,
					'player_slot'   => Steam::convert_player_slot($player->player_slot),
					'hero_id'       => $hero->id,
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

				for ($i = 0; $i < 6; $i++)
				{
					$values['item_'.$i.'_id'] = ORM::factory('Item', array('remote_id' => $player->{'item_'.$i}))->id;
				}

				$slot->values($values)->create();

				if ($slot->leaver_status == 3)
				{
					$user->values(array('abandons' => DB::expr('abandons + 1')));
				}
				elseif ((int) ($slot->player_slot / 5) == $match->radiant_win)
				{
					$user->values(array('losses' => DB::expr('losses + 1')));
				}
				else
				{
					$user->values(array('wins' => DB::expr('wins + 1')));
				}

				$user->update();
			}

			$db->commit();
		}
		catch (Exception $e)
		{
			$db->rollback();
		}
	}

}