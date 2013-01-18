<?php defined('SYSPATH') or die('No direct script access.');

class Task_News_Get extends Minion_Task {

	protected function _execute(array $params)
	{
		$news = Steam::app_news();

		$site_config = Kohana::$config->load('site');
		$site_name   = $site_config->get('site_name');
		$site_email  = $site_config->get('email');
		$translators = $site_config->get('translators');

		foreach ($news as $n)
		{
			$article = ORM::factory('news', array('gid' => $n->gid));

			if ( ! $article->loaded())
			{
				$article->values(array(
					'gid'        => $n->gid,
					'title'      => $n->title,
					'content'    => $n->contents,
					'source'     => $n->feedlabel,
					'url'        => $n->url,
					'created_at' => date('Y-m-d H:i:s', $n->date),
				))->create();

				$email = Email::factory(Kohana::message('email', 'new_article'),
					View::factory('email/new_article')
						->set('article', $article)
						->render(),
					'text/html');
				
				foreach ($translators as $t)
				{
					$email->to($t);
				}
				
				$email->from($site_email, $site_name)
					->send();
			}
		}
	}

}