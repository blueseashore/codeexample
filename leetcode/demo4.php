<?php
/**
 * User: kendo
 * Date: 2019/2/20
 *
 * 4. 寻找两个有序数组的中位数
 * 给定两个大小为 m 和 n 的有序数组 nums1 和 nums2。
 *
 * 请你找出这两个有序数组的中位数，并且要求算法的时间复杂度为 O(log(m + n))。
 *
 * 你可以假设 nums1 和 nums2 不会同时为空。
 *
 * 示例 1:
 *
 * nums1 = [1, 3]
 * nums2 = [2]
 *
 * 则中位数是 2.0
 *
 * 示例 2:
 *
 * nums1 = [1, 2]
 * nums2 = [3, 4]
 *
 * 则中位数是 (2 + 3)/2 = 2.5
 */

class Solution
{
    /**
     * 找出中位数所在位置
     *
     * @param $nums1
     * @param $nums2
     * @return float|int
     */
    function findMedianSortedArrays($nums1, $nums2)
    {
        $len1 = count($nums1);
        $len2 = count($nums2);

        /**
         * 计算最大遍历数
         */
        $halfLen = ceil(($len2 + $len1 + 1) / 2);

        /**
         * 声明两个数组的指针
         */
        $point1 = 0;
        $point2 = 0;

        $points = [];
        /**
         * 开始遍历
         */
        while ($halfLen > 0) {
            if (isset($nums1[$point1]) && isset($nums2[$point2])) {
                if ($nums1[$point1] > $nums2[$point2]) {
                    $points[] = $nums2[$point2];
                    $point2++;
                } else {
                    $points[] = $nums1[$point1];
                    $point1++;
                }
            } elseif (isset($nums1[$point1])) {
                $points[] = $nums1[$point1];
                $point1++;
            } elseif (isset($nums2[$point2])) {
                $points[] = $nums2[$point2];
                $point2++;
            }
            $halfLen--;
        }
//        print_r($points);
//        echo '数组总长度:', $len1 + $len2, PHP_EOL;
//        echo '数组1指针:', $point1, '_数组2指针:', $point2, PHP_EOL;
        if (($len2 + $len1) % 2) { //中位数是一个数
//            echo '奇数,中位数', PHP_EOL;
            return $points[count($points) - 1];
        } else { //中文数为中间的两个数之和的二分之一
//            echo '偶数,中位数', PHP_EOL;
            return ($points[count($points) - 1] + $points[count($points) - 2]) / 2;
        }
    }
}

$nums1 = [-2, -1, -0.5];
$nums2 = [];
$class = new Solution();
$a = $class->findMedianSortedArrays($nums1, $nums2);
print_r($a);
echo PHP_EOL;