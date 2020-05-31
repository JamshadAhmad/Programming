<?php

function secondMax($arr) { //O(N x Log(N)), also it can return max if max is repeated
    rsort($arr); //reverse sort the numbers
    return $arr[1];
}

function secondMaximum(&$arr) { //O(N), only actual second max value is returned
    $s = count($arr);

    $max1 = $max2 = $arr[0];

    for ($i = 1; $i < $s; ++$i) {
        if ($arr[$i] > $max1) {
            $max2 = $max1;
            $max1 = $arr[$i];
        } elseif ($arr[$i] > $max2 && $arr[$i] < $max1) {
            $max2 = $arr[$i];
        }
    }
    return $max2;
}

function secondMinimum(&$arr) { //O(N), only actual second min value is returned
    $s = count($arr);

    $min1 = $min2 = $arr[0];

    for ($i = 1; $i < $s; ++$i) {
        if ($arr[$i] < $min1) {
            $min2 = $min1;
            $min1 = $arr[$i];
        } elseif ($arr[$i] < $min2 && $arr[$i] > $min1) {
            $min2 = $arr[$i];
        }
    }
    return $min2;
}


$arr = [4, 5, 3, -1, 7, 4, 7, 6, 9, 9];

echo secondMaximum($arr) . PHP_EOL;
echo secondMinimum($arr) . PHP_EOL;