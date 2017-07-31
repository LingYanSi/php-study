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
    function getData() {
        echo json_encode(array(1, 2, 3, 5));
    }
}
