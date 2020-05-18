<?php
//https://leetcode.com/problems/product-of-array-except-self/

function productExceptSelf($nums) { //Time O(n) 3 pass, Space O(n) if output array doesn't count
    $s = count($nums);

    //[a, b, c, d] first I'll make multiplier array like [1, a, ab, abc] which means with which number should it multiply with

    $multi1 = [];
    $m = 1;
    for ($i = 0; $i < $s; $i++) {
        $multi1[] = $m;
        $m = $m * $nums[$i];
    }

    $multi2 = [];
    $m = 1;
    for ($i = $s - 1; $i >= 0; $i--) {
        $multi2[$i] = $m; //using $i is the key here, because of the order maters
        $m = $m * $nums[$i];
    }
    //now we have $multi1 as [1, a, ab, abc] and $multi2 as [bcd, cd, d, 1]
    // if we combine (product) them we will have our desired result = [bcd, acd, abd, abc] what we wanted
    $out = [];
    for ($i = 0; $i < $s; $i++) {
        $out[] = $multi1[$i] * $multi2[$i];
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