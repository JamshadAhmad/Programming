<?php

//https://leetcode.com/problems/add-two-numbers/

class ListNode {
     public $val = 0;

    /**
     * @var ListNode|null
     */
     public $next = null;
     function __construct($val) { $this->val = $val; }
}

/**
 * @param ListNode $l1
 * @param ListNode $l2
 * @return ListNode
 */
function addTwoNumbers($l1, $l2) { //O(n+m) where n and m are lengths of linked lists

    $root = null;
    $current = null;
    $isCarrey = 0;

    do {
        $sum = $l1->val + $l2->val + $isCarrey;

        if ($current === null) {
            $root = new ListNode($sum % 10);
            $current = $root;
        } else {
            $current->next = new ListNode($sum % 10);
            $current = $current->next;
        }

        $isCarrey = (int)($sum >= 10);

        $l1 = $l1->next;
        $l2 = $l2->next;
    } while($l1 !== null && $l2 !== null);

    if ($l1) {

        do {
            $sum = $l1->val + $isCarrey;
            $current->next = new ListNode($sum % 10);
            $current = $current->next;

            $isCarrey = (int)($sum >= 10);

            $l1 = $l1->next;
        } while ($l1 !== null);

    } elseif ($l2) {
        do {
            $sum = $l2->val + $isCarrey;
            $current->next = new ListNode($sum % 10);
            $current = $current->next;

            $isCarrey = (int)($sum >= 10);

            $l2 = $l2->next;

        } while ($l2 !== null);
    }

    if ($isCarrey) {
        $current->next = new ListNode($isCarrey);
    }
    return $root;
}
