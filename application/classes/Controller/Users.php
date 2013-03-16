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
				'name'       => (isset($summary->realname)) ? $summary->realname : NULL,
				'location'   => (isset($summary->loccountrycode)) ? $summary->loccountrycode : NULL,
				'profileurl' => $summary->profileurl,
				'avatar'     => $summary->avatarfull,
				'status'     => $summary->personastate,
				'created_at' => DB::expr('NOW()'),
			);

			$user->values($values)->create();

			Media_Remote_Avatar::cache($user->id, $values['avatar']);
		}

		$ban = $user->bans
			->where('expires_at', '>', DB::expr('NOW()'))
			->order_by('expires_at', 'DESC')
			->find();

		if ($ban->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Banovan/a si do '.date('j.n.Y. G:i:s', strtotime($ban->expires_at)).'. Razlog: '.$ban->reason.'.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect();
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

	public function action_view()
	{
		$user = ORM::factory('user')
			->with('clan')
			->with('featured_hero')
			->where('accountid', '=', $this->request->param('id'))
			->find();

		if ($user->loaded())
		{
			$matches = $user->matches
				->with('type')
				->with('tournament')
				->with('radiant_clan')
				->with('dire_clan')
				->with('mode')
				->where('processed', '=', TRUE)
				->find_all();

			$comments = Model_User::comments($user->id);

			$this->_layout  = 'news';
			$this->_title 	= $user->username;
			$this->_content = View::factory('users/view')
				->set('user', $user)
				->set('matches', $matches)
				->set('comments', $comments);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Igrač nije pronađen.');
		}
	}

}