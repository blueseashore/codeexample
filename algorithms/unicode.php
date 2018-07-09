<?php

/**
 * 【十进制数字】NUM转【N进制数字】,2<= N <=36
 * 1、获取NUM对应A位的N进制数,  A满足关系: NUM <= pow(N,A);
 * 2、从A位开始，循环A次，循环一次后A--
 *     循环内，判断  NUM 大于等于 J * pow(N,A)，
 *      则第A位取J,NUM -= J * pow(N,A) ,跳至下一位判断
 *     否则第A位取0
 */

/**
 * 数字转换为正确的值
 * @param int $j
 * @return int|string
 */
function toJ($j = 0)
{
    if ($j < 10) {
        return $j;
    } else {
        return chr(65 + $j - 10);
    }
}

/**
 * 十进制数转BASE进制数
 * @param int $num
 * @param int $base
 * @return string
 */
function toN($num = 0, $base = 2)
{
    if ($base > 36 || $base < 2) {
        return '进制溢出';
    }
    $data = [];
    for ($i = calPow($num, $base); $i > 0; $i--) {
        if ($num >= pow($base, ($i - 1))) {
            for ($j = $base - 1; $j >= 0; $j--) {
                if ($num >= $j * (pow($base, $i - 1))) {
                    $num -= $j * pow($base, ($i - 1));
                    $data[] = toJ($j);
                    break;
                }
            }
        } else {
            $data[] = 0;
        }
    }
    return join('', $data);
}

echo (!empty($argv[2]) ? $argv[2] : 2) . '进制:', toN(!empty($argv[1]) ? $argv[1] : 0, !empty($argv[2]) ? $argv[2] : 2), PHP_EOL;

/**
 * 返回最大的位数
 * @param int $num
 * @param int $base
 * @return int
 */
function calPow($num = 0, $base = 2)
{
    $n = 0;
    while ($num > pow($base, $n)) {
        $n++;
    }
    return $n;
}

/**
 * 十进制转二进制
 * @param int $num
 * @return string
 */
function to2($num = 0)
{
    $data = [];
    for ($i = calPow($num, 2); $i > 0; $i--) {
        if ($num >= pow(2, ($i - 1))) {
            $num -= pow(2, ($i - 1));
            $data[] = 1;
        } else {
            $data[] = 0;
        }
    }
    return join('', $data);
}

echo '二进制:', to2($argv[1]), PHP_EOL;

function to4($num = 0)
{
    $data = [];
    for ($i = calPow($num, 4); $i > 0; $i--) {
        if ($num >= pow(4, ($i - 1))) {
            for ($j = 3; $j >= 0; $j--) {
                if ($num >= $j * (pow(4, $i - 1))) {
                    $num -= $j * pow(4, ($i - 1));
                    $data[] = $j;
                    break;
                }
            }
        } else {
            $data[] = 0;
        }
    }
    return join('', $data);
}

echo '四进制:', to4($argv[1]), PHP_EOL;

function to8($num = 0, $len = 8)
{
    $data = [];
    for ($i = calPow($num, 8); $i > 0; $i--) {
        if ($num >= pow(8, $i - 1)) {
            for ($j = 7; $j >= 0; $j--) {
                if ($num >= $j * (pow(8, $i - 1))) {
                    $num -= $j * pow(8, ($i - 1));
                    $data[] = $j;
                    break;
                }
            }

        } else {
            $data[] = 0;
        }
    }
    return join('', $data);
}

echo '八进制:', to8($argv[1]), PHP_EOL;
