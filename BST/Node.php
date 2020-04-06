<?php

/**
 * Class Node
 */
class Node
{
    /**
     * @var mixed
     */
    public $value;

    /**
     * @var Node|null
     */
    public $left;

    /**
     * @var Node|null
     */
    public $right;

    /**
     * @var Node|null;
     */
    public $parent;

    /**
     * Node constructor.
     * @param mixed $value
     * @param Node|null $parent
     */
    public function __construct($value, Node $parent = null)
    {
        $this->value = $value;
        $this->parent = $parent;
    }
}
