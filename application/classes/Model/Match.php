<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match extends Model_Database {

	public static $table_name = 'matches';

	private static $processed;

	public static function find_all_processed($limit = NULL, $offset = NULL, $order_by = NULL)
	{
		self::$processed = TRUE;
		return self::find_all($limit, $offset, $order_by);
	}

	public static function find_all_unprocessed($limit = NULL, $offset = NULL, $order_by = NULL)
	{
		self::$processed = FALSE;
		return self::find_all($limit, $offset, $order_by);
	}

	public static function find_all($limit = NULL, $offset = NULL, $order_by = NULL)
	{
		$processed = self::$processed;

		self::$processed = NULL;

		if ($processed === NULL)
		{
			return parent::find_all($limit, $offset, $order_by);
		}
		else
		{
			$operator = 'IS';

			$operator .= ($processed === TRUE) ? ' NOT' : '';

			$rows = DB::select()
				->from(self::$table_name)
				->limit($limit)
				->offset($offset)
				->where('winner_id', $operator, NULL);

			if (is_array($order_by))
			{
				$rows->order_by($order_by[0], $order_by[1]);
			}

			return $rows->as_object()
				->execute();
		}
	}

	public static function process($id, $result)
	{
		$players = array();

		foreach ($result->players as $player)
		{
			if ($player->player_slot < 0 OR $player->player_slot > 4 AND $player->player_slot < 128 OR $player->player_slot > 132)
				continue;

			$user = Model_User::find_by_attribute('accountid', $player->account_id);

			if ($user === FALSE)
				return FALSE;

			$players[] = $player;
		}

		$db = Database::instance();

		try
		{
			$db->begin();

			self::update($id, array(
				'winner_id'        => ($result->radiant_win === TRUE) ? 1 : 2,
				'mode_id'          => $result->game_mode,
				'duration'         => $result->duration,
				'first_blood_time' => $result->first_blood_time,
				'date'             => date('Y-m-d H:i:s', $result->starttime),
			));

			$match_team[1] = Model_Match_Team::insert(array(
				'match_id'        => $id,
				'team_id'         => 1,
				'tower_status'    => $result->tower_status_radiant,
				'barracks_status' => $result->barracks_status_radiant,
			));

			$match_team[2] = Model_Match_Team::insert(array(
				'match_id'        => $id,
				'team_id'         => 2,
				'tower_status'    => $result->tower_status_dire,
				'barracks_status' => $result->barracks_status_dire,
			));

			foreach ($players as $player)
			{
				$team_id = ($player->player_slot <= 4) ? 1 : 2;

				$user = Model_User::find_by_attribute('accountid', $player->account_id);

				$result = Model_Match_Team_User::insert(array(
					'match_team_id' => $match_team[$team_id][0],
					'user_id'       => $user->id,
					'player_slot'   => $player->player_slot,
					'hero_id'       => $player->hero_id,
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
				));

				for ($i = 0; $i <= 5; $i++)
				{
					$item_id = $player->{'item_'.$i};

					if ($item_id === 0)
						continue;

					Model_Match_Team_User_Item::insert(array(
						'match_team_user_id' => $result[0],
						'item_id'            => $item_id,
						'slot'               => $i,
					));
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