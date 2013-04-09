<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Application {

	public function action_prijava()
	{
		$user = User::instance()->login();

		$ban = $user->bans
			->where('expires_at', '>', DB::expr('NOW()'))
			->order_by('expires_at', 'DESC')
			->find();

		if ($ban->loaded())
		{
			$user->logout();

			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Banovan/a si do '.date('j.n.Y. G:i:s', strtotime($ban->expires_at)).'. Razlog: '.$ban->reason.'.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect();
		}

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
		User::instance()->logout();
		HTTP::redirect();
	}

	public function action_view()
	{
		$user = ORM::factory('User')
			->with('clan')
			->with('featured_hero')
			->where('accountid', '=', $this->request->param('id'))
			->find();

		if ($user->loaded())
		{
			$slots = $user->slots
				->with('hero')
				->with('match')
				->with('match:type')
				->with('match:tournament')
				->with('match:radiant_clan')
				->with('match:dire_clan')
				->with('match:mode')
				->order_by('match.date', 'DESC')
				->where('match.id', 'IS NOT', NULL)
				->find_all();

			$comments = Model_User::comments($user->id);

			$this->_layout  = 'news';
			$this->_title 	= $user->username;
			$this->_content = View::factory('users/view')
				->set('user', $user)
				->set('slots', $slots)
				->set('comments', $comments);

			if ($user->id == $this->_user->id)
			{
				$heroes = ORM::factory('Hero')
					->order_by('localized_name')
					->find_all();

				$heroes_array = array();

				foreach ($heroes as $hero)
				{
					$heroes_array[$hero->id] = $hero->localized_name;
				}

				$this->_content->set('heroes', $heroes_array);
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Igrač nije pronađen.');
		}
	}

	public function action_izmijeni()
	{
		$user = ORM::factory('User')
			->where('accountid', '=', $this->request->param('id'))
			->find();

		if ($user->loaded())
		{
			if ($user->id == $this->_user->id)
			{
				$user->values($this->_post, array('featured_hero_id'))->update();
			}

			HTTP::redirect('igraci/'.$user->accountid);
		}
		else
		{
			HTTP::redirect();
		}
	}


}