<?php
include_once './Base/Base.php';

class SaleDetail extends Base {
    function __constructor() {

    }
    function index($home = '你好') {
        $data = array(
            'home' => $home
        );
        return $this->render('home', $data);
    }
}
