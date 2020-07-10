<?php
/**
 * User: kendo
 * Date: 2019/3/19
 */
$baseUri = 'http://www.shuquge.com/txt/5809/';
$baseUrl = '/Users/kendo/Desktop/yz.html';
$content = file_get_contents($baseUrl);
$pattern = '/<dt>.*<\/dt>/';
preg_match_all($pattern, $content, $list);
$positon = stripos($content, $list[0][1]);
$content = substr($content, $positon);
//开始匹配章节
$pattern = '/<dd>.*<\/dd>/';
preg_match_all($pattern, $content, $list);
foreach ($list[0] as $item) {
    $title =  strip_tags($item);
    $patternUrl = '/href="(.*)"/';
    preg_match($patternUrl, $item, $itemInfo);
    echo $title,$baseUri.$itemInfo[1],PHP_EOL;
}