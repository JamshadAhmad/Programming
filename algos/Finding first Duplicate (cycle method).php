<?php
// Assume there is only one number duplicated, may be multiple times
//
function getDuplicate($arr) { //O(n) time and O(n) space
    $hash = [];

    foreach ($arr as $v) {
        if (array_key_exists($v, $hash)) {
            return $v;
        }
        $hash[$v] = true;
    }
    return false;
}

$arr = [1, 4, 2, 3, 6, 1, 7];

echo getDuplicate($arr) . PHP_EOL;
