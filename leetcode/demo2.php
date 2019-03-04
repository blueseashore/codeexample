<?php
/**
 * User: kendo
 * Date: 2019/2/19
 * 2. 两数相加
 * 给出两个 非空 的链表用来表示两个非负的整数。其中，它们各自的位数是按照 逆序 的方式存储的，并且它们的每个节点只能存储 一位 数字。
 *
 * 如果，我们将这两个数相加起来，则会返回一个新的链表来表示它们的和。
 *
 * 您可以假设除了数字 0 之外，这两个数都不会以 0 开头。
 *
 * 示例：
 *
 * 输入：(2 -> 4 -> 3) + (5 -> 6 -> 4)
 * 输出：7 -> 0 -> 8
 * 原因：342 + 465 = 807
 */

require './Node.php';

class Solution
{
    /**
     * @param $l1
     * @param $l2
     * @return int|string
     */
    function addTwoNumbers($l1, $l2)
    {
        $len1 = countNode($l1);
        $len2 = countNode($l2);
        if ($len1 != $len2 || $len1 == 0) {
            return 0;
        }
        $nums1 = [];
        $nums2 = [];
        for ($i = 0; $i < $len1; $i++) {
            $nums1[] = $l1->next->data;
            $nums2[] = $l2->next->data;
            $l1 = $l1->next;
            $l2 = $l2->next;
        }
        $nums1 = array_reverse($nums1);
        $nums2 = array_reverse($nums2);

        return join('', $nums1) + join('', $nums2);
    }
}

$l1 = new Node(null);
appendNode($l1, 2);
appendNode($l1, 4);
appendNode($l1, 3);

$l2 = new Node(null);
appendNode($l2, 5);
appendNode($l2, 6);
appendNode($l2, 4);

$class = new Solution();

$nums = $class->addTwoNumbers($l1, $l2);

print_r($nums);
