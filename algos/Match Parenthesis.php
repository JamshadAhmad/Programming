<?php

function isValid($s) {
    $l = strlen($s);

    $stack = new SplStack();
    for ($i = 0; $i < $l ; $i++) {
        if ($s[$i] === '(' || $s[$i] === '{' || $s[$i] === '[') //put it into stack
        {
            $stack->push($s[$i]);
            continue;
        }

        if ($stack->isEmpty()) { //key condition, maybe stack is empty already
            return false;
        }

        $poped = $stack->pop();
        if (($s[$i] === ')' && $poped !== '(') || ($s[$i] === '}' && $poped !== '{') || ($s[$i] === ']' && $poped !== '[')) {
            return false;
        }
    }
    return $stack->isEmpty();
}

echo isValid('(]') . PHP_EOL;
