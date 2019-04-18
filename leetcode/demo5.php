<?php

/**
 * User: kendo
 * Date: 2019/3/4
 *
 * https://leetcode-cn.com/problems/longest-palindromic-substring/
 *
 * 最长回文子串(回文串：是一个正读和反读都一样的字符串)
 * 给定一个字符串 s，找到 s 中最长的回文子串。你可以假设 s 的最大长度为 1000。
 *
 * 示例 1：
 *
 * 输入: "babad"
 * 输出: "bab"
 * 注意: "aba" 也是一个有效答案。
 *
 * 示例 2：
 *
 * 输入: "cbbd"
 * 输出: "bb"
 */
class Solution
{

    /**
     * 中心扩展算法
     *
     * @param String $s
     * @return String
     */
    function longestPalindrome($s): string
    {
        $len = strlen($s);
        if ($len <= 1) {
            return '';
        }
        if ($len == 2 && $s[0] == $s[1]) {
            return $s;
        }
        //定义最长的回文子串
        $str = '';

        //单字母中心
        for ($i = 1; $i < $len; $i++) {
            $nowStr = $s[$i];
            if ($i > $len - $i) { //当前字符靠右,则可能存在的回文子串，单边最大长度为 $len-$i
                for ($j = $i + 1; $j < $len; $j++) {
                    if ($s[$j] != $s[$i * 2 - $j]) {
                        break;
                    }
                    $nowStr = $s[$j] . $nowStr . $s[$j];
                }
            } else { //当前字符靠左，则可能存在的回文子串，最大长度为 $i-1
                for ($j = $i - 1; $j >= 0; $j--) {
                    if ($s[$j] != $s[$i * 2 - $j]) {
                        break;
                    }
                    $nowStr = $s[$j] . $nowStr . $s[$j];
                }
            }
            if (strlen($nowStr) > 1 && strlen($nowStr) > strlen($str)) {
                $str = $nowStr;
            }
        }

        //双字母中心
        for ($i = 1; $i < $len - 1; $i++) {
            if ($s[$i] == $s[$i + 1]) {
                $nowStr = $s[$i] . $s[$i + 1];
                if ($i > $len - $i - 1) { //当前字符靠右,则可能存在的回文子串，单边最大长度为 $len-$i-1
                    for ($j = $i + 2; $j < $len; $j++) {
                        if ($s[$j] != $s[$i * 2 - $j + 1]) {
                            break;
                        }
                        $nowStr = $s[$j] . $nowStr . $s[$j];
                    }
                } else {  //当前字符靠左，则可能存在的回文子串，单边最大长度为 $i-1
                    for ($j = $i - 1; $j >= 0; $j--) {
                        if ($s[$j] != $s[$i * 2 - $j + 1]) {
                            break;
                        }
                        $nowStr = $s[$j] . $nowStr . $s[$j];
                    }
                }
            }

            if (strlen($nowStr) > 1 && strlen($nowStr) > strlen($str)) {
                $str = $nowStr;
            }
        }
        return $str;
    }
}

$s = 'aababcaaacaaaaa';
$a = new Solution();
echo $a->longestPalindrome($s), PHP_EOL;