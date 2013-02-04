<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Videos extends Controller_Application {

	public function action_index()
	{
		$videos = ORM::factory('video')
			->order_by('created_at', 'DESC')
			->find_all();

		$this->_title 	= 'Snimci';
		$this->_content = View::factory('videos/index')
			->set('videos', $videos);
	}


	public function action_view()
	{
		$video = ORM::factory('video', $this->request->param('id'));

		if ($video->loaded())
		{
			$this->_title 	= $video->name;
			$this->_content = View::factory('videos/view')
				->set('video', $video);
		}
	}

	public function action_dodaj()
	{
		if ($this->_user)
		{
			if ($this->_post)
			{
				try
				{
					$this->_post['user_id']    = $this->_user->id;
					$this->_post['created_at'] = DB::expr('NOW()');

					$video = ORM::factory('video')
						->values($this->_post, array('vid', 'name', 'description', 'user_id', 'created_at'))
						->create();

					HTTP::redirect('vod/snimci/'.$video->id.'-'.URL::title($video->name));
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}
			}

			$this->_title   = 'Dodaj snimak';
			$this->_content = View::factory('videos/dodaj')
				->set('values', $this->_post)
				->set('errors', ($errors) ? $errors : array());
		}
	}

	public function action_izmijeni()
	{
		$video = ORM::factory('video', $this->request->param('id'));

		if ($video->loaded() AND $this->_user AND $this->_user->has('videos', $video))
		{
			if ($this->_post)
			{
				try
				{
					$this->_post['updated_at'] = DB::expr('NOW()');

					$video = ORM::factory('video')
						->values($this->_post, array('vid', 'name', 'description', 'updated_at'))
						->update();

					HTTP::redirect('vod/snimci/'.$video->id.'-'.URL::title($video->name));
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}
			}

			$this->_title   = 'Izmijeni snimak - '.$video->name;
			$this->_content = View::factory('videos/izmijeni')
				->set('values', (empty($this->_post)) ? $video->as_array() : $this->_post)
				->set('errors', ($errors) ? $errors : array())
				->set('video', $video);
		}
	}

}