<?php
/**
 * User: kendo
 * Date: 2019/3/7
 */

require_once '../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));
        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack) - 1]);
        $this->assertEquals(1, count($stack));
        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }
}
SeasLog::info('SUCCESS',[],'a');
$stackTest = new StackTest();
$stackTest->testPushAndPop();