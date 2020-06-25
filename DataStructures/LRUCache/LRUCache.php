<?php

/**
 * Class LRUCache
 */
class LRUCache
{
    /**
     * Stores the key and values
     * @var array
     */
    private $arr;

    /**
     * Stores keys in the order or LRU
     * @var SplDoublyLinkedList
     */
    private $list;

    /**
     * Capacity of the LRUCache items
     * @var int
     */
    private $size;

    /**
     * LRUCache constructor.
     * @param int $capacity
     */
    public function __construct(int $capacity) {
        $this->size = $capacity;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param int $expiry
     */
    public function put($key, $value, $expiry) {
        $this->checkExpiry();

        $this->arr[$key] = json_encode(['val' => $value, 'exp' => time() + $expiry]);
        $this->list->add(0, $key); // put the key on the head of the list

        if (count($this->arr) > $this->size) {
            $keyToBeRemoved = $this->list->pop(); //remove last key
            unset($this->arr[$keyToBeRemoved]); //remove the key/val from arr as well
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        $this->checkExpiry();

        if (array_key_exists($key, $this->arr)) {
            //put the accessed key on the head
            $this->removeFromList($key);
            $this->list->add(0, $key);

            $data = json_decode($this->arr[$key]);
            return $data['val'];
        }

        throw new \http\Exception\RuntimeException('Key does not exist');
    }

    /**
     * @param string $key
     * @return bool
     */
    public function remove($key) {
        if (array_key_exists($key, $this->arr)) {
            unset($this->arr[$key]);
        }
        //also remove key from list
        $this->removeFromList($key);

        $this->checkExpiry();

        return true;
    }

    /**
     * Returns current number of elements stored
     * @return int
     */
    public function size() {
        $this->checkExpiry();

        return count($this->arr);
    }

    /**
     * Returns true if key exists
     * @param string $key
     * @return bool
     */
    public function has($key) {
        $this->checkExpiry();

        return array_key_exists($key, $this->arr);
    }

    /**
     * Removes the expired items
     */
    private function checkExpiry() {
        $now = time();

        foreach ($this->arr as $key => $value) {
            $data = json_decode($value);
            if ($data['exp'] >= $now) {
                unset($this->arr[$key]);

                $this->removeFromList($key);
            }
        }
    }

    /**
     * Removes key from the list
     * @param string $key
     */
    private function removeFromList($key) { //maybe not the most optimized method
        for ($i = 0; $i < $this->list->count(); $i++) {
            if ($this->list->offsetGet($i) === $key) {
                $this->list->offsetUnset($i);
                return;
            }
        }
    }
}
