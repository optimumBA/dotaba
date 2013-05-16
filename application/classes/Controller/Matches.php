<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Matches extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$matches = ORM::factory('Match')
			->with('type')
			->with('tournament')
			->with('radiant_clan')
			->with('dire_clan')
			->with('mode')
			->where('type.name', '=', 'Turnir')
			->find_all();

		$this->_title 	= 'Mečevi';
		$this->_content = View::factory('matches/index')
			->set('matches', $matches);
	}

	public function action_view()
	{
		$match = ORM::factory('Match')
			->with('type')
			->with('tournament')
			->with('radiant_clan')
			->with('dire_clan')
			->with('mode')
			->with('stream')
			->with('stream:user')
			->where('match.id', '=', $this->request->param('id'))
			->find();

		if ($match->loaded())
		{
			$this->_title = 'Meč '.$match->id;

			if ($match->radiant_clan_id AND $match->dire_clan_id)
			{
				$this->_title .= ' - '.$match->radiant_clan->name.' protiv '.$match->dire_clan->name;
			}

			$comments = Model_Match::comments($match->id);

			if ($match->radiant_win !== NULL)
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
				$this->_content = View::factory('matches/unprocessed')
					->set('match', $match);
			}

			$this->_content->set('match', $match)
				->set('comments', $comments);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Meč nije pronađen.');
		}
	}

	public function action_izmijeni()
	{
		$match = ORM::factory('Match')
			->with('type')
			->with('tournament')
			->with('radiant_clan')
			->with('dire_clan')
			->with('mode')
			->where('match.id', '=', $this->request->param('id'))
			->find();

		if ($match->loaded() AND $match->type->name == 'Turnir')
		{
			if ($this->_user->has_role('Organizator/ica turnira'))
			{
				if ($match->radiant_win !== NULL)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Već su uneseni rezultati ovog meča.',
					);

					Session::instance()->set('messages', $this->_messages);

					HTTP::redirect('liga/turniri/'.$match->tournament->id.'-'.URL::title($match->tournament->name, '-', TRUE));
				}
				else
				{
					if ($this->_post)
					{
						try
						{
							$this->_post['human_players'] = 0;
							$this->_post['updated_at']    = DB::expr('NOW()');

							if (isset($this->_post['slots']))
							{
								foreach ($this->_post['slots'] as $slot)
								{
									if ($slot['user_id'])
									{
										$slot['match_id'] = $match->id;

										ORM::factory('Slot')
											->values($slot, array('match_id', 'user_id', 'hero_id', 'player_slot', 'item_0_id', 'item_1_id', 'item_2_id',
												'item_3_id', 'item_4_id', 'item_5_id', 'kills', 'deaths', 'assists', 'leaver_status', 'gold', 'last_hits',
												'denies', 'gold_per_min', 'xp_per_min', 'gold_spent', 'hero_damage', 'tower_damage', 'hero_healing', 'level'
											))->create();

										$this->_post['human_players']++;
									}
								}
							}

							$match->values($this->_post, array('radiant_win', 'human_players', 'duration', 'first_blood_time', 'updated_at'))
								->update();

							$this->_messages[] = array(
								'type'  => 'success',
								'value' => 'Rezultat je unesen.',
							);

							Session::instance()->set('messages', $this->_messages);

							HTTP::redirect('liga/mecevi/'.$match->id);
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

					$users = ORM::factory('User')
						->or_where('clan_id', '=', $match->radiant_clan_id)
						->or_where('clan_id', '=', $match->dire_clan_id)
						->find_all();

					$users_array = array(NULL);

					foreach ($users as $user)
					{
						$users_array[$user->id] = $user->username;
					}

					$heroes = ORM::factory('Hero')->find_all();

					$heroes_array = array();

					foreach ($heroes as $hero)
					{
						$heroes_array[$hero->id] = $hero->localized_name;
					}

					$items = ORM::factory('Item')->find_all();

					$items_array = array(NULL);

					foreach ($items as $item)
					{
						$items_array[$item->id] = $item->localized_name;
					}

					$this->_title = 'Izmjena meča '.$match->id.' - '.$match->radiant_clan->name.' protiv '.$match->dire_clan->name;
					$this->_content = View::factory('matches/izmijeni')
						->set('values', $this->_post)
						->set('errors', (isset($errors)) ? $errors : array())
						->set('clans', array(1 => $match->radiant_clan->name, 0 => $match->dire_clan->name))
						->set('users', $users_array)
						->set('heroes', $heroes_array)
						->set('items', $items_array)
						->set('leaver_statuses', array('ne', 'da ("game safe to leave")', 'da'))
						->set('levels', Arr::range(1, 25));
				}
			}
			else
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nisi organizator/ica turnira.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/turniri/'.$match->tournament->id.'-'.URL::title($match->tournament->name, '-', TRUE));
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Meč nije pronađen.');
		}
	}

	public function action_najavi()
	{
		$tournament = ORM::factory('Tournament', $this->request->param('id'));

		if ($tournament->loaded() AND $this->_user->has_role('Organizator/ica turnira'))
		{
			if ($this->_post)
			{
				try
				{
					$type = ORM::factory('Type', array('name' => 'Turnir'));

					$this->_post['type_id']       = $type->id;
					$this->_post['tournament_id'] = $tournament->id;
					$this->_post['mode_id']       = $tournament->mode_id;
					$this->_post['created_at']    = DB::expr('NOW()');

					$match = ORM::factory('Match')
						->values($this->_post, array('type_id', 'tournament_id', 'mode_id', 'radiant_clan_id', 'dire_clan_id', 'date', 'created_at'))
						->create();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Meč je uspješno najavljen.',
					);

					Session::instance()->set('messages', $this->_messages);

					HTTP::redirect('liga/mecevi/'.$match->id);
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
		$match = ORM::factory('Match', $this->request->param('id'));

		if ($match->loaded())
		{
			if ($this->_post)
			{
				if ($this->_user->stream->loaded())
				{
					if ($match->stream_id)
					{
						if ($this->_user->stream->id == $match->stream_id)
						{
							$this->_messages[] = array(
								'type'  => 'error',
								'value' => 'Već si najavio/la streamanje ovog meča.',
							);
						}
						else
						{
							$this->_messages[] = array(
								'type'  => 'error',
								'value' => 'Neko je već najavio streamanje ovog meča.',
							);
						}
					}
					else
					{
						$match->values(array('stream_id' => $this->_user->stream->id))->update();

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
		$match = ORM::factory('Match', $this->request->param('id'));

		if ($match->loaded())
		{
			if ($this->_post)
			{
				if ($this->_user->stream->loaded())
				{
					if ($this->_user->stream->id == $match->stream_id)
					{
						$match->values(array('stream_id' => NULL))->update();

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

	public function action_izmijeni_vrijeme()
	{
		$match = ORM::factory('Match')
			->with('type')
			->with('tournament')
			->where('match.id', '=', $this->request->param('id'))
			->find();

		if ($match->loaded() AND $match->type->name == 'Turnir')
		{
			if ($this->_user->has_role('Organizator/ica turnira'))
			{
				if ($match->radiant_win !== NULL)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Meč je već odigran.',
					);

					Session::instance()->set('messages', $this->_messages);

					HTTP::redirect('liga/turniri/'.$match->tournament->id.'-'.URL::title($match->tournament->name, '-', TRUE));
				}
				else
				{
					if ($this->_post)
					{
						try
						{
							$this->_post['updated_at'] = DB::expr('NOW()');

							$match->values($this->_post, array('date', 'updated_at'))
								->update();

							$this->_messages[] = array(
								'type'  => 'success',
								'value' => 'Vrijeme odigravanja je izmijenjeno.',
							);
						}
						catch (ORM_Validation_Exception $e)
						{
							$this->_messages[] = array(
								'type'  => 'error',
								'value' => 'Nepravilan unos.',
							);

							$errors = $e->errors('models');
						}

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('liga/mecevi/'.$match->id);
					}
				}
			}
			else
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nisi organizator/ica turnira.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/turniri/'.$match->tournament->id.'-'.URL::title($match->tournament->name, '-', TRUE));
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Meč nije pronađen.');
		}
	}

}