<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller_Application {

	public function action_dodaj()
	{
		if ($this->_post)
		{
			try
			{
				$this->_post['user_id']    = $this->_user->id;
				$this->_post['created_at'] = DB::expr('NOW()');

				$comment = ORM::factory('comment')
					->values($this->_post, array('body', 'object_id', 'object_type', 'user_id', 'created_at'))
					->create();

				$this->_messages[] = array(
					'type'  => 'success',
					'value' => 'Komentar je poslan.',
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

			HTTP::redirect($this->request->referrer());
		}
		else
		{
			HTTP::redirect();
		}
	}

	public function action_izmijeni()
	{
		$comment = ORM::factory('comment', $this->request->param('id'));

		if ($comment->loaded() AND $comment->user_id == $this->_user->id AND
			$this->request->method() === Request::POST AND $this->request->is_ajax())
		{
			try
			{
				$this->_post['updated_at'] = DB::expr('NOW()');

				$comment->values($this->_post, array('body', 'updated_at'))
					->update();

				$this->_content = json_encode(array(
					'status' => 'OK',
					'parsed' => HTML::parse_bbcode($comment->body),
				));
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->_content = json_encode(array(
					'status' => 'ERROR',
				));
			}
		}
		else
		{
			HTTP::redirect($this->request->referrer());
		}
	}

	public function action_obrisi()
	{
		$comment = ORM::factory('comment', $this->request->param('id'));

		if ($comment->loaded() AND ($comment->user_id == $this->_user->id OR 
			$this->_user->has('roles', ORM::factory('role', array('name' => 'Administrator/ica')))))
		{
			$comment->values(array('removed' => TRUE, 'updated_at' => DB::expr('NOW()')))
				->update();

			$this->_messages[] = array(
				'type'  => 'success',
				'value' => 'Komentar je obrisan.',
			);
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Greška.',
			);
		}

		Session::instance()->set('messages', $this->_messages);

		HTTP::redirect($this->request->referrer());
	}

}