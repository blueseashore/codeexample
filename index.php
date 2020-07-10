<?php

function generateArr(int $len): array
{
    $arr = [];
    for ($i = 0; $i < $len; $i++) {
        array_push($arr, rand(1, 100));
    }
    return $arr;
}

function fsort(array $arr): array
{
    $len = count($arr);
    for ($i = 1; $i < $len; $i++) {
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($arr[$j] > $arr[$j + 1]) {
                $tmp = $arr[$j + 1];
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp;
            } else {
                break;
            }
        }
    }
    return $arr;
}

for ($i = 1; $i < 10; $i++) {
    $arr = generateArr(7);
    print_r(fsort($arr));
}

interface a{

}
interface b{

}

interface c extends a,b{

}
class d{}
class e{}