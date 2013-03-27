<?php defined('SYSPATH') or die('No direct script access.');

class Task_Users_Update extends Minion_Task {

	protected function _execute(array $params)
	{
		$count = ORM::factory('User')->count_all();

		$offset = 0;
		$limit  = 100;

		do {
			$users = ORM::factory('User')
				->limit($limit)
				->offset($offset)
				->find_all();

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
					$user = ORM::factory('User', array('steamid' => $summary->steamid));

					$values = array(
						'username'   => $summary->personaname,
						'name'       => (isset($summary->realname)) ? $summary->realname : NULL,
						'location'   => (isset($summary->loccountrycode)) ? $summary->loccountrycode : NULL,
						'profileurl' => $summary->profileurl,
						'avatar'     => $summary->avatarfull,
						'status'     => $summary->personastate,
					);

					if ($user->avatar != $summary->avatarfull)
					{
						Media_Remote_Avatar::cache($user->id, $summary->avatarfull);
					}

					$user->values($values)->update();
				}
			}

			$offset += $limit;
		} while ($offset < $count);
	}

}