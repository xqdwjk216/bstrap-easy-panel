<?php

include_once "core/api.php";

class UserApi extends Api {

    public function index() {
        
    }

    public function login() {
        $m = Loader::model("user");
        $email = Input::request("email", "", "trim");
        $password = Input::request("password", "", "trim");

        if (!$email || !$password) {
            $this->errExit(__LINE__, "邮箱和密码不能为空");
        }

        $user = $m->findByEmail($email);
        if (!$user || $password != $user['pwd']) {
            $this->errExit(__LINE__, "邮箱或密码错误");
        }

        $_SESSION = array_merge($_SESSION, $user);
        $this->succExit();
    }

    public function logout() {
        unset($_SESSION['uid']);
        $this->succExit();
    }

}

(new UserApi)->display();
