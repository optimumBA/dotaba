<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Application {

	public function action_prijava()
	{
		Steam::login();

		$user = ORM::factory('user', array('steamid' => Steam::id()));

		if ( ! $user->loaded())
		{
			$summary = Steam::player_summary();

			$user->values(array(
				'steamid'    => $summary->steamid,
				'username'   => $summary->personaname,
				'name'       => $summary->realname,
				'profileurl' => $summary->profileurl,
				'avatar'     => $summary->avatar,
				'created_at' => DB::expr('NOW()'),
			))->create();
		}

		Session::instance()->set('user', $user);
	}

	public function action_odjava()
	{
		Steam::logout();
		HTTP::redirect();
	}

}