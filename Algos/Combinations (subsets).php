<?php

// Returns subsets as array
function combinations($arr) {
    $s = count($arr);
    $numOfComb = 2 ** $s; //pow(2, $s)

    $result = [];
    $watch = 0;

    while ($watch < $numOfComb) {
        $result[] = getCombination($arr, $s, $watch);
        $watch++;
    }
    return $result;
}

function getCombination($arr, $s, $watch) {
    $output = [];
    $index = 0;

    while ($watch && $index < $s) {
        if ($watch & 1) { //to see if least bit is on
            $output[] = $arr[$index];
        }
        $watch = $watch >> 1; //do one right shift
        $index++;
    }
    return $output;
}

$input = [1,2, 3, 4];

$result = combinations($input);
sort($result); //This is just to sort output

foreach ($result as $r) {
    echo json_encode($r) . ' ';
}
echo PHP_EOL;