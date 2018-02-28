<?php
/**
 * User: kendo    Date: 2018/2/28
 * $server_key也是一个普通的key, *ByKey系列接口的工作过程是: 首先, 对$server_key进行hash,
 * 得到$server_key应该存储的服务器, 然后将相应的操作在 $server_key所在的服务器上进行.
 *
 */
$mem = new Memcached();

/*
$mem->addServer('127.0.0.1', 11212);
$mem->addServer('127.0.0.1', 11211);
 */
$server = [
    ['127.0.0.1', '11211', 60], //第一个缓存服务器
    ['127.0.0.1', '11212', 40], //第二个缓存服务器
];

$mem->addServers($server);
//var_dump($mem->getServerByKey('a'));die;  //获取server key：s 散列到的服务器信息

$mem->setOption(Memcached::OPT_COMPRESSION, false);
$mem->flush();

$mem->set('title','a dog');

$mem->setByKey('s', 'name', 'kid');    //散列到第一个缓存服务器
//$mem->setByKey('s', 'name', ['kid']);    //数组散列到第一个缓存服务器
$mem->setByKey('u', 'name', 'kendo');   //散列到第二个缓存服务器

$mem->appendByKey('u', 'name', 'is');   //追加到第二个缓存服务器
//$mem->appendByKey('u2', 'name', 'is');   //server key:u2 也是散列到第二个缓存服务器，所以操作结果同上

$mem->append('name', ' !');  //默认追加到第一个缓存服务器
$cas = 2;
$info = $mem->get('name',null,$cas);
//echo $mem->get('name');
$mem->cas($info['cas'],'name','test');
//echo $mem->get('name');die;
//echo $mem->getByKey('u', 'name',null,$cas), ' ', $mem->getByKey('s', 'name');

//$mem->getDelayedByKey('s',['name']);
$keys = $mem->getAllKeys();
$mem->getDelayed($keys);
print_r($mem->fetch());

echo PHP_EOL;