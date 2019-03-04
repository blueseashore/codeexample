<?php
/**
 * User: kendo    Date: 2018/11/20
 */

namespace DesignPatterns\AbstractFactory;

abstract class AbstractFactory
{
    abstract public function createText(string $content): Text;
}