<?php

//Algorithms on sorted arrays
//min($arr) is O(1)
//max($arr) is O(1)
//middleElement($arr) is O(1)
//Search O(log(n))

/**
 * Returns index of element
 * @param array $arr
 * @param mixed $v
 * @return int
 */
function getIndex($arr, $v) {
    $l = count($arr);
    $startIndex = 0;
    $endIndex = $l - 1;
    $middleIndex = floor(($startIndex + $endIndex) / 2);
    //$steps = 1;

    while ($startIndex < $endIndex) {
        if ($arr[$middleIndex] === $v) {
            //echo 'steps = ' . $steps . PHP_EOL;
            return $middleIndex;
        } elseif ($arr[$middleIndex] > $v) {
            $endIndex = $middleIndex - 1;
            $middleIndex = floor(($startIndex + $endIndex) / 2);
        } else {
            $startIndex = $middleIndex + 1;
            $middleIndex = floor(($startIndex + $endIndex) / 2);
        }
        //$steps++;
    }
    //echo 'Steps = ' . $steps . PHP_EOL;
    if ($arr[$startIndex] === $v) {
        return $startIndex;
    }
    return null;
}

$arr = [1, 4, 5, 7, 9, 10, 12, 15, 18, 19, 20, 23, 25]; //should not go more than 4 steps

if (getIndex($arr, 10) !== null) {
    echo '10 exist' . PHP_EOL;
} else {
    echo '10 does not exist' . PHP_EOL;
}

if (getIndex($arr, 24) !== null) {
    echo '24 exist' . PHP_EOL;
} else {
    echo '24 does not exist' . PHP_EOL;
}

if (getIndex($arr, 25) !== null) {
    echo '25 exist' . PHP_EOL;
} else {
    echo '25 does not exist' . PHP_EOL;
}

