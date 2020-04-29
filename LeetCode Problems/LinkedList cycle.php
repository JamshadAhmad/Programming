<?php

//https://leetcode.com/problems/linked-list-cycle-ii/

/**
 * Floyd's Tortoise and Hare method
 *
 * @param $head
 * @return null
 */
function detectCycle($head) {
    if ($head == null || $head->next == null) {
        return null;
    }

    $slow = $head->next;  //can't start from $slow = $fast = $head because while will always fail
    $fast = $head->next->next;

    while ($slow!==$fast) {
        if ($fast == null || $fast->next ==null) {
            return null;
        }
        $slow = $slow->next;
        $fast = $fast->next->next;
    }

    $slow = $head;
    while ($slow !== $fast) {
        $slow = $slow->next;
        $fast = $fast->next;
    }
    return $slow;
}
