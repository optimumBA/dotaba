<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller_Application {

	public function before()
	{
		parent::before();

		if ($this->request->is_initial() AND ! $this->request->is_ajax()
			OR in_array($this->request->action(), array('dodaj', 'izmijeni', 'obrisi')) AND $this->request->method() != Request::POST)
		{
			HTTP::redirect();
		}
	}

	public function action_index()
	{
		$type = $this->request->param('type');
		$id   = $this->request->param('id');

		$comments = call_user_func(array('Model_'.$type, 'comments'), $id, $this->request->param('last_id'));

		if ($this->request->is_initial())
		{
			$this->_content = array(
				'status'   => 'OK',
				'comments' => View::factory('comments/list', array('comments' => $comments, 'object_type' => $type, 'object_id' => $id))->render(),
			);
		}
		else
		{
			$this->_content = View::factory('comments/index', array('comments' => $comments, 'object_type' => $type, 'object_id' => $id));
		}
	}

	public function action_dodaj()
	{
		if ($this->_post AND $this->_user->logged_in())
		{
			try
			{
				$this->_post['user_id']    = $this->_user->id;
				$this->_post['created_at'] = DB::expr('NOW()');

				$comment = ORM::factory('Comment')
					->values($this->_post, array('body', 'object_id', 'object_type', 'parent_id', 'user_id', 'created_at'))
					->create()
					->reload();

				$this->_content = array(
					'status'  => 'OK',
					'comment' => View::factory('comments/new_response', array('comment' => $comment))->render(),
				);
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->_content = array(
					'status' => 'ERROR',
					'errors' => $e->errors('models'),
				);
			}
		}
		else
		{
			HTTP::redirect();
		}
	}

	public function action_izmijeni()
	{
		$comment = ORM::factory('Comment', $this->request->param('id'));

		if ($comment->loaded() AND $comment->user_id == $this->_user->id)
		{
			try
			{
				$this->_post['updated_at'] = DB::expr('NOW()');

				$comment->values($this->_post, array('body', 'updated_at'))
					->update();

				$this->_content = array(
					'status'   => 'OK',
					'parsed'   => HTML::parse_bbcode($comment->body),
					'unparsed' => $comment->body,
				);
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->_content = array(
					'status' => 'ERROR',
				);
			}
		}
		else
		{
			HTTP::redirect();
		}
	}

	public function action_obrisi()
	{
		$comment = ORM::factory('Comment', $this->request->param('id'));

		if ($comment->loaded() AND ($comment->user_id == $this->_user->id OR $this->_user->has_role('Administrator/ica')))
		{
			$comment->values(array('removed' => TRUE, 'updated_at' => DB::expr('NOW()')))
				->update();

			$this->_content = array(
				'status' => 'OK',
			);
		}
		else
		{
			$this->_content = array(
				'status' => 'ERROR',
			);
		}
	}

}