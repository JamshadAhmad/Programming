<?php

//https://leetcode.com/problems/longest-increasing-subsequence/
//Explanation https://www.youtube.com/watch?v=fV-TF4OvZpk

function lengthOfLIS($nums) { //Time O(N ^ 2), Space O(N)
    $s = count($nums);

    if ($s < 2) {
        return $s;
    }

    $dp = array_fill(0, $s, 1);

    for ($i = 1; $i < $s; ++$i) {
        for ($j = 0; $j <= $i; ++$j) {
            if ($nums[$i] > $nums[$j]) {
                $dp[$i] = max($dp[$j] + 1, $dp[$i]); //max is key, as we don't want to decrease the calculated result for any number
            }
        }
    }
    return max($dp);
}