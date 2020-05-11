<?php
//https://leetcode.com/problems/shortest-palindrome/

/**
 * @param String $s
 * @return String
 */
function shortestPalindrome($s) { //Time : O(n**2). Space : 2 * n
    $l = strlen($s);
    if ($l < 2) {
        return $s;
    }
    if ($this->isPalindrome($s, 0, $l - 1 )) {
        return $s;
    }

    $rev = strrev($s);

    for ($i = 0; $i < $l; $i++) {
        if (isPalindrome(substr($rev, 0, $i + 1) . $s, 0, $l + $i)) { //start attaching reverse string from start
            return substr($rev, 0, $i + 1) . $s;
        }
    }
    return 0; // not a chance coming here
}

/**
 * @param $s
 * @param $i
 * @param $j
 * @return bool|null
 */
function isPalindrome($s, $i, $j)
{
    if ($i > $j) {return null;}
    while ($i <= $j) {
        if ($s[$i] !== $s[$j]) {
            return false;
        }
        ++$i;
        --$j;
    }
    return true;
}