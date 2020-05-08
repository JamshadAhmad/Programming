<?php

//https://leetcode.com/problems/longest-palindromic-substring/

//sliding window effect starting from longest length. Return as soon we find one
function longestPalindrome($s) { //Easy to understand, O(n * (n**2 - n)/2)
    $originalL = strlen($s);
    $length = $originalL - 1; //current diff of start and end indexes. $length is alias of $diff

    while ($length >= 1) {
        for ($i = 0; $i < $originalL - $length; $i++) {
            if (isPalindrome($s, $i, $i + $length)) {
                //echo "i: $i, j: " . ($i + $length) . ", l: " . $length . PHP_EOL;
                return substr($s, $i, $length + 1);
            }
        }
        $length--;
    }
    return $s[0];
}

function isPalindrome($s, $i, $j) {
    while ($i < $j) {
        if ($s[$i] !== $s[$j]) {
            return false;
        }
        $i++;
        $j--;
    }
    return true;
}


function longestPalindrome2($str) { //O (n**2)
    $l = strlen($str);
    if ($l < 1) {
        return '';
    }
    $startI = $endI = 0;

    for ($i = 0 ; $i < $l; $i++) {
        $len1 = expandAroundCentre($str, $l, $i, $i);
        $len2 = expandAroundCentre($str, $l, $i, $i+1);

        $len = max($len1, $len2); //local max

        if ($len > $endI - $startI + 1) { // key point: $endI - $startI + 1 is global max
            $startI = $i - floor(($len - 1) / 2);
            $endI = $i + floor($len / 2);
        }
    }
    echo "start: $startI, end: $endI" . PHP_EOL;
    return substr($str, $startI, $endI - $startI + 1);
}

//expands around given indices and return length
function expandAroundCentre($str, $l, $i, $j) {
    if ($i > $j) {
        return 0;
    }
    while ($i >= 0 && $j < $l && $str[$i] === $str[$j]) {
        --$i;
        ++$j;
    }
    return $j - $i - 1; //key point is -1. eg 'abbc' $i is increment in loop and already on a and $j is on c
}

//then Manacher is the most optimal like near in O(n)
//which inserts # special character around every character e.g. abc => #a#b#c#
//and then expands around centre on each character but uses clever boundaries to move forward

echo longestPalindrome('babad') . PHP_EOL;
echo longestPalindrome2('babad') . PHP_EOL;