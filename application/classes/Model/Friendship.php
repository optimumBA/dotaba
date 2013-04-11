<?php defined('SYSPATH') or die('No direct script access.');

class Model_Friendship extends ORM {

	protected $_belongs_to = array(
		'user'   => array(),
		'friend' => array(
			'model'       => 'User',
			'foreign_key' => 'friend_id',
		),
	);

	public static function forget_old($user_id, $ids)
	{
		$query = DB::delete('friendships')->where('user_id', '=', $user_id);

		if ( ! empty($ids))
		{
			$query->where('friend_id', 'NOT IN', $ids);
		}

		return $query->execute();
	}

}