<?php defined('SYSPATH') or die('No direct script access.');

class Task_Users_Update extends Minion_Task {

	protected function _execute(array $params)
	{
		$count = Model_User::count_all();

		$offset = 0;
		$limit  = 100;

		do {
			$users = Model_User::find_all($limit, $offset)->find_all();

			for ($i = 0; $i < count($users); $i++)
			{
				if ($i === 0)
				{
					$ids = '';
				}
				else
				{
					$ids .= ',';
				}

				$ids .= $users[$i]->steamid;
			}

			if ($i > 0)
			{
				$summaries = Steam::players_summaries($ids);

				foreach ($summaries as $summary)
				{
					$user = Model_User::find_by_attribute('steamid', $summary->steamid);

					$values = array(
						'username'   => $summary->personaname,
						'profileurl' => $summary->profileurl,
						'avatar'     => $summary->avatarfull,
						'status'     => $summary->personastate,
					);

					if (isset($summary->realname))
					{
						$values['name'] = $summary->realname;
					}

					if (isset($summary->loccountrycode))
					{
						$values['location'] = $summary->loccountrycode;
					}

					if ($user->avatar != $summary->avatarfull)
					{
						Media_Avatar::cache($user->id, $summary->avatarfull);
					}

					Model_User::update($user->id, $values);
				}
			}

			$offset += $limit;
		} while ($offset < $count);
	}

}