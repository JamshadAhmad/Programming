<?php

//https://leetcode.com/problems/longest-common-subsequence/

function lcsR($s1, $s2) { //Time 2 ** length of smallest string
    return lcsh($s1, $s2, 0, 0, strlen($s1) - 1, strlen($s2) - 1);
}

function lcsh(&$str1, &$str2, $s1 = 0, $s2 = 0, $e1 = 0, $e2 = 0) {
    if ($s1 > $e1 || $s2 > $e2) {
        return 0;
    }
    if ($str1[$s1] === $str2[$s2]) {
        return 1 + lcsh($str1, $str2, $s1 + 1, $s2 + 1, $e1, $e2);
    }
    return max(lcsh($str1, $str2, $s1 + 1, $s2, $e1, $e2), lcsh($str1, $str2, $s1, $s2 + 1, $e1, $e2));
}

/**
 * Returns length of longest common subsequence
 * @param String $text1
 * @param String $text2
 * @return Integer
 */
function longestCommonSubsequence($text1, $text2) { //Time and Space O(l1xl2)
    $l1 = strlen($text1);
    $l2 = strlen($text2);

    $dp = [];

    for ($i = 0; $i <= $l1; $i++) {
        $dp[$i][0] = 0;
    }
    for ($i = 0; $i <= $l2; $i++) {
        $dp[0][$i] = 0;
    }
    for ($i = 1; $i <= $l1; ++$i) {
        for ($j = 1; $j <= $l2; ++$j) {
            if ($text1[$i-1] === $text2[$j-1]) {
                $dp[$i][$j] = $dp[$i-1][$j-1] + 1; //1 + answer of smaller string by cutting that character
            } else {
                $dp[$i][$j] = max($dp[$i-1][$j], $dp[$i][$j-1]); //max of cutting character from either string
            }
        }
    }
    return $dp[$l1][$l2];
}

$s1 = "abcde";
$s2 = "bacd";
echo longestCommonSubsequence($s1, $s2) . PHP_EOL;
echo lcsR($s1, $s2) . PHP_EOL;
