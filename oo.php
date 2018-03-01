<?php
/**
 * User: kendo    Date: 2018/3/1
 */

class Test{
    public static $title = 'ci';
    public $content;

    public static function say(){
        echo self::$title;
        return 'hello';
    }

    public function get(){
        echo $this::$title;
        echo $this::say();
        echo $this->content;
        echo 'hi';
    }
}

$test = new Test();
$test->get();
