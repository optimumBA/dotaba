<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match extends ORM {

	protected $_belongs_to = array(
		'mode'   => array(),
		'winner' => array(
			'model'       => 'Team',
			'foreign_key' => 'winner_id',
		),
	);

	public static function match_details($id)
	{
		$match = ORM::factory('match')
			->with('winner')
			->with('mode')
			->find($id)
			->as_array();

		$teams = ORM::factory('match_team')
			->with('team')
			->where('match_id', '=', $match['id'])
			->find_all();

		for ($i = 0; $i < count($teams); $i++)
		{
			$match['teams'][$i] = $teams[$i]->as_array();
			$players = ORM::factory('match_team_user')
				->with('user')
				->with('hero')
				->where('match_team_id', '=', $match['teams'][$i]['id'])
				->find_all();

			for ($j = 0; $j < count($players); $j++)
			{
				$match['teams'][$i]['players'][$j] = $players[$j]->as_array();
				$items = ORM::factory('match_team_user_item')
					->with('item')
					->where('match_team_user_id', '=', $match['teams'][$i]['players'][$j]['id'])
					->find_all();

				for ($k = 0; $k < count($items); $k++)
				{
					$match['teams'][$i]['players'][$j]['items'][$k] = $items[$k]->as_array();
				}

				unset($items);
			}

			unset($players);
		}

		unset($teams);

		return json_decode(json_encode($match));
	}

	public static function process($id, $result)
	{
		$players = array();
		$users   = array();

		foreach ($result->players as $player)
		{
			if ($player->player_slot < 0 OR $player->player_slot > 4 AND $player->player_slot < 128 OR $player->player_slot > 132)
				continue;

			$user = ORM::factory('user', array('accountid' => $player->account_id));

			if ( ! $user->loaded())
				ORM::factory('user')->values(array('accountid' => $player->account_id))->create();//return FALSE;

			$players[] = $player;
			$users[]   = $user;
		}

		$db = Database::instance();

		try
		{
			$db->begin();

			$match = ORM::factory('match', $id)
				->values(array(
					'winner_id'        => ($result->radiant_win === TRUE) ? 1 : 2,
					'mode_id'          => $result->game_mode,
					'duration'         => $result->duration,
					'first_blood_time' => $result->first_blood_time,
					'date'             => date('Y-m-d H:i:s', $result->start_time),
				))->update();

			$match_team[1] = ORM::factory('match_team')
				->values(array(
					'match_id'        => $id,
					'team_id'         => 1,
					'tower_status'    => $result->tower_status_radiant,
					'barracks_status' => $result->barracks_status_radiant,
				))->create();

			$match_team[2] = ORM::factory('match_team')
				->values(array(
					'match_id'        => $id,
					'team_id'         => 2,
					'tower_status'    => $result->tower_status_dire,
					'barracks_status' => $result->barracks_status_dire,
				))->create();

			for ($i = 0; $i < count($players); $i++)
			{
				$team_id = ($players[$i]->player_slot <= 4) ? 1 : 2;

				$match_team_user = ORM::factory('match_team_user')
					->values(array(
						'match_team_id' => $match_team[$team_id]->id,
						'user_id'       => $users[$i]->id,
						'player_slot'   => $players[$i]->player_slot,
						'hero_id'       => $players[$i]->hero_id,
						'kills'         => $players[$i]->kills,
						'deaths'        => $players[$i]->deaths,
						'assists'       => $players[$i]->assists,
						'leaver_status' => $players[$i]->leaver_status,
						'gold'          => $players[$i]->gold,
						'last_hits'     => $players[$i]->last_hits,
						'denies'        => $players[$i]->denies,
						'gold_per_min'  => $players[$i]->gold_per_min,
						'xp_per_min'    => $players[$i]->xp_per_min,
						'gold_spent'    => $players[$i]->gold_spent,
						'hero_damage'   => $players[$i]->hero_damage,
						'tower_damage'  => $players[$i]->tower_damage,
						'hero_healing'  => $players[$i]->hero_healing,
						'level'         => $players[$i]->level,
					))->create();

				for ($j = 0; $j <= 5; $j++)
				{
					$item_id = $players[$i]->{'item_'.$j};

					if ($item_id === 0)
						continue;

					ORM::factory('match_team_user_item')
						->values(array(
							'match_team_user_id' => $match_team_user->id,
							'item_id'            => $item_id,
							'slot'               => $j,
						))->create();
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