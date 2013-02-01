<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Application {

	public function action_prijava()
	{
		Steam::login();

		$user = Model_User::find_by_attribute('steamid', Steam::id());

		if ($user === FALSE)
		{
			$summary = Steam::player_summary();

			$values = array(
				'steamid'    => $summary->steamid,
				'accountid'  => Steam::convert_id($summary->steamid),
				'username'   => $summary->personaname,
				'profileurl' => $summary->profileurl,
				'avatar'     => $summary->avatarfull,
				'status'     => $summary->personastate,
				'created_at' => DB::expr('NOW()'),
			);

			if (isset($summary->realname))
			{
				$values['name'] = $summary->realname;
			}

			if (isset($summary->loccountrycode))
			{
				$values['location'] = $summary->loccountrycode;
			}

			$result = Model_User::insert($values);
			$user   = Model_User::find($result[0]);

			Media_Avatar::cache($user->id, $values['avatar']);
		}

		Session::instance()->set('user', $user);
	}

	public function action_odjava()
	{
		Steam::logout();
		HTTP::redirect();
	}

}