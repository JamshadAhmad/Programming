<?php

/**
 * Problem statement, Find kth missing element in sorted array of unique integers
 *
 * eg arr = [3, 4, 7, 8, 19, 25]
 * k = 2
 *
 * Result = 6
 */
//https://www.geeksforgeeks.org/k-th-missing-element-in-sorted-array/
//https://strstr.io/Leetcode1060-Missing-Element-in-Sorted-Array/

/**
 * @param $a
 * @param $k
 * @return int|mixed
 */
function kthMissingElement(&$a, $k) { //Time O(k), Space O(1)
    $n = count($a);

    $kCounter = 0;
    $arrI = 1;
    $num = $a[0];

    while ($arrI < $n) {
        $num++;
        if ($a[$arrI] === $num) { //if number is found increase Index
            $arrI++;
        } else {
            $kCounter++; //number is missing, increase kCounter
            if ($kCounter === $k) {
                return $num;
            }
        }
    }
    return -1;
}

/**
 * Copied from GeeksForGeeks link
 * @param $a
 * @param $k
 * @return int|mixed
 */
function missingK(&$a, $k) //Time O(n) where n is number of elements, Space O(1)
{
    $n = count($a);
    $difference = 0;
    $ans = 0;
    $count = $k;
    $flag = 0;

    // iterating over the array
    for($i = 0 ; $i < $n - 1; $i++)
    {
        $difference = 0;

        // check if i-th and (i + 1)-th element are not consecutive
        if (($a[$i] + 1) !== $a[$i + 1]) {
            // save their difference
            $difference += ($a[$i + 1] - $a[$i]) - 1;

            // check for difference and given k
            if ($difference >= $count) {
                $ans = $a[$i] + $count;
                $flag = 1;
                break;
            }
            $count -= $difference;
        }
    }

    return ($flag) ? $ans : -1; // if found
}

function kthMissingOptimized(&$a, $k) { //Log (n) can be done using jumps like binary search
    $n = count($a);

    //TODO implement
}

$arr = [3, 4, 7, 8, 19, 25];

echo kthMissingElement($arr, 2) . PHP_EOL; //should be 6
echo missingK($arr, 2) . PHP_EOL;