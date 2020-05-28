<?php

//Assuming fib series as 1, 1, 2, 3, 5, 8 , 13, 21, 34, 55 ...

/**
 * Non optimized recursive solution
 * @param $n
 * @return int
 */
function fibR($n) { //O(2^n), 109 function calls for n = 10 and 13529 calls for n = 20
    if ($n < 3) {
        return 1;
    }
    return fibR($n-1) + fibR($n-2);
}

/**
 * Optimized recursive solution
 * @param $n
 * @param array $dic
 * @return int
 */
function fibRO($n, &$dic = []) { //O(n) time and space, 8 function calls for n = 10 and 18 function calls for n = 20
    if ($n < 3) {
        return 1;
    }

    if (array_key_exists($n, $dic)) {
        return $dic[$n];
    }

    if (!array_key_exists($n - 1, $dic)) {
        $dic[$n-1] = fibRO($n - 1, $dic);
    }
    if (!array_key_exists($n - 2, $dic)) {
        $dic[$n-2] = fibRO($n - 2, $dic);
    }
    return $dic[$n-1] + $dic[$n-2];
}

/**
 * Optimized DP solution
 * @param $n
 * @return int
 */
function fibDP($n) { //O(n) time and space, non-recursive
    $dp = [1 => 1, 2 => 1];
    for ($i = 3 ; $i <= $n; $i++) {
        $dp[$i] = $dp[$i-1] + $dp[$i-2];
    }
    return $dp[$n];
}

/**
 * Further optimized DP solution
 * @param $n
 * @return int
 */
function fibDPO($n) { //O(n) time and O(1) space
    $a = $b = $res = 1;
    for ($i = 3 ; $i <= $n; $i++) {
        $res = $a + $b; //result is sum of previous two
        $b = $a; //make prevPrev = Prev
        $a = $res; //make Prev = current
    }
    return $res;
}

$start = microtime(true);
echo fibR(35) . ' time: ' . (int)((microtime(true) - $start)) . ' seconds' . PHP_EOL; //about 8 seconds

$start = microtime(true);
echo fibRO(35) . ' time: ' . (int)((microtime(true) - $start) * 1000000) . PHP_EOL; //about  70 microseconds

$start = microtime(true);
echo fibDP(35) . ' time: ' . (int)((microtime(true) - $start) * 1000000) . PHP_EOL; //about 12 microseconds

$start = microtime(true);
echo fibDPO(35) . ' time: ' . (int)((microtime(true) - $start) * 1000000) . PHP_EOL; //about 11 microseconds