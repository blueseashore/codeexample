<?php
/**
 * User: kendo
 * Date: 2020/7/11
 */

/**
 * @param $val
 * @return string
 */
function filter($val)
{
    return trim($val);
}

$arr = ['', 1, 2, 3, '', null, false];

print_r(array_filter($arr, 'filter'));