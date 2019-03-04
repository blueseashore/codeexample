<?php


function handler(Throwable $e)
{
    echo $e->getMessage(), PHP_EOL;
}

//set_exception_handler('handler');
try {
    throw new DivisionByZeroError('哈哈');
} catch (Error $error) {
    echo $error->getMessage();
}

