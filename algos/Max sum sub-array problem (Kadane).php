<?php

function maxSumBruteForce1($arr) { //O(n3)
    $gSum = PHP_INT_MIN; //start sum with negative infinity
    $size = count($arr);
    for ($i = 0; $i < $size; $i++) {
        for ($j = $i; $j < $size; $j++) {
            $k = $i;
            $sum = 0;
            while ($k <= $j) {
                $sum += $arr[$k];
                $k++;
            }
            $gSum = max($gSum, $sum);
        }
    }
    return $gSum;
}

function maxSumBruteForce2($arr) { //O(n2), running sum method
    $gSum = PHP_INT_MIN;
    $size = count($arr);
    for ($i = 0; $i < $size; $i++) {
        $sum = 0;
        for ($j = $i; $j < $size; $j++) {
            $sum += $arr[$j];
            $gSum = max($gSum, $sum);
        }
    }
    return $gSum;
}

function maxSumKadane($arr) { //O(n)
    $sum = $gSum = $arr[0];
    $size = count($arr);
    for ($i = 1; $i < $size; $i++) {
        $sum = max($arr[$i],  $arr[$i] + $sum); //current or sum of previous sub-array + current
        $gSum = max($gSum, $sum);
    }
    return $gSum;
}

function maxSumBruteForce2WithIndexes($arr) {
    $gSum = PHP_INT_MIN;
    $size = count($arr);
    $maxIndexes = [];
    for ($i = 0; $i < $size; $i++) {
        $sum = 0;
        for ($j = $i; $j < $size; $j++) {
            $sum += $arr[$j];
            if ($sum > $gSum) {
                $maxIndexes[0] = $i;
                $maxIndexes[1] = $j;
                $gSum = $sum;
            }
        }
    }
    $maxIndexes['sum'] = $gSum;
    return $maxIndexes;
}

function maxSumKadaneWithIndexes($arr) {
    $sum = $gSum = $arr[0];
    $size = count($arr);
    $indexes = [0];
    for ($i = 1; $i < $size; $i++) {
        if ($arr[$i] > $arr[$i] + $sum) { //i will be set whenever a new big number found
            $indexes[0] = $i;
            $sum = $arr[$i];
        } else {
            $sum += $arr[$i];
        }
        if ($sum > $gSum) { //j will be set when we find new max sum
            $indexes[1] = $i;
            $gSum = $sum;
        }
    }
    $indexes['sum'] = $gSum;
    return $indexes;
}

$arr = [-2, 1, -3, 4, -1, 2, 1, -5, 4];
echo maxSumBruteForce1($arr) . PHP_EOL;
print_r(maxSumBruteForce2WithIndexes($arr));
print_r(maxSumKadaneWithIndexes($arr));

echo PHP_EOL . PHP_EOL;

$arr1 = [-2, -3,  4, -1, -2,  1,  5, -3];
echo maxSumBruteForce1($arr1) . PHP_EOL;
print_r(maxSumBruteForce2WithIndexes($arr1));
print_r(maxSumKadaneWithIndexes($arr1));