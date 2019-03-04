<?php
/**
 * User: kendo    Date: 2018/11/20
 */

namespace DesignPatterns\AbstractFactory;

class JsonFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new JsonText($content);
    }
}
