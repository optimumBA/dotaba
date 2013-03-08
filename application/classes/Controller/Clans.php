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
		$clan = ORM::factory('clan')
			->with('lord')
			->where('clan.id', '=', $this->request->param('id'))
			->find();

		if ($clan->loaded())
		{
			$users = $clan->users->find_all();

			$matches = ORM::factory('match')
				->with('type')
				->with('tournament')
				->with('radiant_clan')
				->with('dire_clan')
				->with('mode')
				->where('radiant_clan_id', '=', $clan->id)
				->or_where('dire_clan_id', '=', $clan->id)
				->find_all();

			$this->_title 	= $clan->name;
			$this->_content = View::factory('clans/view')
				->set('clan', $clan)
				->set('users', $users)
				->set('matches', $matches);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

	public function action_napravi()
	{
		if ($this->_user->clan_id === NULL)
		{
			if ($this->_post)
			{
				try
				{
					$files = Media_Local_Clan::validate($_FILES);

					if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
					{
						$this->_post['lord_id']    = $this->_user->id;
						$this->_post['created_at'] = DB::expr('NOW()');

						$clan = ORM::factory('clan')
							->values($this->_post, array('name', 'tag', 'lord_id', 'created_at'))
							->create();

						$this->_user->values(array('clan_id' => $clan->id))->update();

						Media_Local_Clan::save($clan->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Klan je uspješno napravljen.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name));
					}
					else
					{
						$this->_messages[] = array(
							'type'  => 'error',
							'value' => 'Nepravilan unos.',
						);

						$errors = $files->errors('media');
					}
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
		else
		{
			$clan = ORM::factory('clan', $this->_user->clan_id);

			$this->_messages[] = array(
				'type'  => 'alert',
				'value' => 'Već imaš klan.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name));
		}
	}

	public function action_izmijeni()
	{
		$clan = ORM::factory('clan', $this->request->param('id'));

		if ($clan->loaded() AND $clan->lord_id == $this->_user->id)
		{
			if ($this->_post)
			{
				try
				{
					$files = Media_Local_Clan::validate($_FILES);

					if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
					{
						$this->_post['updated_at'] = DB::expr('NOW()');

						$clan->values($this->_post, array('name', 'tag', 'lord_id', 'updated_at'))
							->update();

						Media_Local_Clan::save($clan->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Klan je uspješno izmijenjen.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name));
					}
					else
					{
						$this->_messages[] = array(
							'type'  => 'error',
							'value' => 'Nepravilan unos.',
						);

						$errors = $files->errors('media');
					}
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
				->set('users', $users_array);
		}
		elseif ($clan->loaded())
		{
			$clan = ORM::factory('clan', $this->_user->clan_id);

			$this->_messages[] = array(
				'type'  => 'alert',
				'value' => 'Nisi lord ovog klana.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

}