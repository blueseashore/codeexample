<?php
function insertsort($arr){
    $num = count($arr);
    // 遍历数组
    for ($i = 1;$i < $num; $i++) {
        // 获得当前值
        $iTemp = $arr[$i];
        // 获得当前值的前一个位置
        $iPos = $i - 1;
        // 如果当前值小于前一个值切未到数组开始位置
        while (($iPos >= 0) && ($iTemp < $arr[$iPos])) {
            // 把前一个的值往后放一位
            $arr[$iPos + 1] = $arr[$iPos];
            // 位置递减
            $iPos--;
        }
         $arr[$iPos+1] = $iTemp;
    }
    return $arr;
}

function BubbleSort($arr) {
    // 获得数组总长度
    $num = count($arr);
    // 正向遍历数组
    for ($i = 1; $i < $num; $i++) {
        // 反向遍历
        for ($j = $num - 1; $j >= $i ; $j--) {
            // 相邻两个数比较
            if ($arr[$j] < $arr[$j-1]) {
                // 暂存较小的数
                $iTemp = $arr[$j-1];
                // 把较大的放前面
                $arr[$j-1] = $arr[$j];
                // 较小的放后面
                $arr[$j] = $iTemp;
            }
        }
    }
    return $arr;
}

$a  =[12,5,6,8,9,0,11,16,200,111,169];
$b = BubbleSort($a);
print_r($b);