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

}