<?php
include_once './Base/Base.php';
include_once './Base/Model.php';
include_once './Model/Comment.php';

class Wpt extends Base {
    function index($home = '家里') {
        var_dump($this->input);
        $data = array(
            'title' => $home
        );
        $this->render('index', $data);
    }
    function getData() {
        echo "我是数据呢";
    }
    function getJson() {
        $id = $this->input->id;
        if ($id) {
            $data = CommentModel::query($id);
            $this->json($data);
        } else {
           $this->json("没有底", 400); 
        }
    }
    function sCookie() {
        $this->setCookie('fuck', 'heihei');
        $this->setCookie('fuck1', 'heihei');
        $this->setCookie('fuck2', 'heihei');
        $this->json(['hahhahah']);
    }
    function dCookie() {
        $this->clearCookie();
        $this->text('删除成功');
    }
}
