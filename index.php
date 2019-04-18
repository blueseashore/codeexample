<?php
/**
 * User: kendo
 * Date: 2019/3/5
 */
$a = [1, 3, 4, 88, 11, 22, 99, 43, 42, 65, 56,];

function bubbleSort(array $a): array
{
    $len = count($a);
    for ($i = 0; $i < $len - 1; $i++) {
        for ($j = 0; $j < $len - $i - 1; $j++) {
            if ($a[$j] > $a[$j + 1]) {
                $tmp = $a[$j + 1];
                $a[$j + 1] = $a[$j];
                $a[$j] = $tmp;
            }
        }
    }
    return $a;
}

echo '冒泡排序', PHP_EOL;
print_r(bubbleSort($a));

function selectSort(array $a): array
{
    $len = count($a);
    for ($i = 0; $i < $len-1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $len; $j++) {
            if ($a[$j] < $a[$min]) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $tmp = $a[$i];
            $a[$i] = $a[$min];
            $a[$min] = $tmp;
        }
    }
    return $a;
}

echo '选择排序', PHP_EOL;
print_r(selectSort($a));

function insertSort(array $a): array
{
    $len = count($a);
    for ($i = 1; $i < $len; $i++) {
        $current = $a[$i];
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($a[$j] > $current) {
                $tmp = $a[$j];
                $a[$j] = $current;
                $a[$j + 1] = $tmp;
            }
        }
    }
    return $a;
}

echo '插入排序', PHP_EOL;
print_r(insertSort($a));

function quickSort(array $a): array
{
    $len = count($a);
    if ($len <= 1) {
        return $a;
    }
    $baseNum = $a[0];
    $left = [];
    $right = [];
    for ($i = 1; $i < $len; $i++) {
        if ($a[$i] > $baseNum) {
            $right[] = $a[$i];
        } else {
            $left[] = $a[$i];
        }
    }
    $left = quickSort($left);
    $right = quickSort($right);
    return array_merge($left, [$baseNum], $right);
}

echo '快速排序', PHP_EOL;
print_r(quickSort($a));
