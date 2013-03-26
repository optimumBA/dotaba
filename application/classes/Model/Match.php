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
		'announcements' => array(),
		'picksbans'     => array(),
		'slots'         => array(),
		'streams'       => array(
			'through' => 'announcements',
		),
		'users' => array(
			'through' => 'slots',
		),
	);

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
					'processed'               => TRUE,
				))->update();

			foreach ($result->players as $player)
			{
				$user = ORM::factory('user', array('accountid' => $player->account_id));

				if ( ! $user->loaded())
					continue;

				$slot = ORM::factory('slot', array(
					'match_id' => $match->id,
					'user_id'  => $user->id
				));

				if ($slot->loaded())
					continue;

				$values = array(
					'match_id'      => $match->id,
					'user_id'       => $user->id,
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

				$slot->values($values)->create();
			}

			if (isset($result->picks_bans))
			{
				$count = ORM::factory('pickban')
					->where('match_id', '=', $match->id)
					->count_all();

				if ($count == 0)
				{
					foreach ($result->picks_bans as $pick_ban)
					{
						$values = array(
							'match_id' => $match->id,
							'is_pick'  => $pick_ban->is_pick,
							'hero_id'  => $pick_ban->hero_id,
							'team'     => $pick_ban->team,
							'order'    => $pick_ban->order,
						);

						ORM::factory('pickban')->values($values)->create();
					}
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