<?php
/**
 * User: kendo
 * Date: 2020/7/11
 */


function tryF()
{
    try {
        throw new \Exception('error');
    } catch (\Throwable $e) {

    } finally {
        return 1;
    }
    return 2;
}

var_dump(tryF());