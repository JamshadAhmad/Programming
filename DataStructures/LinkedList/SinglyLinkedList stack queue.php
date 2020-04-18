<?php

class Node
{
    public $val;
    /** @var Node */
    public $next;

    public function __construct($val)
    {
        $this->val = $val;
    }
}

class LinkedList
{
    /** @var Node */
    private $head;

    public function getHead()
    {
        return $this->head;
    }

    private function getLastNode()
    {
        if ($this->head === null || $this->head->next === null) {
            return $this->head;
        }

        $node = $this->head;
        while ($node->next !== null) {
            $node = $node->next;
        }
        return $node;
    }

    public function addOnStart($val)
    {
        if ($this->head === null) {
            $this->head = new Node($val);
        } else {
            $newNode = new Node($val);
            $newNode->next = $this->head;
            $this->head = $newNode;
        }
        return $this;
    }

    public function addOnEnd($val)
    {
        if ($this->head === null) {
            $this->head = new Node($val);
        } else {
            $node = $this->getLastNode();
            $newNode = new Node($val);
            $node->next = $newNode;
        }
        return $this;
    }

    public function reverseEasy()
    {
        //Put all elements into stack and build a new one
        $stack = new LinkedList();

        $node = $this->head;
        while ($node !== null) {
            $stack->addOnStart($node->val);
            $node = $node->next;
        }
        $this->head = $stack->getHead();
        return $this;
    }

    public function reverse()
    {
        $this->reverseIterative($this->head);
    }

    /**
     * Time O(n)
     * Space O(1)
     * @return $this|Node|null
     */
    public function reverseIterative()
    {
        if ($this->head === null || $this->head->next === null) {
            return $this->head;
        }

        //key is to always 3 three pointers for iterative solution
        $previous = null;
        $current = $this->head;
        while ($current !== null) {
            $next = $current->next; //Node this should be first statement
            $current->next = $previous;
            $previous = $current;
            $current = $next;
        }
        $this->head = $previous;

        return $this;
    }

    /**
     * Time O(n)
     * Space O(n) due to call stack
     * @param Node|null $head
     */
    public function reverseRecursive(Node $head = null)
    {
        //TODO implement later
    }

    public function remove($val)
    {
        if ($this->head === null) {
            return $this;
        }

        if ($this->head->val === $val) { //remove first element if there
            $this->head = $this->head->next;
            return $this;
        }

        $node = $this->head;
        while ($node->next !== null) {
            if ($node->next->val === $val) {
                $node->next = $node->next->next;
                return $this;
            }
            $node = $node->next;
        }
        return $this;
    }

    public function popFromStart()
    {
        if ($this->head === null) {
            return null;
        }
        $val = $this->head->val;
        $this->head = $this->head->next;
        return $val;
    }

    public function popFromEnd()
    {
        if ($this->head === null) {
            return null;
        }
        if ($this->head->next === null) { //means only 1 element in list
            $val = $this->head->val;
            $this->head = null;
            return $val;
        }
        $node = $this->head;
        while ($node->next->next !== null) {
            $node = $node->next;
        }
        $val = $node->next->val;
        $node->next = null;
        return $val;
    }

    public function printList()
    {
        $node = $this->head;
        while ($node !== null) {
            echo $node->val . ' ';
            $node = $node->next;
        }
        echo PHP_EOL;
    }

    public function getArray()
    {
        $output = [];
        $node = $this->head;
        while ($node !== null) {
            $output[] = $node->val;
        }
        return $output;
    }
}

$list = new LinkedList();

$list->addOnStart(6)
    ->addOnStart(8)
    ->addOnStart(10)
    ->addOnEnd(4)
    ->addOnEnd(2);

$list->printList();

$list->reverse();

$list->printList();
