<?php

include_once "core/api.php";

class MenuApi extends Api {

    public function index() {

        $m = Loader::model("menu");
        $list = $m->listAll(null);
        $this->succExit($list);
    }

    public function id() {
        $m = Loader::model("menu");
        $id = Input::get("id", "intval");
        $row = $m->find($id);
        $this->succExit($row);
    }

}

(new MenuApi)->display();
