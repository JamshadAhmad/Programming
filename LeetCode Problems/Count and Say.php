<?php

//https://leetcode.com/problems/count-and-say/

function countAndSay($n) {
    $ans = '1';
    $i = 1;
    while ($i < $n) {
        $ans = say($ans);
        $i++;
    }
    return $ans;
}

function say($ans) {
    $len = strlen($ans);
    $char = $ans[0];
    $count = 1;
    $i = 1;
    $newResult = '';
    while ($i < $len) {
        if ($ans[$i] !== $char) {
            $newResult .= $count . $char;
            $char = $ans[$i];
            $count = 1;
        } else {
            $count++;
        }
        $i++;
    }
    return $newResult . $count . $char;
}

echo countAndSay(6) . PHP_EOL;
