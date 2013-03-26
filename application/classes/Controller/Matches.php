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
		$match = ORM::factory('match')
			->with('type')
			->with('tournament')
			->with('radiant_clan')
			->with('dire_clan')
			->with('mode')
			->where('match.id', '=', $this->request->param('id'))
			->find();

		if ($match->loaded() AND $match->processed OR $match->type->name == 'Tournament')
		{
			$this->_title = 'Meč '.$match->id;

			if ($match->radiant_clan_id AND $match->dire_clan_id)
			{
				$this->_title .= ' - '.$match->radiant_clan->name.' protiv '.$match->dire_clan->name;
			}

			$comments = Model_Match::comments($match->id);

			if ($match->processed)
			{
				$slots = $match->slots
					->with('user')
					->with('hero')
					->with('item_0')
					->with('item_1')
					->with('item_2')
					->with('item_3')
					->with('item_4')
					->with('item_5')
					->order_by('player_slot')
					->find_all()
					->as_array('player_slot');

				$picksbans = $match->picksbans
					->with('hero')
					->order_by('order')
					->find_all();

				$this->_content = View::factory('matches/processed')
					->set('slots', $slots)
					->set('picksbans', $picksbans);
			}
			else
			{
				$streams = $match->streams->find_all();

				$can_stream = ($this->_user->stream->loaded() AND $this->_user->stream->has('matches', $match) == FALSE);

				$this->_content = View::factory('matches/unprocessed')
					->set('streams', $streams)
					->set('can_stream', $can_stream);
			}

			$this->_content->set('match', $match)
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

	public function action_najavi_streamanje()
	{
		$match = ORM::factory('match', $this->request->param('id'));

		if ($match->loaded())
		{
			if ($this->_post)
			{
				if ($this->_user->stream->loaded())
				{
					if ($this->_user->stream->has('matches', $match))
					{
						$this->_messages[] = array(
							'type'  => 'error',
							'value' => 'Već si najavio/la streamanje ovog meča.',
						);
					}
					else
					{
						$this->_user->stream->add('matches', $match);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Streamanje je najavljeno.',
						);
					}
				}
				else
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nemaš stream.',
					);
				}
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/mecevi/'.$match->id);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Meč nije pronađen.');
		}
	}

	public function action_otkazi_streamanje()
	{
		$match = ORM::factory('match', $this->request->param('id'));

		if ($match->loaded())
		{
			if ($this->_post)
			{
				if ($this->_user->stream->loaded())
				{
					if ($this->_user->stream->has('matches', $match))
					{
						$this->_user->stream->remove('matches', $match);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Streamanje je otkazano.',
						);
					}
					else
					{

						$this->_messages[] = array(
							'type'  => 'error',
							'value' => 'Nisi najavio/la streamanje ovog meča.',
						);
					}
				}
				else
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nemaš stream.',
					);
				}
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/mecevi/'.$match->id);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Meč nije pronađen.');
		}
	}

}