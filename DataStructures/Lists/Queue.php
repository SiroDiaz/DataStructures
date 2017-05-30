<?php

namespace DataStructures\Lists;

use DataStructures\Exceptions\FullException;
use OutOfBoundsException;

/**
 * Queue (FIFO) is a circular linked list that inserts at the end
 * of list and removes at the beginning. Insert and remove
 * are O(1), size and empty are also O(1).
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class Queue {
    private $head;
    private $tail;
    private $size;

    public function __construct() {
        $this->head = null;
        $this->tail = &$this->head;
        $this->size = 0;
    }

    /**
     * Returns the queue size.
     *
     * @return int the length
     */
    public function size() : int {
        return 0;
    }

    /**
     * Checks if the queue is empty.
     *
     * @return bool true if is empty, else false.
     */
    public function empty() : boolean {
        return false;
    }

    /**
     * Add a new node at the end of the queue.
     *
     * @param mixed $data the data to store.
     * @throws DataStructures\Exceptions\FullException if the queue is full.
     */
    public function enqueue($data) {

    }
    
    /**
     * Removes the first node in the queue.
     *
     * @return mixed
     */
    public function dequeue() {
        return null;
    }

    /**
     * Gets the element at the front of the queue without removing it.
     *
     * @return mixed
     */
    public function peek() {
        return null;
    }

    /**
     * Returns true if is full the queue and false if there is
     * space available.
     *
     * @return bool 
     */
    public function isFull() {
        return false;
    }
}