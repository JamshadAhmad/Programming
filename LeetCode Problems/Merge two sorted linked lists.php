<?php

//https://leetcode.com/problems/merge-two-sorted-lists/

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists($l1, $l2) {
        //validating the input
        if ($l1 === null && $l2 !== null) {
            return $l2;
        }
        if ($l2 === null && $l1 !== null) {
            return $l1;
        }
        if ($l1 === null && $l2 === null) {
            return null;
        }

        $node1 = $l1;
        $node2 = $l2;
        $head = $l1;
        if ($l2->val < $l1->val) {
            $head = $l2;
            $node2 = $node2->next; //key point to increment node pointer after selection
        } else {
            $node1 = $node1->next;
        }
        $currentNode = $head;

        while ($node1 !== null && $node2 !== null) {
            if ($node1->val <= $node2->val) {
                $currentNode->next = $node1;
                $currentNode = $node1;
                $node1 = $node1->next;
            } else {
                $currentNode->next = $node2;
                $currentNode = $node2;
                $node2 = $node2->next;
            }
        }

        if ($node1 !== null) {
            $currentNode->next = $node1;
        }

        if ($node2 !== null) {
            $currentNode->next = $node2;
        }
        return $head;
    }
}