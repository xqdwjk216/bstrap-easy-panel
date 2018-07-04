<?php

include_once "core/api.php";

class HtmlApi extends Api {

    public function index() {
        
    }

    public function menu() {
        $m = Loader::model("menu");
        $menu = $m->listMenu();
        $sub_menu = $m->listMenuItem();
        $scope_ids = Loader::model("user")->getUserScopeIds();

        $this->template("menu", [
            "menu" => $menu,
            "sub_menu" => $sub_menu,
            "scope_ids" => $scope_ids
        ]);
    }

    public function userList(){
        $user_list =  Loader::model("user")->listAll();
        $this->template("userList",[
            "user_list" => $user_list
        ]);
    }

}

(new HtmlApi)->display();
