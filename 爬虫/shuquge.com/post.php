<?php
/**
 * User: kendo
 * Date: 2019/3/19
 */
date_default_timezone_set('Asia/Shanghai');


$con = new mysqli('127.0.0.1', 'root', 123456);
$con->select_db('crawl');

$list = $con->query('SELECT * FROM chapter WHERE novel_id =4 and id =2172 order by id asc');
while ($row = mysqli_fetch_assoc($list)) {
    $time = date('Y-m-d H:i:s');
    $post_name = urlencode($row['chapter_title']);
    $insertSql = "INSERT INTO wordpress.wp_posts(
    `post_author`, 
    `post_date`, 
    `post_date_gmt`, 
    `post_content`, 
    `post_title`, 
    `post_excerpt`, 
    `post_status`, 
    `comment_status`, 
    `ping_status`, 
    `post_name`, 
    `to_ping`, 
    `pinged`, 
    `post_modified`, 
    `post_modified_gmt`, 
    `post_content_filtered`, 
    `guid`, 
    `post_type` 
)VALUE(
    1,
    '{$time}',
    '{$time}',
    '{$row['chapter_content']}',
     '{$row['chapter_title']}',
    '',
    'publish',
    'open',
    'open',
    '{$post_name}',
    '',
    '',
    '{$time}',
     '{$time}',
    '',
    '',
    'post'
)";
    $con->query($insertSql);
    echo $con->error;
    $postId = $con->insert_id;
    $insertSql2 = "insert into wordpress.wp_term_relationships(
    `object_id`,
    `term_taxonomy_id`
)value(
  $postId,
  43
)";
    $con->query($insertSql2);
    sleep(1);
}