<?php

function flatten($arr) { //O(n * depth)
    if (empty($arr)) {
        return [];
    }
    $result = [];

    foreach ($arr as $iValue) {
        if (is_array($iValue)) {
            $result = array_merge($result, flatten($iValue));
        } else {
            $result[] = $iValue;
        }
    }
    return $result;
}

$arr = [[1], [2, 3], 4, [[[5]]], 6, [7, [8]]];

$arr = flatten($arr);

foreach ($arr as $v) {
    echo $v . ' ';
}