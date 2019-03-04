<?php
/**
 * User: kendo    Date: 2018/11/20
 */

namespace DesignPatterns\AbstractFactory;

abstract class Text
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}