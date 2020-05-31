<?php

//https://leetcode.com/problems/longest-palindrome/

/**
 *
 * We can't just sum all even numbers and biggest odd number because that will fail on "aaabbb" as result can be "baaab"
 *
 *
 * @param String $s
 * @return Integer
 */
function longestPalindrome($s) { //O(n) time and O(26+26) space
    $l = strlen($s);
    if ($l < 2) {
        return $l;
    }

    $hash = [];

    for ($i = 0; $i < $l; ++$i) {
        if (array_key_exists($s[$i], $hash)) {
            ++$hash[$s[$i]];
        } else {
            $hash[$s[$i]] = 1;
        }
    }

    $sum = $hasOld = 0;
    foreach ($hash as $k => $v) {
        if (($v % 2) === 0) {
            $sum += $v;
        } else {
            $sum += $v-1; //key point
            $hasOld = 1;
        }
    }
    return $sum + $hasOld;
}

echo longestPalindrome('abccccdd') . PHP_EOL; //should be 7
echo longestPalindrome('aaabbb') . PHP_EOL; //should be 5