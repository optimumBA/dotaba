<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Streams extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'VodsVideo';
	}

	public function action_index()
	{
		$streams = ORM::factory('Stream')
			->with('user')
			->order_by('id', 'DESC')
			->find_all();

		$this->_title 	= 'Streamovi';
		$this->_content = View::factory('vods/streams/index')
			->set('streams', $streams);
	}

	public function action_view()
	{
		$stream = ORM::factory('Stream')
			->with('user')
			->where('user.accountid', '=', $this->request->param('id'))
			->find();

		if ($stream->loaded())
		{
			$matches = $stream->matches
				->with('type')
				->with('tournament')
				->with('radiant_clan')
				->with('dire_clan')
				->with('mode')
				->find_all();

			$this->_title 	= $stream->user->username.'ov/in stream';
			$this->_content = View::factory('vods/streams/view')
				->set('stream', $stream)
				->set('matches', $matches)
				->set('comments_count', Model_Stream::comments_count($stream->id));
		}
		elseif ($this->request->param('id') == $this->_user->accountid)
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nemaš stream. Popuni formu da ga dodaš.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('igraci/'.$this->_user->accountid.'/stream/dodaj');
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Korisnik nije pronađen ili nema svoj stream.');
		}
	}

	public function action_dodaj()
	{
		if ($this->_user->stream->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Već imaš stream.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('igraci/'.$this->_user->accountid);
		}
		else
		{
			if ($this->_post)
			{
				try
				{
					$this->_post['user_id']    = $this->_user->id;
					$this->_post['created_at'] = DB::expr('NOW()');

					$this->_user->stream
						->values($this->_post, array('channel', 'description', 'user_id', 'created_at'))
						->create();

					HTTP::redirect('igraci/'.$this->_user->accountid.'/stream');
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}
			}

			$this->_title   = 'Dodaj stream';
			$this->_content = View::factory('vods/streams/dodaj')
				->set('values', $this->_post)
				->set('errors', (isset($errors)) ? $errors : array());
		}
	}

	public function action_izmijeni()
	{
		if ($this->request->param('id') == $this->_user->accountid)
		{
			if ($this->_user->stream->loaded())
			{
				if ($this->_post)
				{
					try
					{
						$this->_post['updated_at'] = DB::expr('NOW()');

						$this->_user->stream
							->values($this->_post, array('channel', 'description', 'updated_at'))
							->update();

						HTTP::redirect('igraci/'.$this->_user->accountid.'/stream');
					}
					catch (ORM_Validation_Exception $e)
					{
						$errors = $e->errors('models');
					}
				}

				$this->_title   = 'Izmijeni stream';
				$this->_content = View::factory('vods/streams/izmijeni')
					->set('values', (empty($this->_post)) ? $this->_user->stream->as_array() : $this->_post)
					->set('errors', (isset($errors)) ? $errors : array());
			}
			else
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nemaš stream. Popuni formu da ga dodaš.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('igraci/'.$this->_user->accountid.'/stream/dodaj');
			}
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Ne možeš mijenjati tuđi stream.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('igraci/'.$this->_user->accountid.'/stream/izmijeni');
		}
	}

}