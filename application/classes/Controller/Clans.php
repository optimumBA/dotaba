<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Clans extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$count = ORM::factory('Clan')->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $count,
		));

		$clans = ORM::factory('Clan')
			->with('lord')
			->order_by('id', 'DESC')
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
		$clan = ORM::factory('Clan')
			->with('lord')
			->where('clan.id', '=', $this->request->param('id'))
			->find();

		if ($clan->loaded())
		{
			$users = $clan->users->find_all();

			$matches = ORM::factory('Match')
				->with('type')
				->with('tournament')
				->with('radiant_clan')
				->with('dire_clan')
				->with('mode')
				->where_open()
				->or_where('radiant_clan_id', '=', $clan->id)
				->or_where('dire_clan_id', '=', $clan->id)
				->where_close()
				->find_all();

			if ($can_apply = ($clan->open AND $this->_user->clan_id === NULL AND $this->_user->can('create', 'Applications')))
			{
				$application = $this->_user->applications
					->where('clan_id', '=', $clan->id)
					->count_all();

				$can_apply = ($application == 0);
			}

			$this->_title 	= $clan->name;
			$this->_content = View::factory('clans/view')
				->set('clan', $clan)
				->set('users', $users)
				->set('matches', $matches)
				->set('can_apply', $can_apply);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

	public function action_napravi()
	{
		if ($this->_user->cannot('create', 'Clans'))
		{
			$this->deny_access();
		}

		if ($this->_user->clan_id === NULL)
		{
			if ($this->request->method() === Request::POST)
			{
				try
				{
					$files = Media_Local_Clan::validate($_FILES);

					if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
					{
						$this->_post['lord_id']    = $this->_user->id;
						$this->_post['created_at'] = DB::expr('NOW()');

						$clan = ORM::factory('Clan')
							->values($this->_post, array('name', 'tag', 'lord_id', 'open', 'created_at'))
							->create();

						$this->_user->clan_id = $clan->id;

						Media_Local_Clan::save($clan->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Klan je uspješno napravljen.',
						);

						$this->redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
					}
					else
					{
						$errors = $files->errors('media');
					}
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}

				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nepravilan unos.',
				);
			}

			$this->_title   = 'Napravi klan';
			$this->_content = View::factory('clans/napravi')
				->set('values', $this->_post)
				->set('errors', (isset($errors)) ? $errors : array());
		}
		else
		{
			$clan = ORM::factory('Clan', $this->_user->clan_id);

			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Već si u klanu.',
			);

			$this->redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
		}
	}

	public function action_izmijeni()
	{
		$clan = ORM::factory('Clan', $this->request->param('id'));

		if ($clan->loaded())
		{
			if ($this->_user->cannot('update', $clan))
			{
				$this->deny_access();
			}

			if ($this->request->method() === Request::POST)
			{
				try
				{
					$files = Media_Local_Clan::validate($_FILES);

					if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
					{
						$this->_post['updated_at'] = DB::expr('NOW()');

						$clan->values($this->_post, array('name', 'tag', 'lord_id', 'open', 'updated_at'))
							->update();

						Media_Local_Clan::save($clan->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Klan je uspješno izmijenjen.',
						);

						$this->redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
					}
					else
					{
						$errors = $files->errors('media');
					}
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}

				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nepravilan unos.',
				);
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
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

	public function action_prijava()
	{
		$clan = ORM::factory('Clan', $this->request->param('id'));

		if ($clan->loaded())
		{
			if ($this->_user->cannot('create', 'Applications'))
			{
				$this->deny_access();
			}

			if ($this->request->method() === Request::POST AND $clan->open AND ! $this->_user->clan_id)
			{
				$application = $clan->applications
					->where('user_id', '=', $this->_user->id)
					->find();

				if ( ! $application->loaded())
				{
					$application->values(array('clan_id' => $clan->id, 'user_id' => $this->_user->id))
						->create();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Uspješno si se prijavio/la u klan.',
					);
				}
				else
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Već si se prijavio/la u klan.',
					);
				}
			}
			elseif ( ! $clan->open)
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Klan nije otvoren za nove prijave.',
				);
			}
			elseif ($this->_user->clan_id)
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Već si u klanu.',
				);
			}

			$this->redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

	public function action_prijave()
	{
		$clan = ORM::factory('Clan', $this->request->param('id'));

		if ($clan->loaded())
		{
			if ($this->_user->cannot('*', $clan))
			{
				$this->deny_access();
			}

			$applications = $clan->applications
				->with('user')
				->order_by('id', 'DESC')
				->find_all();

			$this->_title   = 'Prijave - '.$clan->name;
			$this->_content = View::factory('clans/prijave')
				->set('clan', $clan)
				->set('applications', $applications);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

	public function action_review_application()
	{
		$clan        = ORM::factory('Clan', $this->request->param('id'));
		$application = $clan->applications
			->with('user')
			->where('application.id', '=', $this->request->param('id2'))
			->find();

		if ($clan->loaded() AND $application->loaded())
		{
			if ($this->_user->cannot('*', $clan))
			{
				$this->deny_access();
			}

			if ($this->request->method() === Request::POST)
			{
				$user_clan = $application->user->clan_id;

				if ($this->request->param('operation') == 'odobri' AND $user_clan == NULL)
				{
					$application->user->values(array('clan_id' => $clan->id))->update();
				}

				$application->delete();

				if ($this->request->param('operation') == 'odbij')
				{
					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Prijava je odbijena.',
					);
				}
				elseif ($user_clan)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Igrač već ima klan.',
					);
				}
				else
				{
					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Prijava je odobrena.',
					);
				}
			}

			$this->redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijave');
		}
		elseif ( ! $clan->loaded())
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
		elseif ( ! $application->loaded())
		{
			throw HTTP_Exception::factory(404, 'Prijava nije pronađena.');
		}
	}

	public function action_izbaci()
	{
		$clan = ORM::factory('Clan', $this->request->param('id'));
		$user = $clan->users
			->where('id', '=', $this->request->param('id2'))
			->find();

		if ($clan->loaded() AND $user->loaded())
		{
			if ($this->_user->cannot('*', $clan))
			{
				$this->deny_access();
			}

			if ($this->request->method() === Request::POST)
			{
				if ($user->id == $clan->lord->id)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Lord klana ne može biti izbačen.',
					);
				}
				else
				{
					$user->values(array('clan_id' => NULL))->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Igrač je izbačen iz klana.',
					);
				}
			}

			$this->redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
		}
		elseif ( ! $clan->loaded())
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
		elseif ( ! $user->loaded())
		{
			throw HTTP_Exception::factory(404, 'Igrač nije pronađen.');
		}
	}

}