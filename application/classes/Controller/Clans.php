<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Clans extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$count = ORM::factory('clan')->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $count,
		));

		$clans = ORM::factory('clan')
			->with('lord')
			->order_by('created_at', 'DESC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();

		$this->_title 	= 'Klanovi';
		$this->_content = View::factory('clans/index')
			->set('clans', $clans)
			->set('pagination', $pagination);
	}

	public function action_view()
	{
		$clan = ORM::factory('clan', $this->request->param('id'))
			->with('lord');

		if ($clan->loaded())
		{
			$users = $clan->users->find_all();

			$this->_title 	= $clan->name;
			$this->_content = View::factory('clans/view')
				->set('clan', $clan)
				->set('users', $users);
		}
	}

	public function action_napravi()
	{
		if ($this->_user)
		{
			if ($this->_post)
			{
				try
				{
					$this->_post['lord_id']    = $this->_user->id;
					$this->_post['created_at'] = DB::expr('NOW()');

					$clan = ORM::factory('clan')
						->values($this->_post, array('name', 'tag', 'lord_id', 'created_at'))
						->create();

					$this->_user->values(array('clan_id' => $clan->id))->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Klan je uspješno napravljen.',
					);

					Session::instance()->set('messages', $this->_messages);

					HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name));
				}
				catch (ORM_Validation_Exception $e)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nepravilan unos.',
					);

					$errors = $e->errors('models');
				}
			}

			$this->_title   = 'Napravi klan';
			$this->_content = View::factory('clans/napravi')
				->set('values', $this->_post)
				->set('errors', (isset($errors)) ? $errors : array());
		}
	}

	public function action_izmijeni()
	{
		$clan = ORM::factory('clan', $this->request->param('id'));

		if ($clan->loaded() AND $this->_user AND $clan->lord_id == $this->_user->id)
		{
			if ($this->_post)
			{
				try
				{
					$this->_post['updated_at'] = DB::expr('NOW()');

					$clan->values($this->_post, array('name', 'tag', 'lord_id', 'updated_at'))
						->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Klan je uspješno izmijenjen.',
					);

					Session::instance()->set('messages', $this->_messages);

					HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name));
				}
				catch (ORM_Validation_Exception $e)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nepravilan unos.',
					);

					$errors = $e->errors('models');
				}
			}

			$users = $clan->users->find_all();

			$users_array = array();

			foreach ($users as $user)
			{
				$users_array[$user->id] = $user->username;
			}

			$this->_title   = 'Izmijeni klan - '.$clan->name;
			$this->_content = View::factory('clans/izmijeni')
				->set('values', (empty($this->_post)) ? $clan->as_array() : $this->_post)
				->set('errors', (isset($errors)) ? $errors : array())
				->set('clan', $clan)
				->set('users', $users_array);
		}
	}

}