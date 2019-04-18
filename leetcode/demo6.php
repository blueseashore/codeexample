<?php

/**
 * User: kendo
 * Date: 2019/3/4
 * https://leetcode-cn.com/problems/zigzag-conversion/
 *
 * 6. Z 字形变换 (看成N字)
 * 将一个给定字符串根据给定的行数，以从上往下、从左到右进行 Z 字形排列。
 *
 * 比如输入字符串为 "LEETCODEISHIRING" 行数为 3 时，排列如下：
 *
 * L     C   I   R
 * E  T  O E S I I G
 * E     D   H   N
 *
 * 之后，你的输出需要从左往右逐行读取，产生出一个新的字符串，比如："LCIRETOESIIGEDHN"。
 *
 * 请你实现这个将字符串进行指定行数变换的函数：
 *
 * string convert(string s, int numRows);
 *
 * 示例 1:
 *
 * 输入: s = "LEETCODEISHIRING", numRows = 3
 * 输出: "LCIRETOESIIGEDHN"
 *
 * 示例 2:
 *
 * 输入: s = "LEETCODEISHIRING", numRows = 4
 * 输出: "LDREOEIIECIHNTSG"
 * 解释:
 *
 * L     D     R
 * E   O E   I I
 * E C   I H   N
 * T     S     G
 */
class Solution
{

    /**
     * N字变换，
     * $numRows>=3
     *  从上往下N呢，从左下往右上N-2个,然后从上往下N个，从左下往右上N-2个...
     * $numRows<3
     * @param String $s
     * @param Integer $numRows
     * @return String
     */
    function convert($s, $numRows)
    {
        if ($numRows <= 2) {
            return '';
        }
        $len = strlen($s);
        $strArr = [];   //定义存储各阶字符的数组,阶数：$numRows-1
        $sort = true; //首先正序
        for ($i = 0, $step = 0; $i < $len; $i++) {
            $strArr[$step][] = $s[$i];
            if ($sort) { //从上往下
                $step++;
                if ($step == $numRows) { //下一次会溢出，反转顺序，直接重置为最大阶数
                    $sort = false;
                    $step = $numRows - 1; //$step--
                }
            }

            if (!$sort) {
                $step--;
                if ($step == 0) { //第0个是公用的，所以当 step=1是，就只为0 ，然后从正序开始
                    $sort = true;
                    $step = 0;
                }
            }
        }
        $s = '';
        foreach ($strArr as $str) {
            $s .= join('', $str);
        }
        return $s;
    }
}

$s = "LEETCODEISHIRING";
$class = new Solution();
echo $class->convert($s, 6), PHP_EOL;


