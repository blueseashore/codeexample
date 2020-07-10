<?php
/**
 * PHP基础排序算法
 * User: kendo    Date: 2018/8/14
 */


$list = [];
for ($i = 0; $i < 5; $i++) {
    array_push($list, rand(1, 100));
}
echo '原始数组队列:', join(',', $list), PHP_EOL;

/**
 * 冒泡排序
 * @desc
 *      在要排序的一组数中，对当前还未排好的序列，从前往后对相邻的两个数依次进行比较和调整，
 *      让较大的数往下沉，较小的往上冒。
 *      即，每当两相邻的数比较后发现它们的排序与排序要求相反时，就将它们互换
 *      假设数组长度为N，需要进行（N-1）次冒泡，第K次冒泡中，执行 (N-K)次比较,
 *      数组长度为5，执行4次冒泡，每次冒泡分别比较4,3,2,1次
 *      示例数组：[5,2,4,3,1]
 *      第一轮冒泡
 *          2，5，4，3，1
 *          2，4，5，3，1
 *          2，4，3，5，1
 *          2，4，3，1，5
 *      第二轮冒泡
 *          2,4,3,1,5
 *          2,3,4,1,5
 *          2,3,1,4,5
 *      第三轮冒泡
 *          2,3,1,4,5
 *          2,1,3,4,5
 *      第四轮冒泡
 *          1,2,3,4,5
 * @param array $list
 * @return array
 */
function bubbleSort(array $list)
{
    //需要冒泡的次数
    $len = count($list);
    for ($i = 1; $i < $len; $i++) {
        //每轮冒泡需要比较的次数 4->3->2->1
        for ($j = 0; $j < $len - $i; $j++) {
            if($list[$j+1]<$list[$j]){
                $tmp = $list[$j];
                $list[$j] = $list[$j+1];
                $list[$j+1] = $tmp;
            }
        }
    }
    return $list;
}

echo '冒泡排序后:', join(',', bubbleSort($list)), PHP_EOL;

/**
 * 选择排序,假设当前最小
 * @desc
 *      在要排序的一组数中，选出最小的一个数与第一个位置的数交换。
 *      然后在剩下的数当中再找最小的与第二个位置的数交换，如此循环到倒数第二个数和最后一个数比较为止。
 * @param array $list
 * @return array
 */
function selectSort(array $list)
{
    $length = count($list);
    $copyList = $list;
    for ($i = 0; $i < $length - 1; $i++) {
        //假设当前位置是最小值的位置
        $min = $i;
        for ($k = $i + 1; $k < $length; $k++) {
            if ($copyList[$k] < $copyList[$min]) {
                $min = $k;  //寻找最小的是的位置
            }
        }
        if ($min != $i) {   //当前值不是最小值，当前值和最小值位置互换
            $tmp = $copyList[$i];
            $copyList[$i] = $copyList[$min];
            $copyList[$min] = $tmp;
        }
    }
    return $copyList;
}

echo '选择排序后:', join(',', selectSort($list)), PHP_EOL;

/**
 * 插入排序,将第N个数与前面的数依次比较
 * @desc
 *      在要排序的一组数中，假设前面的数已经是排好顺序的，
 *      现在要把第n个数插到前面的有序数中，使得这n个数也是排好顺序的。
 *      如此反复循环，直到全部排好顺序。
 *      示例数组:[6,3,5,1,4]
 *      第一轮
 *             $tmp = 3
 *             3,6,5,1,4
 *      第二轮
 *             $tmp = 5
 *             3,5,6,1,4
 *      第三轮
 *             3,5,1,6,4
 *             3,1,5,6,4
 *             1,3,5,6,4
 *      第四轮
 *             1,3,4,5,6
 * @param array $list
 * @return array
 */
function insertSort(array $list)
{
    $len = count($list);
    for ($i = 1; $i < $len; $i++) {
        $current = $list[$i];
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($current < $list[$j]) {
                $list[$j + 1] = $list[$j];
                $list[$j] = $current;
            } else {
                break;
            }
        }
    }
    return $list;
}

echo '插入排序后:', join(',', selectSort($list)), PHP_EOL;


/**
 * 快速排序
 * @desc
 *      选择一个基准元素，通常选择第一个元素或者最后一个元素。
 *      通过一趟扫描，将待排序列分成两部分，一部分比基准元素小，
 *      一部分大于等于基准元素。此时基准元素在其排好序后的正确位置，
 *      然后再用同样的方法递归地排序划分的两部分
 * @param array $list
 * @return array
 */
function quickSort(array $list)
{
    $length = count($list);
    $copyList = $list;
    if ($length <= 1) {
        return $list;
    }
    //选择第一个元素作为基准
    $baseNum = $copyList[0];
    $leftArr = [];
    $rightArr = [];
    //数组划区
    for ($i = 1; $i < $length; $i++) {
        if ($baseNum < $copyList[$i]) {  //大于基准值放入右边
            $rightArr[] = $copyList[$i];
        } else {//不大于基准值放入左边
            $leftArr[] = $copyList[$i];
        }
    }
    //递归调用
    $leftArr = quickSort($leftArr);
    $rightArr = quickSort($rightArr);

    return array_merge($leftArr, [$baseNum], $rightArr);
}

echo '快速排序后:', join(',', quickSort($list)), PHP_EOL;

function test(array $list){
    $len = count($list);
    if($len<=1){
        return $list;
    }
    $base = $list[0];
    $l = [];
    $r = [];
    for ($i=1;$i<$len;$i++){
        if($list[$i]>$base){
            $r[] = $list[$i];
        }else{
            $l[] = $list[$i];
        }
    }
    $r = test($r);
    $l = test($l);

    return array_merge($l,[$base],$r);
}
echo 'test后:', join(',', test($list)), PHP_EOL;
