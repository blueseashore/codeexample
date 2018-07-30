<?php
/**
 * User: kendo    Date: 2018/3/1
 */
$str = 'Hello the world ! My name is abcde12f1g! ad ';
//$pattern = '/hello/';   //匹配hello
//$pattern = '/hello/i';   //匹配hello，不区分大小写
//$pattern = '/\w{8,}/';      //匹配至少8个字母的字符
//$pattern = '/\w{3,4}/';      //匹配3,4个字母的字符
//$pattern = '/^hello.*d$/';  //hello 开头,d结尾，中间任意字符
//$pattern = '/^hello.*d/';  //hello开头,到遇到最后一个d，中间任意字符，贪婪匹配
//$pattern = '/^hello.*?d/';  //hello开头,到遇到第一个d就中断，中间任意字符，惰性匹配
//$pattern = '/[\w\s!]{1,}/';     //任意字符+空格+!
//preg_match($pattern,$str,$res);


$email = '455011-_9825@qq.com';

$pattern = '/^[\w\_\-]{1,}@[\w]{1,}.(com|cn|net)/'; //匹配邮箱
preg_match($pattern,$email,$res);
print_r($res);