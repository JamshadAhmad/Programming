<?php

//https://leetcode.com/problems/verifying-an-alien-dictionary/

function isAlienSorted($words, $order) {
    $ordArr = [];

    for ($i = 0; $i < 26; $i++) {//build a hashmap to lookup order of character
        $ordArr[$order[$i]] = $i;
    }

    $s = count($words);
    for ($i = 1; $i < $s; ++$i) {
        if (!compare($words[$i-1], $words[$i], $ordArr)) {
            return false;
        }
    }
    return true;
}

function compare($str1, $str2, &$ordArr) { //returns true for 'abc' and 'abcd' | 'abc' and 'x'
    $l1 = strlen($str1);
    $l2 = strlen($str2);

    for ($i = 0; $i < min($l1, $l2); ++$i) {
        if ($ordArr[$str1[$i]] < $ordArr[$str2[$i]]) {
            return true;
        } elseif ($ordArr[$str1[$i]] > $ordArr[$str2[$i]]) {
            return false;
        }
    }
    return $l2 > $l1;
}