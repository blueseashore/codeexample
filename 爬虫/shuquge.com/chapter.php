<?php
/**
 * User: kendo
 * Date: 2019/3/19
 */

$con = mysqli_connect('127.0.0.1', 'root', 123456);
mysqli_select_db($con, 'crawl');

$baseUri = 'http://www.shuquge.com/txt/8072/';
$baseUrl = '/Users/kendo/Desktop/fjwd.html';
$content = file_get_contents($baseUrl);
$pattern = '/<dt>.*<\/dt>/';
preg_match_all($pattern, $content, $list);
$position = stripos($content, $list[0][0]);
$content = substr($content, $position);
//开始匹配章节
$pattern = '/<dd>.*<\/dd>/';
preg_match_all($pattern, $content, $list);

$delStr = '<br/><br/>请记住本书首发域名：www.shuquge.com。书趣阁_笔趣阁手机版阅读网址：m.shuquge.com</div>';
$delStr2 = '<divid="content"class="showtxt">';
$delStr3 = '</div>';
foreach ($list[0] as $item) {
    $title = strip_tags($item);
    $patternUrl = '/href="(.*)"/';
    preg_match($patternUrl, $item, $itemInfo);
    $chapterUri = $baseUri . $itemInfo[1];
    $chapterContent = file_get_contents('compress.zlib://' . $chapterUri);
    $patternChapter = '/<div id="content" class="showtxt">.*?<\/div>/s';
    preg_match($patternChapter, $chapterContent, $chapterList);
    $chapterContent = $chapterList[0];
    $chapterContent = str_replace([chr(10), chr(13), PHP_EOL, ' ', '　　'], ['', '', '', '', ''], $chapterContent);
    $chapterContent = str_replace($chapterUri, '', $chapterContent);
    $chapterContent = str_replace([$delStr, $delStr2,$delStr3], '', $chapterContent);
    $chapter = [
        'chapter_title' => str_replace('正文 ', '', $title),
        'chapter_content' => $chapterContent,
        'key_words' => str_replace('正文 ', '', $title),
    ];

    $insertSql = "insert into chapter(`novel_id`,`chapter_title`,`chapter_content`,`key_words`)VALUE(4,'{$chapter['chapter_title']}','{$chapter['chapter_content']}','{$chapter['key_words']}')";
    mysqli_query($con, $insertSql);
    echo mysqli_error($con);
}

