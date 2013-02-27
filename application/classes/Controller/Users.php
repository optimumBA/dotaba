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

			$user->values($values)->create();

			Media_Remote_Avatar::cache($user->id, $values['avatar']);
		}

		Session::instance()->set('user', $user);

		$uri = Session::instance()->get('redirect');

		if ($uri)
		{
			HTTP::redirect($uri);
		}
		else
		{
			HTTP::redirect();
		}
	}

	public function action_odjava()
	{
		Steam::logout();
		HTTP::redirect();
	}

}