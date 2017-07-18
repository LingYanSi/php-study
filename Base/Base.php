<?php
class Base {
    /**
     * [noRight 没有权限]
     */
    function noRight() {

    }
    function RHome() {

    }
    function render($filename, $data) {
        $FN = './views/' . $filename . '.php';
        include($FN); // 不要写 echo include(); 不然会再html后面加一个1；
    }
}

class EmptyObject {}
