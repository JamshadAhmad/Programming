<?php

require_once './Node.php';

/**
 * Class BST
 */
class BST
{
    /**
     * @var Node|null
     */
    public $root;

    /**
     * BST constructor.
     * @param null|mixed $value
     */
    public function __construct($value = null)
    {
        if ($value !== null) {
            $this->root = new Node($value);
        }
    }

    /**
     * @param mixed $value
     * @return Node
     */
    public function insert($value)
    {
        if ($this->root === null) {
            return $this->root = new Node($value);
        }
        $node = $this->root;
        while($node) {
            if ($value < $node->value) {
                if ($node->left === null) {
                    $node = $node->left = new Node($value, $node);
                    break;
                }
                $node = $node->left;
            } elseif ($value > $node->value) {
                if ($node->right === null) {
                    $node = $node->right = new Node($value, $node);
                    break;
                }
                $node = $node->right;
            } else {
                break;
            }
        }
        return $node;
    }

    /**
     * @param mixed $value
     * @return Node|null
     */
    public function search($value)
    {
        $node = $this->root;

        while ($node) {
            if ($node->value === $value) {
                break;
            }
            if ($value < $node->value) {
                $node = $node->left;
            } else {
                $node = $node->right;
            }
        }
        return $node;
    }

    /**
     * Removes a node by value
     * @param mixed $value
     */
    public function delete($value)
    {
        $node = $this->search($value);
        if ($node) {
            $this->deleteByReference($node);
        }
    }

    /**
     * @param Node $node
     */
    public function deleteByReference(Node $node)
    {
        if ($node->left && $node->right) { //case when node has both side
            //Move right's min node its place at its place
            $min = $this->min($node->right);
            $node->value = $min->value;
            //delete old min
            $this->deleteByReference($min);
        } elseif ($node->left) { //case when only left side is there
            if ($node->parent->right === $node) {
                $node->parent->right = $node->left;
                $node->left->parent = $node->parent;
            } elseif ($node->parent->left === $node) {
                $node->parent->left = $node->left;
                $node->left->parent = $node->parent;
            }
            $node->left = null;
        } elseif ($node->right) { //case when only right side is there
            if ($node->parent->right === $node) {
                $node->parent->right = $node->right;
                $node->right->parent = $node->parent;
            } elseif ($node->parent->left === $node) {
                $node->parent->left = $node->right;
                $node->right->parent = $node->parent;
            }
            $node->right = null;
        } else { //case when node is the leaf node
            if ($node->parent->right === $node) {
                $node->parent->right = null;
            } elseif ($node->parent->left === $node) {
                $node->parent->left = null;
            }
        }
        $node->parent = null;
    }

    /**
     * Returns In-Order (ascending) iterable Generator
     * @param Node|null $node
     * @return bool|Generator
     */
    public function walk(Node $node = null)
    {
        if ($node === null) {
            $node = $this->root;
        }
        if ($node === null) {
            return false;
        }
        if ($node->left) {
            yield from $this->walk($node->left);
        }
        yield $node;
        if ($node->right) {
            yield from $this->walk($node->right);
        }
    }

    /**
     * @param Node|null $node
     * @return bool|Generator
     */
    public function reverseWalk(Node $node = null)
    {
        if ($node === null) {
            $node = $this->root;
        }
        if ($node === null) {
            return false;
        }

        if ($node->right) {
            yield from $this->walk($node->right);
        }
        yield $node;
        if ($node->left) {
            yield from $this->walk($node->left);
        }
    }

    /**
     * @param Node|null $node
     * @return Node|null
     */
    public function min(Node $node = null)
    {
        if ($node === null) {
            $node = $this->root;
        }
        if ($node === null) {
            return null;
        }
        while ($node->left) {
            $node = $node->left;
        }
        return $node;
    }

    /**
     * @param Node|null $node
     * @return Node|null
     */
    public function max(Node $node = null)
    {
        if ($node === null) {
            $node = $this->root;
        }
        if ($node === null) {
            return null;
        }
        while ($node->right) {
            $node = $node->right;
        }
        return $node;
    }

    /**
     * Returns values in an array
     * @return array
     */
    public function toArrayValues()
    {
        $result = [];
        foreach ($this->walk() as $node) {
            $result[] = $node->value;
        }
        return $result;
    }

    /**
     * Print values of tree
     */
    public function printValues()
    {
        foreach ($this->walk() as $node) {
            echo $node->value . ' ';
        }
    }

    /**
     * Returns true if the value exists
     * @param $value
     * @return bool
     */
    public function exists($value)
    {
        if ($this->search($value)) {
            return true;
        }
        return false;
    }
}
