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
function toJ($j = 0, $alphabet = TRUE)
{
    if ($alphabet) {
        return chr(65 + $j);
    }
    if ($j < 10) {
        return $j;
    } else {
        return chr(65 + $j - 10);
    }
}


$num = isset($argv[1]) ? intval($argv[1]) : 0;

$base = isset($argv[2]) ? intval($argv[2]) : 2;

/**
 * 每位数字对应字母
 *  0 => A
 *  1 => B
 *  2 => C
 *  3 => D
 *  4 => E
 *  5 => F
 *  6 => G
 *  7 => H
 *  8 => I
 *  9 => K
 * @param int $num
 */
function toAlphabet($num = 1)
{
    $data = [];
    for ($i = 0; $i < strlen($num); $i++) {
        $data[] = chr($num[$i] + 66);
    }
    echo join('', $data), PHP_EOL;
}

/**
 * 返回最大的次方数
 * @param int $num
 * @param int $base
 * @return int
 */
function calPow($num = 0, $base = 2)
{
    $n = 0;

    while ($num >= pow($base, $n)) {
        ++$n;
    }
    return $n;
}

/**
 * 十进制数转BASE进制数
 * @param int $num 10进制数字
 * @param int $base 需要转换到多少进制
 * @param bool $toA 是否转换为字母，TRUE=转换为字母，FALSE=不转换
 * @return string
 */
/**
 * @param int $num
 * @param int $base
 * @param bool $toA
 * @return string
 */
function toN($num = 0, $base = 2, $toA = FALSE)
{
    $num = intval($num);
    $base = intval($base);
    if ($base > 36 || $base < 2) {
        return '进制溢出';
    }
    $data = [];
    /**
     * 零次方情况
     * 非零次方情况
     */
    $powNum = calPow($num, $base);

    if ($powNum == 0) {   //零次方
        $data[] = toJ(0, $toA);
    } else {  //非零次方
        for ($i = $powNum; $i >= 0; $i--) {
            for ($j = $base - 1; $j >= 0; $j--) {
                if ($num >= $j * pow($base, $i)) {
                    $data[] = toJ($j, $toA);
                    $num -= $j * pow($base, $i);
                    break;
                }
            }
        }
    }
    return join('', $data);
}

function saveUserCommendCode($userId = 0)
{
    $data = [];
    /**
     * 零次方情况
     * 非零次方情况
     */
    $num = $userId+10000;
    $powNum = 0;

    while ($num >= pow(26, $powNum)) {
        ++$powNum;
    }
    for ($i = $powNum; $i >= 0; $i--) {
        for ($j = 25; $j >= 0; $j--) {
            if ($num >= $j * pow(26, $i)) {
                $data[] = chr(65 + $j);
                $num -= $j * pow(26, $i);
                break;
            }
        }
    }

    return join('', $data);
}
//echo toN($num, $base), PHP_EOL;
$list = [];
for ($i = 1; $i < 100000; $i++) {


//    $outPut = toN($i, 26, TRUE);
    $outPut = saveUserCommendCode($i);
    $list[$outPut] = $outPut;
    echo $i, ':', $outPut, PHP_EOL;
}
echo count($list);die;
/**
 * 10进制转二进制
 * @param int $num
 * @return string
 */
function to2($num = 0)
{
    $data = [];
    for ($i = calPow($num, 2); $i > 0; $i--) {
        if ($num == pow(2, ($i - 1))) {
            $num -= pow(2, ($i - 1));
            $data[] = 1;
        } elseif ($num > pow(2, ($i - 1))) {
            $num -= pow(2, ($i - 1));
            $data[] = 1;
        } else {
            $data[] = 0;
        }
    }
    if (empty($data)) {
        $data[] = 0;
    }
    return join('', $data);
}

echo '二进制:', to2($num), PHP_EOL;

/**
 * 10进制转4进制
 * @param int $num
 * @return string
 */
function to4($num = 0)
{
    $data = [];
    for ($i = calPow($num, 4); $i > 0; $i--) {
        if ($num >= pow(4, ($i - 1))) {
            for ($j = 4; $j >= 0; $j--) {
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
    if (empty($data)) {
        $data[] = 0;
    }
    return join('', $data);
}

echo '四进制:', to4($num), PHP_EOL;

/**
 * 10进制转8进制
 * @param int $num
 * @return string
 */
function to8($num = 0)
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
    if (empty($data)) {
        $data[] = 0;
    }
    return join('', $data);
}

echo '八进制:', to8($num), PHP_EOL;
