<?php
include_once './Base/Base.php';

class Index extends Base {
    function __constructor() {

    }
    function index($home = '你好') {
        $data = array(
            'home' => $home
        );
        $this->render('home', $data);
    }
}
