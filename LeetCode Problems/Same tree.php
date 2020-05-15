<?php
//https://leetcode.com/problems/same-tree/

//Although in php, simple one liner would have worked `return $p == $q;`

/**
 * @param TreeNode $p
 * @param TreeNode $q
 * @return bool
 */
function isSameTree($p, $q) {
    if ($p === null && $q === null) {
        return true;
    }
    if (($p === null || $q === null) || ($p->val !== $q->val)) { //If either one of them is null or value not equal
        return false;
    }
    return $this->isSameTree($p->left, $q->left) && $this->isSameTree($p->right, $q->right);
}