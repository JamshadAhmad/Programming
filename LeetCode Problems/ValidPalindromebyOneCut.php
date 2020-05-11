<?php
//https://leetcode.com/problems/valid-palindrome-ii

function validPalindrome($s) {
    $l = strlen($s);
    if ($l < 2) {
        return true;
    }
    $i = 0;
    $j = $l - 1;

    while ($i <= $j) {
        if ($s[$i] !== $s[$j]) {
            //cut the left
            $isS1P = isPalindrome(substr($s, 0, $i) . substr($s, $i + 1), 0, $l - 2);
            $isS2P = isPalindrome(substr($s, 0, $j) . substr($s, $j + 1), 0, $l - 2);
            //cut the right

            return $isS1P || $isS2P;
        }
        ++$i;
        --$j;
    }
    return true;
}

function isPalindrome($s, $i, $j) {
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