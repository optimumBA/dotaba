<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Application {

	public function action_prijava()
	{
		$this->_user->login();

		$ban = $this->_user->bans
			->where('expires_at', '>', DB::expr('NOW()'))
			->order_by('expires_at', 'DESC')
			->find();

		if ($ban->loaded())
		{
			$this->_user->logout();

			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Banovan/a si do '.date('j.n.Y. G:i:s', strtotime($ban->expires_at)).'. Razlog: '.$ban->reason.'.',
			);

			$this->redirect();
		}

		$uri = Session::instance()->get('redirect');

		if ($uri)
		{
			$this->redirect($uri);
		}
		else
		{
			$this->redirect();
		}
	}

	public function action_odjava()
	{
		$this->_user->logout();
		$this->redirect();
	}

	public function action_index()
	{
		$count = ORM::factory('User')->count_all();

		$pagination = Pagination::factory(array(
			'total_items'    => $count,
			'items_per_page' => 20,
		));
		
		$users = ORM::factory('User')
			->with('clan')
			->order_by('created_at', 'ASC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();
			
		$this->_layout	= 'news';
		$this->_title	= 'Pregled igrača';
		$this->_content	= View::factory('users/index')
			->set('users', $users)
			->set('pagination', $pagination);
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

			$this->_layout  = 'news';
			$this->_title 	= $user->username;
			$this->_content = View::factory('users/view')
				->set('user', $user)
				->set('slots', $slots);

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
			if ($this->_user->cannot('update', $user))
			{
				$this->deny_access();
			}

			$user->values($this->_post, array('featured_hero_id'))->update();

			$this->_messages[] = array(
				'type'  => 'success',
				'value' => 'Profil je izmijenjen.',
			);

			$this->redirect('igraci/'.$user->accountid);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Igrač nije pronađen.');
		}
	}


}