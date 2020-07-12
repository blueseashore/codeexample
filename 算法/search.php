<?php
/**
 * User: kendo
 * Date: 2020/7/12
 */
/**
 * 二分法查找【前提：有序数组】
 *
 * @param array $arr
 * @param int $startKey
 * @param int $endKey
 * @param int $value
 * @return int
 */
function binarySearch(array $arr, int $startKey, int $endKey, int $value): int
{
    if ($startKey <= $endKey) {
        // 取中间的key
        $middenKey = intval(($startKey + $endKey) / 2);
        if ($arr[$middenKey] == $value) { // 中间值，和value一致
            return $middenKey;
        }

        // 中间key对应的value大于val，递归左侧，否则递归右侧
        echo 'start:', $startKey, 'end:', $endKey, PHP_EOL;
        if ($arr[$middenKey] > $value) {
            return binarySearch($arr, $startKey, $middenKey - 1, $value);
        } else {
            return binarySearch($arr, $middenKey + 1, $endKey, $value);
        }
    }

    return -1;
}

$arr = [];
for ($i = 0; $i < 100; $i++) {
    $arr[] = random_int(0, 100);
}
sort($arr);
var_dump(binarySearch($arr, 0, 99, 88));

/**
 * 线性表的删除
 *  将需要删除的元素都的元素，全部向前移动一位
 *
 * @param array $arr
 * @param int $i 需要删除的元素位置
 * @return array
 */
function deleteElement(array $arr, int $i): array
{
    $len = count($arr);
    for ($j = $i; $j < $len; $j++) {
        $arr[$j] = $arr[$j + 1];
    }
    // 移除最后一位，因为最后一位和其前一位相同
    array_pop($arr);
    return $arr;
}