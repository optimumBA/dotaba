<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Videos extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout	= 'VodsVideo';
	}
	
	public function action_index()
	{
		$videos = ORM::factory('Video')
			->order_by('id', 'DESC')
			->find_all();

		$this->_title 	= 'Snimci';
		$this->_content = View::factory('vods/videos/index')
			->set('videos', $videos);
	}

	public function action_view()
	{
		$video = ORM::factory('Video')
			->with('user')
			->where('video.id', '=', $this->request->param('id'))
			->find();

		if ($video->loaded())
		{
			$this->_title 	= $video->name;
			$this->_content = View::factory('vods/videos/view')
				->set('video', $video)
				->set('comments_count', Model_Video::comments_count($video->id));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Snimak nije pronađen.');
		}
	}

	public function action_dodaj()
	{
		if ($this->_user->cannot('create', 'Videos'))
		{
			$this->deny_access();
		}

		if ($this->request->method() === Request::POST)
		{
			try
			{
				$this->_post['user_id']    = $this->_user->id;
				$this->_post['created_at'] = DB::expr('NOW()');

				$video = ORM::factory('Video')
					->values($this->_post, array('vid', 'name', 'description', 'user_id', 'created_at'))
					->create();

				$this->_messages[] = array(
					'type'  => 'success',
					'value' => 'Snimak je dodan.',
				);

				$this->redirect('vods/snimci/'.$video->id.'-'.URL::title($video->name, '-', TRUE));
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('models');
			}
		}

		$this->_title   = 'Dodaj snimak';
		$this->_content = View::factory('vods/videos/dodaj')
			->set('values', $this->_post)
			->set('errors', (isset($errors)) ? $errors : array());
	}

	public function action_izmijeni()
	{
		$video = ORM::factory('Video', $this->request->param('id'));

		if ($video->loaded())
		{
			if ($this->_user->cannot('update', $video))
			{
				$this->deny_access();
			}

			if ($this->request->method() === Request::POST)
			{
				try
				{
					$this->_post['updated_at'] = DB::expr('NOW()');

					$video->values($this->_post, array('name', 'description', 'updated_at'))
						->update();

					$this->_messages[] = array(
						'type'  => 'success',
						'value' => 'Snimak je izmijenjen.',
					);

					$this->redirect('vods/snimci/'.$video->id.'-'.URL::title($video->name, '-', TRUE));
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}
			}

			$this->_title   = 'Izmijeni snimak - '.$video->name;
			$this->_content = View::factory('vods/videos/izmijeni')
				->set('values', (empty($this->_post)) ? $video->as_array() : $this->_post)
				->set('errors', (isset($errors)) ? $errors : array());
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Snimak nije pronađen.');
		}
	}

	public function action_home()
	{
		$videos = ORM::factory('Video')
			->order_by('id', 'DESC')
			->find_all();

		$this->_title   = 'Vods';
		$this->_content = View::factory('vods/index')
			->set('videos', $videos);
	}

}