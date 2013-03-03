<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pages extends Controller_Application {

	public function action_home()
	{
		$this->_content = View::factory('pages/home');
	}
	
	public function action_provjera()
	{
		$this->_layout 	= 'SignInTos';
		$this->_title 	= 'Prijava';
		$this->_content = View::factory('pages/login');
		
	}
	
	public function action_webteam()
	{
		$this->_layout	= 'WebTeam';
		$this->_title	= 'Tim';
		$this->_content	= View::factory('pages/site/team');
	}
	
	public function action_advertisements()
	{
		$this->_layout	= 'Ads';
		$this->_title	= 'Advertisments';
		$this->_content	= View::factory('pages/advertisements');
	}
	
	public function action_api()
	{
		$this->_layout	= 'api';
		$this->_title	= 'API';
		$this->_content	= View::factory('pages/site/api');
	}
	
	public function action_privacy()
	{
		$this->_layout	= 'Privacy';
		$this->_title	= 'Privacy';
		$this->_content	= View::factory('pages/site/privacy');	
	}
	
	public function action_terms()
	{
		$this->_layout	= 'Terms';
		$this->_title	= 'Terms';
		$this->_content	= View::factory('pages/site/terms');	
	}
	
	public function action_changelog()
	{
		$this->_layout	= 'Changelog';
		$this->_title	= 'Changelog';
		$this->_content	= View::factory('pages/changelog');	
	}

	public function action_offline()
	{
		$maintenance = Kohana::$config->load('site.maintenance');

		if ($maintenance['start'] AND strtotime($maintenance['start']) <= time() AND
			( ! $maintenance['end'] OR strtotime($maintenance['end']) >= time()))
		{
			$this->_template = 'maintenance';
		}
		else
		{
			HTTP::redirect();
		}
	}
}