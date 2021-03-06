<?php
//https://leetcode.com/problems/range-sum-of-bst/

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

class Solution {
    /**
     * @param TreeNode $root
     * @param Integer $L
     * @param Integer $R
     * @return Integer
     */
    function rangeSumBST($root, $L, $R) { //Worst runtime is still O(n)
        if ($root === null) {
            return 0;
        }
        if ($root->val >= $L && $root->val <= $R) {
            return $root->val + $this->rangeSumBST($root->left, $L, $R) + $this->rangeSumBST($root->right, $L, $R);
        }
        if ($root->right !== null && $root->val < $L) {
            return $this->rangeSumBST($root->right, $L, $R);
        }
        if ($root->left !== null && $root->val > $R) {
            return $this->rangeSumBST($root->left, $L, $R);
        }
        return 0;
    }
}
