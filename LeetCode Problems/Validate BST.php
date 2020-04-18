<?php

// https://leetcode.com/problems/validate-binary-search-tree

class TreeNode {
    public $val = null;
    public $left = null;
    public $right = null;
    function __construct($value) { $this->val = $value; }
}

/**
 * @param TreeNode $root
 * @return Boolean
 */
function isValidBstRecurse($root) {
    if ($root === null) { return true;}
    if ($root->left === null && $root->right === null) {return true;}

    if ($root->left) {
        if ($root->left->val >= $root->val) { return false;}
        $current = $root->left;
        //Biggest value on left side should still be smaller that root <--- Key points
        while ($current->right !== null) {$current = $current->right;}

        if ($root->val <= $current->val) {return false;}
    }
    if ($root->right) {
        if ($root->right->val <= $root->val) {return false;}
        $current = $root->right;
        //smallest value on right side should still be greater than root
        while ($current->left !== null) {$current = $current->left;}

        if ($root->val >= $current->val) {return false;}
    }

    return $this->isValidBstRecurse($root->left) && $this->isValidBstRecurse($root->right);
}


//Much more efficient and concise but difficult to understand

function isValidBST($root, $leftParent = null, $rightParent = null) {
    if ($root === null) return true;

    if ($leftParent !== null && $root->val <= $leftParent->val) return false;
    if ($rightParent !== null && $root->val >= $rightParent->val) return false;

    return $this->isValidBST($root->left, $leftParent, $root) && $this->isValidBST($root->right, $root, $rightParent);
}
