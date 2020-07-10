<?php
/**
 * 抽象工厂模式测试类
 * User: kendo    Date: 2018/11/20
 */

namespace AbstractFactory;
require_once '../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    protected $_text = 'hello';


    /**
     * 测试是否能够创建HtmlText的对象
     *
     */
    public function testCanCreateHtmlText()
    {
        $factory = new HtmlFactory();
        $text = $factory->createText($this->_text);
        $this->assertInstanceOf(HtmlText::class, $text);
    }

    /**
     * 测试是否能够创建JsonText的对象
     */
    public function testCanCreateJsonText()
    {
        $factory = new JsonFactory();
        $text = $factory->createText($this->_text);
        $this->assertInstanceOf(JsonText::class, $text);
    }
}

$test = new AbstractFactoryTest();
/**
 * 如果类的继承关系不对，会报：PHP Fatal error:
 */
$test->testCanCreateHtmlText();
$test->testCanCreateJsonText();