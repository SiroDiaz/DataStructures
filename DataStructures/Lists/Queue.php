<?php

namespace DataStructures\Lists;

/**
 * Queue is a circular linked list that inserts at the end
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
     *
     */
    public function size() : int {
        return 0;
    }

    /**
     *
     */
    public function empty() : boolean {
        return false;
    }

    /**
     *
     */
    public function enqueue($data) {

    }
    
    /**
     *
     */
    public function dequeue() {

    }
}