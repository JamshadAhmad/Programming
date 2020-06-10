<?php

//https://leetcode.com/problems/longest-substring-without-repeating-characters

function lengthOfLongestSubstring($s) { //O(n) time and space O(26). The inchworm method
    $l = strlen($s);
    if ($l < 2) {return $l;}
    $maxLength = 1;
    $Indexes = [];
    $start = 0;

    for ($i = 0; $i < $l; ++$i) {
        if (array_key_exists($s[$i], $Indexes)) {
            $start = max($start, $Indexes[$s[$i]] + 1); //move string start to next character of last occurrence
        }
        $Indexes[$s[$i]] = $i; //store/override last index of each char
        $maxLength = max($maxLength, $i - $start + 1);
    }
    return $maxLength;
}