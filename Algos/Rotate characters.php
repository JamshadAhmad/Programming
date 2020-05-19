<?php

//https://www.hackerrank.com/challenges/caesar-cipher-1/

function caesarCipher($s, $k) {
    $l = strlen($s);

    for ($i = 0; $i < $l; $i++) {
        if (($s[$i] >= 'a' && $s[$i] <= 'z') || ($s[$i] >= 'A' && $s[$i] <= 'Z')) { //only pick the eng alphabets
            $s[$i] = getCharacter($s[$i], $k);
        }
    }
    return $s;
}

/**
 * Returns one shifted character
 * @param $c
 * @param $n
 * @return string
 */
function getCharacter($c, $n) {
    $n = $n % 26; // since every 26 shift, we'll be at same place
    $currentPos = ord($c);
    if ($c >= 'a' && $c <= 'z') { //if small character
        $currentPos -= ord('a');
        $currentPos += $n;
        return chr(($currentPos % 26) + ord('a'));
    }
    $currentPos -= ord('A');
    $currentPos += $n;
    return chr(($currentPos % 26) + ord('A'));
}

echo caesarCipher("middle-Outz", 2) . PHP_EOL; //should be "okffng-Qwvb"
