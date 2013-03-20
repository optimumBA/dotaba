<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Matches extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$matches = ORM::factory('match')
			->with('type')
			->with('tournament')
			->with('radiant_clan')
			->with('dire_clan')
			->with('mode')
			->where('processed', '=', TRUE)
			->find_all();

		$this->_title 	= 'Mečevi';
		$this->_content = View::factory('matches/index')
			->set('matches', $matches);
	}

	public function action_view()
	{
		$match = Model_Match::details($this->request->param('id'));

		if ($match)
		{
			$this->_title = 'Meč broj '.$match->id;

			if ($match->radiant_clan_id AND $match->dire_clan_id)
			{
				$this->_title .= ' - '.$match->radiant_clan->name.' protiv '.$match->dire_clan->name;
			}

			$comments = Model_Match::comments($match->id);

			$this->_content = View::factory('matches/view')
				->set('match', $match)
				->set('comments', $comments);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Meč nije pronađen.');
		}
	}

	public function action_najavi()
	{
		$tournament = ORM::factory('tournament', $this->request->param('id'));

		if ($tournament->loaded() AND $this->_user->id == $tournament->user_id)
		{
			if ($this->_post)
			{
				try
				{
					$type = ORM::factory('type', array('name' => 'Tournament'));

					$this->_post['type_id']       = $type->id;
					$this->_post['tournament_id'] = $tournament->id;
					$this->_post['mode_id']       = $tournament->mode_id;
					$this->_post['created_at']    = DB::expr('NOW()');

					$match = ORM::factory('match')
						->values($this->_post, array('type_id', 'tournament_id', 'mode_id', 'radiant_clan_id', 'dire_clan_id', 'date', 'created_at'))
						->create();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Meč je uspješno najavljen.',
					);

					Session::instance()->set('messages', $this->_messages);

					HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE));
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

			$clans = $tournament->clans
				->where('is_approved', '=', TRUE)
				->find_all();

			$clans_array = array();

			foreach ($clans as $clan)
			{
				$clans_array[$clan->id] = $clan->name;
			}

			$this->_title   = 'Najavi meč - '.$tournament->name;
			$this->_content = View::factory('matches/najavi')
				->set('values', $this->_post)
				->set('errors', (isset($errors)) ? $errors : array())
				->set('clans', $clans_array);
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

}