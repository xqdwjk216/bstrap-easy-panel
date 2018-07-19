<?php

class ScopeApi extends Api
{

	public function index()
	{
		
	}

	public function canAccess()
	{
		$user = $this->getUser();
		$scope_id = Input::request("id", "intval");
		if (!scope_id)
		{
			$this->errExit(__LINE__, "scope_id不能为空");
		}

		$can_access = Loader::model("scope")->canAccess($user, $scope_id);
		$this->succExit(["can_access" => $can_access]);
	}

	public function scopeList()
	{
		$scope_ids = Loader::model("user")->getUserScopeIds();
		$this->succExit(["scope_ids" => $scope_ids]);
	}

}
