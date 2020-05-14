<?php
//https://leetcode.com/problems/minimum-remove-to-make-valid-parentheses/

function minRemoveToMakeValid($s) { //O(n) two pass, Faster than 100% solution

    $l = strlen($s);

    $ob = $cb = 0; //ob = opening bracket count and cb = closing bracked count
    for ($i = 0; $i < $l; $i++) { //Going from start to end to see/replace CLOSING voilations
        if ($s[$i] === '(') {
            $ob++;
            continue;
        }
        if ($s[$i] === ')') {
            $cb++;
            if ($cb > $ob) {
                $s[$i] = '#';
                $cb--; //key point. Since we have removed bracket
            }
        }
    }

    $ob = $cb = 0;
    for ($i = $l - 1; $i >= 0; $i--) { //Going from End to Start to see/replace OPENING voilations
        if ($s[$i] === ')') {
            $cb++;
            continue;
        }
        if ($s[$i] === '(') {
            $ob++;
            if ($ob > $cb) {
                $s[$i] = '#';
                $ob--;
            }
        }
    }
    return str_replace('#', '', $s); //removed all marked characters
}