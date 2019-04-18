<?php
/**
 * 定义抽象基类
 *      基类里定义其子类的共有方法
 * User: kendo    Date: 2018/11/20
 */

namespace AbstractFactory;

abstract class AbstractFactory
{
    abstract public function createText(string $content): Text;
}