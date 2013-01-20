<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Application {

	public function action_prijava()
	{
		Steam::login();

		$user = ORM::factory('user', array('steamid' => Steam::id()));

		if ( ! $user->loaded())
		{
			$summary = Steam::player_summary();

			$values = array(
				'steamid'    => $summary->steamid,
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

			$user->values($values)->create();
		}

		Session::instance()->set('user', $user);
	}

	public function action_odjava()
	{
		Steam::logout();
		HTTP::redirect();
	}

}