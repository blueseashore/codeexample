<?php
/**
 * User: kendo    Date: 2018/2/27
 */

class  Test
{
    public function say()
    {
        return 'hello';
    }
}

function tell($a = '')
{
    return $a;
}

$soap = new SoapServer(null, array('location' => './test.php', 'uri' => "abc"));
$soap->setClass('Test');
$soap->addFunction('tell');
$soap->handle();