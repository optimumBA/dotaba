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
				->where('processed', '=', TRUE)
				->where_open()
				->or_where('radiant_clan_id', '=', $clan->id)
				->or_where('dire_clan_id', '=', $clan->id)
				->where_close()
				->find_all();

			if ($can_apply = ($clan->open AND $this->_user->clan_id === NULL))
			{
				$application = $this->_user->applications
					->where('clan_id', '=', $clan->id)
					->count_all();

				$can_apply = ($application == 0);
			}

			$comments = Model_Clan::comments($clan->id);

			$this->_title 	= $clan->name;
			$this->_content = View::factory('clans/view')
				->set('clan', $clan)
				->set('users', $users)
				->set('matches', $matches)
				->set('can_apply', $can_apply)
				->set('comments', $comments);
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
							->values($this->_post, array('name', 'tag', 'lord_id', 'open', 'created_at'))
							->create();

						$this->_user->clan_id = $clan->id;

						Media_Local_Clan::save($clan->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Klan je uspješno napravljen.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
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
				'type'  => 'error',
				'value' => 'Već si u klanu.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
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

						$clan->values($this->_post, array('name', 'tag', 'lord_id', 'open', 'updated_at'))
							->update();

						Media_Local_Clan::save($clan->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Klan je uspješno izmijenjen.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
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
				'type'  => 'error',
				'value' => 'Nisi lord ovog klana.',
			);

			Session::instance()->set('messages', $this->_messages);

			if ($clan->loaded())
			{
				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
			}
			else
			{
				HTTP::redirect('liga/klanovi');
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

	public function action_prijava()
	{
		$clan = ORM::factory('clan', $this->request->param('id'));

		if ($clan->loaded() AND $this->_user->clan_id === NULL AND $clan->open)
		{
			if ($this->request->method() === Request::POST)
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

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
			}
			else
			{
				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
			}
		}
		elseif ( ! $clan->open)
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Klan nije otvoren za nove prijave.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
		}
		elseif ($this->_user->clan_id)
		{
			$clan = ORM::factory('clan', $this->_user->clan_id);

			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Već si u klanu.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

	public function action_prijave()
	{
		$clan = ORM::factory('clan', $this->request->param('id'));

		if ($clan->loaded() AND $clan->lord_id == $this->_user->id)
		{
			$applications = $clan->applications
				->with('user')
				->order_by('id', 'DESC')
				->find_all();

			$this->_title   = 'Prijave - '.$clan->name;
			$this->_content = View::factory('clans/prijave')
				->set('clan', $clan)
				->set('applications', $applications);
		}
		elseif ($clan->loaded())
		{
			$clan = ORM::factory('clan', $this->_user->clan_id);

			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi lord ovog klana.',
			);

			Session::instance()->set('messages', $this->_messages);

			if ($clan->loaded())
			{
				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
			}
			else
			{
				HTTP::redirect('liga/klanovi');
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
	}

	public function action_review_application()
	{
		$clan        = ORM::factory('clan', $this->request->param('id'));
		$application = $clan->applications
			->with('user')
			->where('application.id', '=', $this->request->param('id2'))
			->find();

		if ($clan->loaded() AND $application->loaded() AND $clan->lord_id == $this->_user->id)
		{
			if ($this->request->method() === Request::POST)
			{
				if ($this->request->param('operation') == 'odobri' AND $application->user->clan_id == NULL)
				{
					$application->user->values(array('clan_id' => $clan->id))->update();
				}

				$application->delete();

				if ($this->request->param('operation') == 'odobri')
				{
					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Prijava je odobrena.',
					);
				}
				else
				{
					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Prijava je odbijena.',
					);
				}

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijave');
			}
			else
			{
				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijave');
			}
		}
		elseif ($clan->lord_id != $this->_user->id)
		{
			$clan = ORM::factory('clan', $this->_user->clan_id);

			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi lord ovog klana.',
			);

			Session::instance()->set('messages', $this->_messages);

			if ($clan->loaded())
			{
				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
			}
			else
			{
				HTTP::redirect('liga/klanovi');
			}
		}
		elseif ( ! $clan->loaded())
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
		elseif ( ! $application->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nepostojeća prijava.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijave');
		}
	}

	public function action_izbaci()
	{
		$clan = ORM::factory('clan', $this->request->param('id'));
		$user = $clan->users
			->where('id', '=', $this->request->param('id2'))
			->find();

		if ($clan->loaded() AND $user->loaded() AND $clan->lord_id == $this->_user->id)
		{
			if ($this->request->method() === Request::POST)
			{
				if ($user->id != $clan->lord->id)
				{
					$user->values(array('clan_id' => NULL))->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Igrač je izbačen iz klana.',
					);
				}
				else
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Lord klana ne može biti izbačen.',
					);
				}

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
			}
			else
			{
				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
			}
		}
		elseif ($clan->lord_id != $this->_user->id)
		{
			$clan = ORM::factory('clan', $this->_user->clan_id);

			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi lord ovog klana.',
			);

			Session::instance()->set('messages', $this->_messages);

			if ($clan->loaded())
			{
				HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
			}
			else
			{
				HTTP::redirect('liga/klanovi');
			}
		}
		elseif ( ! $clan->loaded())
		{
			throw HTTP_Exception::factory(404, 'Klan nije pronađen.');
		}
		elseif ( ! $user->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Igrač nije u klanu.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE));
		}
	}

}