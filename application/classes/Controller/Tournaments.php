<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tournaments extends Controller_Application {

	public function action_index()
	{
		$count = ORM::factory('tournament')->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $count,
		));

		$tournaments = ORM::factory('tournament')
			->with('user')
			->order_by('created_at', 'DESC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();

		$this->_title 	= 'Turniri';
		$this->_content = View::factory('tournaments/index')
			->set('tournaments', $tournaments)
			->set('pagination', $pagination);
	}

	public function action_view()
	{
		$tournament = ORM::factory('tournament')
			->with('user')
			->where('tournament.id', '=', $this->request->param('id'))
			->find();

		if ($tournament->loaded())
		{
			$clans = $tournament->clans
				->where('is_approved', '=', TRUE)
				->find_all();

			$matches = $tournament->matches
				->with('radiant_clan')
				->with('dire_clan')
				->find_all();

			$comments = Model_Tournament::comments($tournament->id);

			$this->_title 	= $tournament->name;
			$this->_content = View::factory('tournaments/view')
				->set('tournament', $tournament)
				->set('clans', $clans)
				->set('matches', $matches)
				->set('comments', $comments);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Turnir nije pronađen.');
		}
	}

	public function action_organiziraj()
	{
		if ($this->_post)
		{
			try
			{
				$files = Media_Local_Tournament::validate($_FILES);

				if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
				{
					$this->_post['user_id']    = $this->_user->id;
					$this->_post['created_at'] = DB::expr('NOW()');

					$tournament = ORM::factory('tournament')
						->values($this->_post, array('name', 'description', 'user_id', 'created_at'))
						->create();

					Media_Local_Tournament::save($tournament->id, $files);

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Turnir je uspješno napravljen.',
					);

					Session::instance()->set('messages', $this->_messages);

					HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
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

		$this->_title   = 'Organiziraj turnir';
		$this->_content = View::factory('tournaments/organiziraj')
			->set('values', $this->_post)
			->set('errors', (isset($errors)) ? $errors : array());
	}

	public function action_izmijeni()
	{
		$tournament = ORM::factory('tournament', $this->request->param('id'));

		if ($tournament->loaded() AND $tournament->user_id == $this->_user->id)
		{
			if ($this->_post)
			{
				try
				{
					$files = Media_Local_Tournament::validate($_FILES);

					if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
					{
						$this->_post['updated_at'] = DB::expr('NOW()');

						$tournament->values($this->_post, array('name', 'description', 'updated_at'))
							->update();

						Media_Local_Tournament::save($tournament->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Turnir je uspješno izmijenjen.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
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
					$errors = $e->errors('models');
				}
			}

			$this->_title   = 'Izmijeni turnir - '.$tournament->name;
			$this->_content = View::factory('tournaments/izmijeni')
				->set('values', (empty($this->_post)) ? $tournament->as_array() : $this->_post)
				->set('errors', (isset($errors)) ? $errors : array());
		}
		elseif ($tournament->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi organizator/ica ovog turnira.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Turnir nije pronađen.');
		}
	}

	public function action_prijavi()
	{
		$tournament = ORM::factory('tournament', $this->request->param('id'));

		if ($tournament->loaded() AND $tournament->is_started == FALSE AND $this->request->method() === Request::POST)
		{
			$clan = ORM::factory('clan', array('lord_id' => $this->_user->id));

			if ($clan->loaded())
			{
				if ($tournament->has('clans', $clan))
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Klan je već prijavljen na ovaj turnir.',
					);
				}
				else
				{
					$tournament->add('clans', $clan);

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Klan je prijavljen na turnir.',
					);
				}

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
			}
			else
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nisi lord klana.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
			}
		}
		elseif ($tournament->loaded() AND $tournament->is_started == FALSE)
		{
			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
		}
		elseif ($tournament->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Turnir je već započeo.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Turnir nije pronađen.');
		}
	}

	public function action_start()
	{
		$tournament = ORM::factory('tournament', $this->request->param('id'));

		if ($tournament->loaded())
		{
			if ($this->request->method() === Request::POST)
			{
				$participations = $tournament->participations
					->where('is_approved', '=', TRUE);

				$count = $participations->count_all();

				if ($tournament->user_id == $this->_user->id AND $tournament->is_started == FALSE AND $count == $tournament->num_clans)
				{
					$type = ORM::factory('type', array('name' => 'Turnir'));

					$participations = $participations->find_all()->as_array();

					shuffle($participations);

					for ($i = 0; $i < $count; $i += 2)
					{
						ORM::factory('match')
							->values(array(
								'type_id'         => $type->id,
								'tournament_id'   => $tournament->id,
								'radiant_clan_id' => $participations[$i]->clan_id,
								'dire_clan_id'    => $participations[$i+1]->clan_id,
								'mode_id'         => $tournament->mode_id,
							))->create();
					}

					$tournament->values(array('is_started' => TRUE, 'updated_at' => DB::expr('NOW()')))
						->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Turnir je započeo.',
					);
				}
				elseif ($tournament->user_id != $this->_user->id)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nisi organizator/ica ovog turnira.',
					);
				}
				elseif ($count != $tournament->num_clans)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nedovoljan broj klanova.',
					);
				}
				elseif ($tournament->is_started)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Turnir je već počeo.',
					);
				}
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Turnir nije pronađen.');
		}
	}

}