<?php

/**
 * User: kendo
 * Date: 2019/3/6
 *
 * https://leetcode-cn.com/problems/palindrome-number/
 *
 * 9. 回文数
 * 判断一个整数是否是回文数。回文数是指正序（从左向右）和倒序（从右向左）读都是一样的整数。
 *
 * 示例 1:
 *
 * 输入: 121
 * 输出: true
 *
 * 示例 2:
 *
 * 输入: -121
 * 输出: false
 * 解释: 从左向右读, 为 -121 。 从右向左读, 为 121- 。因此它不是一个回文数。
 *
 * 示例 3:
 *
 * 输入: 10
 * 输出: false
 * 解释: 从右向左读, 为 01 。因此它不是一个回文数。
 */
class Solution
{

    /**
     * @param Integer $x
     * @return Boolean
     */
    function isPalindrome($x)
    {
        if ($x[0] == '-') {
            $x = substr($x, 1);
        }
        $len = strlen($x);
        $halfLen = (int)ceil($len / 2);
        if ($len % 2 == 0) { //偶数各，中间两个数字必须相同
            if ($x[$halfLen - 1] != $x[$halfLen]) {
                return false;
            }
            $halfLen--;
        }
        for ($i = 0; $i < $halfLen; $i++) {
            if ($x[$i] != $x[-$i]) {
                return false;
            }
        }
        return true;
    }
}

$class = new Solution();
var_dump($class->isPalindrome('10'));