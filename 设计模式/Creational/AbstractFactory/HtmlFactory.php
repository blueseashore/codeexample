<?php
/**
 * User: kendo    Date: 2018/11/20
 */

namespace AbstractFactory;

class HtmlFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new HtmlText($content);
    }
}