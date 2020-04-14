<?php
//https://leetcode.com/problems/insert-delete-getrandom-o1/
//https://leetcode.com/submissions/detail/324820882/

class RandomizedSet {

    private $arr;

    /**
     * Initialize your data structure here.
     */
    function __construct() {
        $this->arr = [];
    }

    /**
     * Inserts a value to the set. Returns true if the set did not already contain the specified element.
     * @param Integer $val
     * @return Boolean
     */
    function insert($val) {
        if (array_key_exists($val, $this->arr)) {
            return false;
        }
        $this->arr[$val] = $val;
        return true;
    }

    /**
     * Removes a value from the set. Returns true if the set contained the specified element.
     * @param Integer $val
     * @return Boolean
     */
    function remove($val) {
        if (!array_key_exists($val, $this->arr)) {
            return false;
        }
        unset($this->arr[$val]);
        return true;
    }

    /**
     * Get a random element from the set.
     * @return Integer
     */
    function getRandom() {
        return $this->arr[array_rand($this->arr)];
    }
}

/**
 * Your RandomizedSet object will be instantiated and called as such:
 * $obj = RandomizedSet();
 * $ret_1 = $obj->insert($val);
 * $ret_2 = $obj->remove($val);
 * $ret_3 = $obj->getRandom();
 */
