<?php

@session_start();

class ctrlUser extends Api
{

    public function login()
    {
        $m = Loader::model("user");
        $email = Input::request("email", "", "trim");
        $password = Input::request("password", "", "trim");

        if (!$email || !$password)
        {
            $this->errExit(__LINE__, "邮箱和密码不能为空");
        }

        $user = $m->findByEmail($email);
        if (!$user || $password != $user['pwd'])
        {
            $this->errExit(__LINE__, "邮箱或密码错误");
        }

        $_SESSION = array_merge($_SESSION, $user);
        $this->succExit();
    }

    public function delete()
    {
        $id = Input::request("id", 0, "intval");
        $sql = "delete from user where id=$id";
        Db::init()->query($sql);
        $this->succExit();
    }

    public function save()
    {
        $param = Input::request();
        $user = Db::table("user")->cond("id")->field("*")->bindInt("id", intval($param["id"]))->exec()->fetch();
        $diff = array_diff($param, $user);
        $rowCount = Db::table("user")->cond("id")->field("*")->bindInt("id", intval($param["id"]))->update($diff);
        $this->succExit(["rowCount" => $rowCount]);
    }

    public function logout()
    {
        unset($_SESSION['uid']);
        $this->succExit();
    }

}
