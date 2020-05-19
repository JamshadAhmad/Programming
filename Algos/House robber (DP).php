<?php

//https://leetcode.com/problems/house-robber
//Warning, it doesn't work by summing all even and odds numbers fails at lets say [2, 1, 1, 2] answer : 4

function rob($nums) {
    $s = count($nums);
    if ($s === 0) return 0; //handing empty and smaller array cases
    if ($s < 3) return max($nums);

    $nums[2] += $nums[0]; //running sum, assume we have robbed past houses

    for ($i = 3; $i < $s; $i++) {
        $nums[$i] += max($nums[$i-2], $nums[$i-3]); //store the max here from past
    }
    return max($nums[$s-1], $nums[$s-2]); //max will always be at last two positions
}

echo rob([2,7,9,3,1]) . PHP_EOL;
