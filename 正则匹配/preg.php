<?php
/**
 * User: kendo    Date: 2018/3/1
 */
/**
 * \w 表示匹配除“\n”之外的任何单个字符。.是可以匹配"\r"的
 */
$str = 'Hello the world ! My name is blueSeashore .';
//$pattern = '/hello/';   //匹配hello
$pattern = '/hello/i';   //匹配hello，不区分大小写
//$pattern = '/\w{8,}/';      //匹配至少8个字母的字符
//$pattern = '/\w{3,4}/';      //匹配3,4个字母的字符
//$pattern = '/^hello.*d$/';  //hello 开头,d结尾，中间任意字符
//$pattern = '/^hello.*d/';  //hello开头,到遇到最后一个d，中间任意字符，贪婪匹配
//$pattern = '/^hello.*?d/';  //hello开头,到遇到第一个d就中断，中间任意字符，惰性匹配
//$pattern = '/[\w\s!]{1,}/';     //任意字符+空格+!
preg_match($pattern, $str, $res);
print_r($res);

// 邮箱匹配
$email = '4550119825@qq.com';
$pattern = '/^[\w]{1,}@[\w]{1,}.([a-zA-z]{1,3})$/';
preg_match($pattern, $email, $matches);
print_r($matches);
$pattern = "/^([0-9a-zA-Z-]+)@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+){1,3}$/";
preg_match($pattern, $email, $matches);
print_r($matches);

$html = "<body><script src='index.js'></script></body>";
// 匹配脚本
$pattern = '/<script.*>.?<\/script>/';
preg_match($pattern, $html, $matches);
print_r($matches);
