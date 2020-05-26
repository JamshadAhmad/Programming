<?php

//https://leetcode.com/problems/find-all-anagrams-in-a-string/

function findAnagrams($s, $p) { //O(length of $s)
    $pl = strlen($p);
    $sl = strlen($s);

    $out = [];
    $pC = getCCount($p, $pl);
    $rC = getCCount(str_split(substr($s, 0, $pl)), $pl);

    for ($i = 1; $i <= $sl - $pl + 1; $i++) { //sliding window
        if ($pC === $rC) {
            $out[] = $i - 1;
        }
        $pIndex = ord($s[$i - 1]) - ord('a'); //Remove count of last character
        $rC[$pIndex] -= 1;
        $iIndex = ord($s[$i - 1 + $pl]) - ord('a'); //Add count of next character
        $rC[$iIndex] += 1;
    }
    return $out;
}

/**
 * Returns character count of whole string e.g. for "abca" it will return [2, 1, 1, 0, 0, 0 ...]
 */
function getCCount($s, $l) {
    $count = array_fill(0, 26, 0);
    for ($i = 0; $i < $l; $i++) {
        $index = ord($s[$i]) - ord('a');
        $count[$index] += 1;
    }
    return $count;
}
