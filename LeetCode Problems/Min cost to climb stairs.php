<?php
//https://leetcode.com/problems/min-cost-climbing-stairs/
//https://leetcode.com/submissions/detail/345431330/

function minCostClimbingStairs($cost) {
    $s = count($cost);
    for ($i = 2; $i < $s; $i++) {
        $cost[$i] += min($cost[$i-1], $cost[$i-2]);
    }
    return min($cost[$s-1], $cost[$s-2]);
}
