<?php
// var_dump($_SERVER);
class Base {
    function __construct() {
        // 用于获取输入，get中找不到，就取post中找，都找不到就返回null
        // 获取输入
        $this->input = new class {
            function __get($name) {
                return $_GET[$name] ?? $_POST[$name] ?? null;
            }
        };
        $this->inputs = array_merge([], $_GET ?? [], $_POST ?? []);

        // 获取cookie
        $this->cookie = new class {
            function __get($name) {
                return $_COOKIE[$name] ?? null;
            }
        };

        // url相关
        $this->https = isset($_SERVER['HTTPS']);
        $this->http = !$this->https;
        $this->host = $_SERVER['HTTP_HOST'];
        $this->hostname = $_SERVER["SERVER_NAME"];
        $this->origin = ($this->https ? "https" : "http") . "://" . $this->host;
        $this->path = $_SERVER['PATH_INFO'] ?? '/';
        $this->url = $this->origin . $_SERVER['REQUEST_URI'];

        $this->allowCross();
    }

    // 允许跨域请求
    private function allowCross() {
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET,HEAD,PUT,POST,DELETE');
        header('Access-Control-Allow-Origin: '. $this->origin);
    }

    // cookie相关
    function setCookie($name, $value, $expire = 1, $domain = null) {
        setcookie($name, $value, time() + $expire*60*60*24, '/', $domain ?? $this->hostname);
    }
    function deleteCookie($name, $domain = null) {
        setcookie($name, "", time() - $expire*60*60*24, '/', $domain ?? $this->hostname);
    }
    function clearCookie() {
        foreach ($_COOKIE as $key=>$value) {
            $this->deleteCookie($key);
        }
    }

    // 未登录
    function noLogin() {
        $this->json([], 900, '未登录');
    }
    // 没有权限
    function noRight() {
        $this->json([], 800, '无权限');
    }

    // 服务器输出
    function json($data = [], $code = 0, $msg = '') {
        header('Content-type:text/json; charset=UTF-8');
        // 如果有callback，返回jsonp
        $callback = $this->input->callback;
        $json = json_encode([
                'code' => $code,
                'msg' => $msg,
                'data' => $data,
            ]);
        echo $callback ? $callback."(".$json.")": $json;
    }
    function html($filename, $data = []) {
        include($filename);
    }
    function text($content) {
        header('Content-type:text/plain; charset=UTF-8');
        echo $content;
    }
    function render($filename, $data) {
        header('Content-type:text/html; charset=UTF-8');
        $FN = './views/' . $filename . '.php';
        $this->html('./views/template/header.php');
        $this->html($FN); // 不要写 echo include(); 不然会再html后面加一个1；
        $this->html('./views/template/footer.php');
    }
}

class EmptyObject {}
