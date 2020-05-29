<?php

//https://leetcode.com/problems/intersection-of-two-arrays-ii/
//Probably the most optimal solution

/**
Size of array1 = n
Size of array2 = m
Runtime: O(n+m) // single loop through both arrays
Space: O(min(n,m)) // We only store small array as hash
 *
 * Doesn't matter if array is sorted or not. This algo also handles repeating elements of any type
 *
 * @param array $nums1
 * @param array $nums2
 * @return array
 */
function intersect($nums1, $nums2) {
    $s1 = count($nums1);
    $s2 = count($nums2);

    $big = &$nums1; //make alias for big and small arrays
    $small = &$nums2;
    if ($s1 < $s2) {
        $big = &$nums2;
        $small = &$nums1;
    }

    $hash = [];
    for ($i = 0; $i < min($s1, $s2); ++$i) { //store small elements as hash
        if (array_key_exists($small[$i], $hash)) {
            ++$hash[$small[$i]];
        } else {
            $hash[$small[$i]] = 1;
        }
    }

    $result = [];
    for ($i = 0; $i < max($s1, $s2); ++$i) { //loop through big array
        if (array_key_exists($big[$i], $hash) && $hash[$big[$i]] > 0) {
            $result[] = $big[$i];
            --$hash[$big[$i]];
        }
    }
    return $result;
}


$arr1 = [1, 5, 7, 2, 3, 3, 6, 8, 8, 8];
$arr2 = [3, 1, 8, 8, 4, 9, 11, 12, 13, 14, 16];

echo json_encode(intersect($arr1, $arr2)) . PHP_EOL; //should be [3, 1, 8, 8]