<?php

/**
 * User: kendo
 * Date: 2019/3/4
 * https://leetcode-cn.com/problems/reverse-integer/
 *
 * 7. 整数反转
 * 给出一个 32 位的有符号整数，你需要将这个整数中每位上的数字进行反转。
 *
 * 示例 1:
 *
 * 输入: 123
 * 输出: 321
 *
 * 示例 2:
 *
 * 输入: -123
 * 输出: -321
 *
 * 示例 3:
 *
 * 输入: 120
 * 输出: 21
 *
 * 注意:
 *
 * 假设我们的环境只能存储得下 32 位的有符号整数，则其数值范围为 [−231,  231 − 1]。请根据这个假设，如果反转后整数溢出那么就返回 0。
 */
class Solution
{

    /**
     * @param Integer $x
     * @return Integer
     */
    function reverse(int $x): int
    {
        $res = 0; //定义最终结果
        $max = pow(2, 31) - 1;
        $min = pow(-2, 31);
        while ($x != 0) {
            if ($res > ($max - $x % 10) / 10 || $res < ($min - $x % 10) / 10) {
                return 0;
            }
            $res = $res * 10 + $x % 10;
            $x = intval($x / 10);
        }
        return $res;
    }
}

$class = new Solution();
echo $class->reverse(-11111110000020), PHP_EOL;
