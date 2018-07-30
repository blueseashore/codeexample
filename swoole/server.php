<?php
/**
 * User: kendo    Date: 2018/6/26
 */
error_reporting(E_ALL);
$host = '127.0.0.1';
$port = 9501;
//创建server对象,监听127.0.0.1:9501服务端口
$server = new swoole_server($host, $port);

//监听连接进入事件
$server->on('connect', function ($server, $fd) {
    echo "Client:connect.\n";
});

//监听数据接收事件
$server->on('receive', function ($server, $fd, $from_id, $data) {
    $server->send($fd, "Server:" . $data);
});

//监听连接关闭事件
$server->on('close', function ($server, $fd) {
    echo "Clien:close\n";
});

//启动服务器
$server->start();