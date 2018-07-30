<?php

/**
 * Redis 测试
 * connection
 */

$redis = new Redis();

if ($redis->connect('127.0.0.1', 6379, 1)) {
    echo '连接Redis服务器成功...', PHP_EOL;
} else {
    exit('连接Redis服务器失败...' . $redis->getLastError() . PHP_EOL);
}
/*
    $redis->connect('127.0.0.1', 6379, 1)
    $redis->open('127.0.0.1', 6379, 1);   //短链接（同上）
    $redis->pconnect('127.0.0.1', 6379, 1); //长链接，本地host，端口6379，1秒超时放弃链接
    $redis->popen('127.0.0.1', 6379, 1);  //长链接（同上）
*/
//$redis->auth('2029@7988=');
//选择redis库，0-15，共16个库
$redis->select(0);
//$redis->close();    //释放资源
//$redis->ping(), PHP_EOL;     //检测是否还在链接，[+pong]
//$redis->ttl('key'); //查看失效时间[-1 | timestamps]
$b = $redis->hGetAll('member1');
print_r($b);die;
$a = ['name'=>'zzw','age'=>28,'info' => [1,2,3,4]];
foreach ($a as $key=>$item){
    $redis->hSet('member1',$key,$item);
}
die;
$key = 'name';
$value = 'test';

$redis->set($key, $value, 1);
$redis->append($key, 'hello');
//$redis->persist('key'); //移除失效时间[1 | 0]
//重置key为整数
$value = 100;
$redis->set($key, $value);

//自增1，如不存在key, 赋值为1(只对整数有效, 存储以10进制64位，redis中为str)[new_num | false]
$redis->incr($key);
//自增$num, 不存在为赋值, 值需为整数[new_num | false]
$num = 11;
$redis->incrby($key, $num);
//自减1，[new_num | false]
$redis->decr($key);
//自减$num，[ new_num | false]
$redis->decrBy($key, $num);

//当key存在时，设置key=value，有效期为10秒[true]
$redis->setex($key, 10, $value);
//当key不存在时，设置key的值
$redis->setnx($key, $value);


$redis->del('myList');
for ($i = 0; $i < 10; $i++) {
    $num = random_int(0, 9999);
    $redis->sAdd('myList', $num);
}

/**
 *  $config
 * 'by' => 'some_pattern_*',
 * 'limit' => array(0, 1),
 * 'get' => 'some_other_pattern_*' or an array of patterns,
 * 'sort' => 'asc' or 'desc',
 * 'alpha' => TRUE,
 * 'store' => 'external-key'
 */
$config = ['sort' => 'desc', 'limit' => [0, 5]];
//返回或保存给定列表、集合、有序集合key中经过排序的元素，$array为参数limit等！【配合$array很强大】 [array|false]
$result = $redis->sort('myList', $config);
echo PHP_EOL;
$redis->hSet('S:D61700370051','userId',1);
$redis->hSet('S:D61700370051','lastTime',12313);
$info = $redis->hMGet('S:D61700370051',['userId','lastTime']);
print_r($info);