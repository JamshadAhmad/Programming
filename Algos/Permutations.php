<?php

function permute($str) {
    return permuteHelper($str, 0, strlen($str) - 1);
}

function permuteHelper($str, $start, $end) {
    if ($start === $end) {
        return [$str[$start]];
    }

    $nextStrings = permuteHelper($str, $start + 1, $end);
    $outPuts = [];
    $currentChar = $str[$start];

    foreach ($nextStrings as $oneStr) {
        $strLen = strlen($oneStr);
        for ($j = 0; $j < $strLen + 1; $j++) { //key point + 1 here
            if ($j === 0) {
                $outPuts[] = $currentChar . $oneStr;
            } elseif ($j === $strLen) {
                $outPuts[] = $oneStr . $currentChar;
            } else {
                //put in middle
                $leftPart = substr($oneStr, 0, $j);
                $rightPart = substr($oneStr, $j);
                $outPuts[] = $leftPart . $currentChar . $rightPart;
            }
        }
    }
    return $outPuts;
}

//Time to test it

$str = 'abc';

$combinations = permute($str);

foreach ($combinations as $c) {
    echo $c . ' ';
}

echo PHP_EOL;