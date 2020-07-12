<?php

class A
{
    private $name = "av";
    public $name2 = "av";

    public function toString(){
        return get_object_vars(new self());
    }
}

$a = new A();
print_r($a);