<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tournaments extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$count = ORM::factory('Tournament')->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $count,
		));

		$tournaments = ORM::factory('Tournament')
			->order_by('id', 'DESC')
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
		$tournament = ORM::factory('Tournament')
			->with('mode')
			->with('winner')
			->where('tournament.id', '=', $this->request->param('id'))
			->find();

		if ($tournament->loaded())
		{
			$clans = $tournament->clans
				->where('is_approved', '=', TRUE)
				->find_all();

			$count = count($clans);

			$matches = $tournament->matches
				->with('radiant_clan')
				->with('dire_clan')
				->find_all();

			if ($can_apply = ( ! $tournament->is_started AND $count < $tournament->num_clans AND $this->_user->clan_id AND $this->_user->id == $this->_user->clan->lord_id))
			{
				$participation = $tournament->participations
					->where('clan_id', '=', $this->_user->clan->id)
					->count_all();

				$can_apply = ($participation == 0);
			}

			$this->_title 	= $tournament->name;
			$this->_content = View::factory('tournaments/view')
				->set('tournament', $tournament)
				->set('clans', $clans)
				->set('count', $count)
				->set('matches', $matches)
				->set('can_apply', $can_apply)
				->set('comments_count', Model_Tournament::comments_count($tournament->id));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Turnir nije pronađen.');
		}
	}

	public function action_organiziraj()
	{
		if ($this->_user->has_role('Organizator/ica turnira'))
		{
			if ($this->_post)
			{
				try
				{
					$files = Media_Local_Tournament::validate($_FILES);

					if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
					{
						$this->_post['created_at'] = DB::expr('NOW()');

						$tournament = ORM::factory('Tournament')
							->values($this->_post, array('name', 'description', 'mode_id', 'num_clans', 'is_auto_approvable', 'created_at'))
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

			$modes = ORM::factory('Mode')
				->find_all();

			$modes_array = array();

			foreach ($modes as $mode)
			{
				$modes_array[$mode->id] = $mode->name;
			}

			$this->_title   = 'Organiziraj turnir';
			$this->_content = View::factory('tournaments/organiziraj')
				->set('values', $this->_post)
				->set('errors', (isset($errors)) ? $errors : array())
				->set('modes', $modes_array);
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi organizator/ica turnira.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/turniri');
		}
	}

	public function action_izmijeni()
	{
		$tournament = ORM::factory('Tournament', $this->request->param('id'));

		if ($tournament->loaded() AND $this->_user->has_role('Organizator/ica turnira'))
		{
			if ($this->_post)
			{
				try
				{
					$files = Media_Local_Tournament::validate($_FILES);

					if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
					{
						if ($tournament->is_started)
						{
							$this->_post['mode_id'] = $tournament->mode_id;

							if ( ! $tournament->winner_id AND $this->_post['winner_id'])
							{
								$this->_post['finished_at'] = DB::expr('NOW()');
							}
							else
							{
								$this->_post['finished_at'] = $tournament->finished_at;
							}
						}
						else
						{
							$this->_post['winner_id'] = NULL;
						}

						$this->_post['updated_at'] = DB::expr('NOW()');

						$tournament->values($this->_post, array('name', 'description', 'mode_id', 'winner_id', 'updated_at', 'finished_at'))
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

			if ($tournament->is_started)
			{
				$participations = $tournament->participations
					->with('clan')
					->where('is_approved', '=', TRUE)
					->find_all();

				$clans_array = array();

				foreach ($participations as $participation)
				{
					$clans_array[$participation->clan->id] = $participation->clan->name;
				}

				$this->_content->set('clans', $clans_array);
			}
			else
			{
				$modes = ORM::factory('Mode')
					->find_all();

				$modes_array = array();

				foreach ($modes as $mode)
				{
					$modes_array[$mode->id] = $mode->name;
				}

				$this->_content->set('modes', $modes_array);
			}
		}
		elseif ($tournament->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi organizator/ica turnira.',
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
		$tournament = ORM::factory('Tournament', $this->request->param('id'));

		$count = $tournament->participations
			->where('is_approved', '=', TRUE)
			->count_all();

		if ($tournament->loaded() AND $tournament->is_started == FALSE AND $count < $tournament->num_clans AND $this->request->method() === Request::POST)
		{
			$clan = ORM::factory('Clan', array('lord_id' => $this->_user->id));

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
					$participation = ORM::factory('Participation')->values(array(
						'clan_id'       => $clan->id,
						'tournament_id' => $tournament->id,
						'is_approved'      => $tournament->is_auto_approvable,
						'created_at'    => DB::expr('NOW()'),
					))->create();

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
		elseif ($tournament->loaded() AND $tournament->is_started == FALSE AND $count < $tournament->num_clans)
		{
			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
		}
		elseif ($tournament->loaded() AND $tournament->is_started)
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Turnir je već započeo.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
		}
		elseif ($tournament->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Već je prijavljen traženi broj klanova.',
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
		$tournament = ORM::factory('Tournament', $this->request->param('id'));

		if ($tournament->loaded())
		{
			if ($this->request->method() === Request::POST)
			{
				$participations = $tournament->participations
					->where('is_approved', '=', TRUE)
					->find_all()
					->as_array();

				$count = count($participations);

				if ($this->_user->has_role('Organizator/ica turnira') AND $tournament->is_started == FALSE AND $count == $tournament->num_clans)
				{
					$type = ORM::factory('Type', array('name' => 'Turnir'));

					shuffle($participations);

					for ($i = 0; $i < $count; $i += 2)
					{
						if (isset($participations[$i+1]))
						{
							ORM::factory('Match')
								->values(array(
									'type_id'         => $type->id,
									'tournament_id'   => $tournament->id,
									'radiant_clan_id' => $participations[$i]->clan_id,
									'dire_clan_id'    => $participations[$i+1]->clan_id,
									'mode_id'         => $tournament->mode_id,
									'created_at'      => DB::expr('NOW()'),
								))->create();
						}
					}

					$tournament->values(array('is_started' => TRUE, 'updated_at' => DB::expr('NOW()')))
						->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Turnir je započeo.',
					);
				}
				elseif ( ! $this->_user->has_role('Organizator/ica turnira'))
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nisi organizator/ica turnira.',
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

	public function action_prijave()
	{
		$tournament = ORM::factory('Tournament', $this->request->param('id'));

		if ($tournament->loaded() AND $this->_user->has_role('Organizator/ica turnira') AND $tournament->is_started == FALSE AND $tournament->is_auto_approvable == FALSE)
		{
			$count = $tournament->participations
				->where('is_approved', '=', TRUE)
				->count_all();

			$participations = $tournament->participations
				->with('clan')
				->order_by('is_approved')
				->find_all();

			$this->_title   = 'Prijave - '.$tournament->name;
			$this->_content = View::factory('tournaments/prijave')
				->set('tournament', $tournament)
				->set('participations', $participations)
				->set('count', $count);
		}
		elseif ($tournament->loaded())
		{
			if ( ! $this->_user->has_role('Organizator/ica turnira'))
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nisi organizator/ica turnira.',
				);
			}
			elseif ($tournament->is_started)
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Turnir je već počeo.',
				);
			}
			else
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Prijave klanova se automatski odobravaju.',
				);
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Turnir nije pronađen.');
		}
	}

	public function action_review_participation()
	{
		$tournament    = ORM::factory('Tournament', $this->request->param('id'));
		$participation = $tournament->participations
			->with('clan')
			->where('participation.id', '=', $this->request->param('id2'))
			->find();

		if ($tournament->loaded() AND $participation->loaded() AND $this->_user->has_role('Organizator/ica turnira') AND
			$tournament->is_started == FALSE AND $tournament->is_auto_approvable == FALSE)
		{
			$count = $tournament->participations
				->where('is_approved', '=', TRUE)
				->count_all();

			if ($this->request->method() === Request::POST)
			{
				if ($this->request->param('operation') == 'odobri' AND $count < $tournament->num_clans)
				{
					$participation->values(array('is_approved' => TRUE))->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Prijava je odbijena.',
					);
				}
				elseif ($this->request->param('operation') == 'odbij')
				{
					$participation->values(array('is_approved' => FALSE))->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Prijava je odbijena.',
					);
				}
				else
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Turnir već ima traženi broj klanova.',
					);
				}
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/prijave');
		}
		elseif ($tournament->loaded() AND $participation->loaded())
		{
			if ( ! $this->_user->has_role('Organizator/ica turnira'))
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nisi organizator/ica turnira.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
			}
			elseif ($tournament->is_started)
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Turnir je već počeo.',
				);
			}
			else
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Prijave klanova se automatski odobravaju.',
				);
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/prijave');
		}
		elseif ( ! $tournament->loaded())
		{
			throw HTTP_Exception::factory(404, 'Turnir nije pronađen.');
		}
		elseif ( ! $participation->loaded())
		{
			throw HTTP_Exception::factory(404, 'Prijava nije pronađena.');
		}
	}

}