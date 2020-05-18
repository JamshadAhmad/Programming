<?php

class Node {
    /**
     * @var int|string
     */
    public $id;

    /**
     * @var Node[]
     */
    public $adjacent = [];

    /**
     * Node constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
}

class Graph {
    /**
     * @var Node[]
     */
    private $nodes;

    /**
     * Graph constructor.
     * @param int $numberOfNodes
     */
    public function __construct($numberOfNodes = 0)
    {
        for ($i = 1; $i <= $numberOfNodes; $i++) {
            $this->nodes[$i] = new Node($i);
        }
    }

    /**
     * Returns the node with given Id
     * @param $id
     * @return Node|null
     */
    public function getNode($id)
    {
        if (array_key_exists($id, $this->nodes)) {
            return $this->nodes[$id];
        }
        return null;
    }

    /**
     * Adds a new node in Graph
     * @param $id
     */
    public function addNode($id)
    {
        if (!array_key_exists($id, $this->nodes)) {
            $this->nodes[$id] = new Node($id);
        }
    }

    /**
     * This function adds one directional path
     *
     * @param $fromId
     * @param $toId
     */
    public function addPath($fromId, $toId)
    {
        $fromNode = $this->getNode($fromId);
        $toNode = $this->getNode($toId);

        if ($fromNode && $toNode) {
            $fromNode->adjacent[] = $toNode;
        }
    }

    /**
     * This function adds two way path/edge
     *
     * @param $fromId
     * @param $toId
     */
    public function addEdge($fromId, $toId)
    {
        $fromNode = $this->getNode($fromId);
        $toNode = $this->getNode($toId);

        if ($fromNode && $toNode) {
            $fromNode->adjacent[] = $toNode;
            $toNode->adjacent[] = $fromNode;
        }
    }

    /**
     * @param string|int $fromId
     * @param string|int $toId
     * @return bool
     */
    public function hasPathDFS($fromId, $toId)
    {
        $fromNode = $this->getNode($fromId);
        $toNode = $this->getNode($toId);
        if ($fromNode === null || $toNode === null) {
            return false;
        }
        $visited = [];
        return $this->hasPathDFSHelper($fromNode, $toNode, $visited);
    }

    /**
     * @param Node $fromNode
     * @param Node $toNode
     * @param array $visited
     * @return bool
     */
    private function hasPathDFSHelper(Node $fromNode, Node $toNode, array $visited)
    {
        if ($fromNode->id === $toNode->id || array_key_exists($toNode->id, $fromNode->adjacent)) {
            return true;
        }
        $visited[$fromNode->id] = true;
        foreach ($fromNode->adjacent as $node) {
            if (!array_key_exists($node->id, $visited)) {
                if ($this->hasPathDFSHelper($node, $toNode, $visited)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param string|int $fromId
     * @param string|int $toId
     * @return bool
     */
    public function hasPathBFS($fromId, $toId)
    {
        $fromNode = $this->getNode($fromId);
        $toNode = $this->getNode($toId);

        if ($fromNode === null || $toNode === null) {
            return false;
        }
        $visited = [];
        $NextToVisit = new SplQueue(); //Queue or LinkedList (stack, queue) is needed for BFS
        $NextToVisit->enqueue($fromNode);

        while (!$NextToVisit->isEmpty()) {
            /** @var Node $currentNode */
            $currentNode = $NextToVisit->dequeue();
            if (array_key_exists($currentNode->id, $visited)) { continue; }

            $visited[$currentNode->id] = true;

            if ($toId === $currentNode->id || array_key_exists($toId, $currentNode->adjacent)) {
                return true;
            }
            //push all adjacent nodes into queue
            foreach ($currentNode->adjacent as $node) {
                if (!array_key_exists($node->id, $visited)) { //Added this check as this avoids almost half cycles of loop
                    $NextToVisit->enqueue($node);
                }
            }
        }
        return false;
    }
}

//Testing
$graph = new Graph(8);

$graph->addEdge(1, 2);
$graph->addEdge(2, 3);
$graph->addEdge(1, 3);
$graph->addPath(2, 4);
$graph->addEdge(5, 6);
$graph->addEdge(6, 7);
$graph->addEdge(8, 7);
$graph->addEdge(8, 6);
$graph->addEdge(5, 1);


if ($graph->hasPathBFS(8, 4)) {
    echo 'path exists' . PHP_EOL;
} else {
    echo 'no path exists' . PHP_EOL;
}

?>
