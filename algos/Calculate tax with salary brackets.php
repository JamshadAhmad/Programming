<?php

function calculateTax($brackets, $salary) {
    //check if brackets are sorted
    $isSorted = true;
    $s = count($brackets);
    for ($i = 0; $i < $s - 2; $i++) { //avoid these lines from Line 7 to 26 if brackets are always sorted
        if ($brackets[$i+1][0] !== null) {
            if ($brackets[$i][0] > $brackets[$i+1][0]) {
                $isSorted = false;
                break;
            }
        }
    }
    if (!$isSorted) {
        //sort the brackets
        for ($i = 0; $i < $s - 2; $i++) {
            for ($j = $i+1; $j < $s - 1; $j++) {
                if ($brackets[$i][0] > $brackets[$j][0]) {
                    $temp = $brackets[$i];
                    $brackets[$i] = $brackets[$j];
                    $brackets[$j] = $temp;
                }
            }
        }
    }

    if ($salary < $brackets[0][0]) { //if salary is less than first bracked
        return $salary * $brackets[$s - 1][1];
    }

    for ($i = 0; $i < $s - 2; $i++) { //find a suitable bracket
        if ($salary >= $brackets[$i][0] && $salary < $brackets[$i+1][0]) {
            return $salary * $brackets[$i][1];
        }
    }
    return $salary * $brackets[$s - 2][1]; //if none of the brackets match
}

//testing code

$brackets = [ [10000, 0.3], [20000, 0.2], [30000, 0.1], [null, .4]]; //means 10% tax for greater than 30000
//and 40% tax on any value smaller than 10000 which does't fit any bracket except the last one

echo calculateTax($brackets, 100) . PHP_EOL;

