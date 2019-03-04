<?php

$arr = [111,5, 2, 0, 1, 4, 3, 1,1231,33,22,31];

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
        if ($i ==2)return $list;
    }
    return $list;
}

print_r(insertSort($arr));