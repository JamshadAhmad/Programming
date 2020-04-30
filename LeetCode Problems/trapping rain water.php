<?php

//https://leetcode.com/problems/trapping-rain-water/
//Solution beats 100% php solutions in both time and space, with 8ms total runtime and 15.4 MB

class Solution {

    /**
     * @param Integer[] $height
     * @return Integer
     */
    function trap($height) { //Time Best O(n), Average O(n log n), Worst O(n * n), Space O(1)
        $s  = count($height);

        $water = 0;
        $lMax = $height[0];
        $rMax = $this->maxInRange($height, $s, 2);

        for ($i = 1 ; $i < $s - 1; $i++) {
            if ($height[$i] < $lMax && $height[$i] < $rMax) {
                $min = min($lMax, $rMax);
                if ($min >= $height[$i]) {
                    $water += $min - $height[$i];
                }
            }
            if ($height[$i] > $lMax) {
                $lMax = $height[$i];
            }
            if ($height[$i] >= $rMax) {
                $rMax = $this->maxInRange($height, $s, $i + 2);
            }
        }
        return $water;
    }

    function maxInRange($height, $s, $i) {
        if ($i >= $s) {
            return -1;
        }
        $max = $height[$i];
        for ($x = $i + 1; $x < $s; $x++) {
            if ($height[$x] > $max) {
                $max = $height[$x];
            }
        }
        return $max;
    }
}