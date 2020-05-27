<?php

//https://leetcode.com/problems/unique-paths
//https://leetcode.com/submissions/detail/345436651/

function uniquePaths($m, $n) {
    $dp = [];
    for ($i = 0; $i < $m ; ++$i) {
        $dp[$i] = array_fill(0, $n, 1); //fill whole grid with 1s, infact other than 1st row and column, 1 wasn't necessary
    }

    for ($i = 1; $i < $m ; ++$i) {
        for ($j = 1 ; $j < $n ;  ++$j) {
            $dp[$i][$j] = $dp[$i-1][$j] + $dp[$i][$j-1]; //every grid has number of ways to reach there
        }
    }
    return $dp[$m-1][$n-1]; //pick the last value
}

