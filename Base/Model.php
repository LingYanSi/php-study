<?php
    function db($db, $query) {
        $mysqli = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']);
        $result = $mysqli->query($query); // 用于执行mysql命令
        
        // 遍历查询结果
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }

        $result->free();
        $mysqli->close();

        return $results_array;
    }
