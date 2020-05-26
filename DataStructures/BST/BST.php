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
     * @param array $output
     */
    public function inOrderTraverse(Node $node = null, &$output)
    {
        if ($node) {
            $this->inOrderTraverse($node->left, $output);
            $output[] = $node->value;
            $this->inOrderTraverse($node->right, $output);
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
        $this->inOrderTraverse($this->root, $result);
        return $result;
    }

    /**
     * Print values of tree
     */
    public function printValues()
    {
        $output = [];
        $this->inOrderTraverse($this->root, $output);
        foreach ($output as $val) {
            echo $val . ' ';
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

    /**
     * @param Node $node
     * @param $value
     * @return bool
     */
    public function printAncestry($node, $value)
    {
        if ($node) {
            if ($node->value === $value) {
                echo $value . ' ';
                return true;
            }
            if (
                $this->printAncestry($node->left, $value)
                || $this->printAncestry($node->right, $value)
            ) {
                echo $node->value . ' ';
                return true; //key point is to return true here for parent node
            }
        }
        return false;
    }

    /**
     * Returns Nodes, sum and count at each level of tree
     * @param Node $node
     * @param $levels
     * @param int $l
     */
    public function levels(Node $node, &$levels, $l = 1)
    {
        if ($node) {
            if (isset($levels[$l]) && array_key_exists('sum', $levels[$l])) {
                $levels[$l]['nodes'][] = $node->value;
                $levels[$l]['sum'] += $node->value;
                $levels[$l]['count'] += 1;
            } else {
                $levels[$l]['nodes'] = [$node->value];
                $levels[$l]['sum'] = $node->value;
                $levels[$l]['count'] = 1;
            }

            if ($node->left) {
                $this->levels($node->left, $levels, $l + 1);
            }
            if ($node->right) {
                $this->levels($node->right, $levels, $l + 1);
            }
        }
    }

    /**
     * @param Node|null $node
     * @return bool return true if tree is almost balanced
     */
    public function isBalanced(Node $node = null) //O(n**2) since we get height of whole subtree at each step
    {
        if ($node === null) {
            return true;
        }
        $lH = $this->getHeight($node->left);
        $rH = $this->getHeight($node->right);

        if (abs($lH - $rH) > 1) {
            return false;
        }

        $isLB = $this->isBalanced($node->left);
        $isRB = $this->isBalanced($node->right);

        return $isLB && $isRB;
    }

    /**
     * Returns height of any given node
     * @param Node|null $node
     * @param int $h
     * @return int|mixed
     */
    public function getHeight(Node $node = null, $h = 0) //0 since null root will height zero
    {
        if ($node === null) {
            return $h;
        }
        $lh = $this->getHeight($node->left, $h + 1);
        $rh = $this->getHeight($node->right, $h + 1);
        return max($lh, $rh);
    }

    /**
     * Shorter and simpler version
     * @param Node|null $node
     * @return int|mixed
     */
    public function getHeight2(Node $node = null)
    {
        if ($node === null) {
            return 0;
        }
        return 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
    }

    /**
     * Validates if Binary tree is BST
     * @param $root
     * @param null $leftParent
     * @param null $rightParent
     * @return bool
     */
    public function isValidBST($root, $leftParent = null, $rightParent = null) {
        if ($root === null) { return true;}

        if ($leftParent && $leftParent->value > $root->value) { return false; }
        if ($rightParent && $rightParent->value < $root->value) { return false; }

        return $this->isValidBST($root->left, $leftParent, $root) && $this->isValidBST($root->right, $root, $rightParent);
    }
}
