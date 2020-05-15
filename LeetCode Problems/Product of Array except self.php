<?php
//https://leetcode.com/problems/product-of-array-except-self/

function productExceptSelf($nums) { //Time O(n) 3 pass, Space O(n) if output array doesn't count
    $s = count($nums);
    $out = [];
    $m = 1;
    for ($i = 0; $i < $s; $i++) { //have multipliers from left side
        $out[] = $m; //most right number is already set after loop
        $m = $m * $nums[$i];
    }
    $out2 = [];
    $m = 1;
    for ($i = $s - 1; $i >= 0; $i--) {//have multipliers from right side.
        $out2[$i] = $m; //most left number is already set after loop
        $m = $m * $nums[$i];
    }
    //now combine both products
    for ($i = 0; $i < $s; $i++) {
        $out[$i] = $out[$i] * $out2[$i];
    }
    return $out;
}

function productExceptSelf2($nums) { //Time O(n) 2 pass, Space O(1) if output array doesn't count
    $s = count($nums);
    $out = [];
    $m = 1;
    for ($i = 0; $i < $s; $i++) { //have multipliers from left side
        $out[] = $m;
        $m = $m * $nums[$i];
    }
    $m = 1;
    for ($i = $s - 1; $i >= 0; $i--) {//multiply from right and combine result
        $out[$i] = $m * $out[$i]; //Key point to use Output here
        $m = $m * $nums[$i];      //but keep updating multiplier using original array
    }
    return $out;
}

$arr = [1, 2, 3, 4];

echo json_encode(productExceptSelf($arr)) . PHP_EOL;
echo json_encode(productExceptSelf2($arr)) . PHP_EOL;