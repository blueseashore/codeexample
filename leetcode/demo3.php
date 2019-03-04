<?php
/**
 * User: kendo
 * Date: 2019/2/19
 * 3. 无重复字符的最长子串
 * 给定一个字符串，请你找出其中不含有重复字符的 最长子串 的长度。
 *
 * 示例 1:
 *
 * 输入: "abcabcbb"
 * 输出: 3
 * 解释: 因为无重复字符的最长子串是 "abc"，所以其长度为 3。
 *
 * 示例 2:
 *
 * 输入: "bbbbb"
 * 输出: 1
 * 解释: 因为无重复字符的最长子串是 "b"，所以其长度为 1。
 *
 * 示例 3:
 *
 * 输入: "pwwkew"
 * 输出: 3
 * 解释: 因为无重复字符的最长子串是 "wke"，所以其长度为 3。
 * 请注意，你的答案必须是 子串 的长度，"pwke" 是一个子序列，不是子串。
 */

class Solution
{
    /**
     * 滑动窗口
     *
     * @param $s
     * @return int|mixed
     */
    function lengthOfLongestSubstring($s)
    {
        //获取字符长度
        $len = strlen($s);
        //定义字符索引
        $set = [];
        //定义最大不重重字符串的长度
        $max = 0;

        for ($i = 0, $j = 0; $j < $len; $j++) {
            if (isset($set[$s[$j]])) {
                $i = max($set[$s[$j]],$i);
            }
            $max = max($max,$j+1-$i);
            $set[$s[$j]] = $j + 1;
        }
        return $max;
    }
}

$class = new Solution();
$result = $class->lengthOfLongestSubstring('hello world');
echo $result,PHP_EOL;