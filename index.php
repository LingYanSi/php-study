<?php
    define("FUCK", "fuck u", true); // 定义全局字符串常量
    // phpinfo();

    // 注册异常处理函数
    // function handleError(Throwable $err) {
    //     echo "zhimingcuowu";
    // }
    // set_exception_handler(handleError);
    include_once './config/db.php';
    
    class Handle {
        // 根据一定的路由规则，去执行不同的class
        function __construct($path = 'index') {
            // 去不同的文件夹
            // 默认执行index
            // get-data 转 getData
            $fn = substr(strrchr($path, '/'), 1);
            $fn = empty($fn) ? 'index' : $fn;
            $fn = preg_replace_callback(
                '(-(.))',
                function ($matches) {
                    return strtoupper($matches[1]);
                },
                $fn
            );

            // 默认的
            $realPath = substr($path, 0, strrpos($path, '/'));
            $realPath = empty($realPath) ? '/wpt' : $realPath;
            // /home/list 会转成 HomeList 然后去 controller/HomeList.php
            $className = preg_replace_callback(
                '(/(.))',
                function ($matches) {
                    return strtoupper($matches[1]);
                },
                $realPath
            );

            include_once('./controller/'.$className.'.php'); // 引用文件
            if (class_exists($className)) { // 判断类是否存在
                $instance = new $className();
                if (method_exists($instance, $fn)) { // 判断方法是否存在
                    // header('Location: http://www.baidu.com', '301');
                    $instance->$fn();
                }
            }
        }
    }

    // 请求路径
    $path = substr($_SERVER['REQUEST_URI'], 0, stripos($_SERVER['REQUEST_URI'], '?') ? stripos($_SERVER['REQUEST_URI'], '?') : strlen($_SERVER['REQUEST_URI']) );
    // echo json_encode($_SERVER);

    new Handle($path == '/' ? '/index' : $path);
    // $people->say(); // 请记住php里牛逼的语法 -> 请记住牛逼的属性获取形式，不要带$ 🤦‍♀️

?>
