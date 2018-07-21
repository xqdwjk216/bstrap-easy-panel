<?php

class modelUser
{

	static $user_instance;

	public function listAll()
	{
		return Db::table("user")->exec()->fetchAll();
	}

	public function isLoggedIn()
	{
		return !empty($_SESSION['uid']);
	}

	public function findByEmail($email)
	{
		$user = Db::table("user")->cond("email")->field("*")->bindStr("email", $email)->exec()->fetch();
		return $user;
	}

	public function getCurrentUser()
	{
		if (modelUser::$user_instance)
		{
			return modelUser::$user_instance;
		}
		
		@session_start();
		if (empty($_SESSION['email']))
		{
			throw new Exception("Login required", 1);
		}
		modelUser::$user_instance = $this->findByEmail($_SESSION['email']);
		return modelUser::$user_instance;
	}

	public function getUserScopeIds()
	{
		$user = $this->getCurrentUser();
		$scope_ids = explode(",", $user['scope_ids']);
		array_walk($scope_ids, function(&$v) {
			$v = intval($v);
		});
		return $scope_ids;
	}

}
