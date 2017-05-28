<?php

namespace DataStructures\Lists;

use DataStructures\Nodes\SimpleLinkedListNode as Node;
use DataStructures\Lists\Interfaces\ListInterface;
use OutOfBoundsException;
use Iterator;

/**
 * CircularLinkedList is a single and circular linked list that has
 * a pointer to the next node and also and last node points to head.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class CircularLinkedList implements ListInterface {
    private $head;
    private $size;
    private $current;
    private $position;

    public function __construct() {
        $this->head = null;
        $this->size = 0;
        $this->position = 0;
        $this->current = &$this->head;
    }

    public function insert($index, $data) {

    }
    
    public function get($index) {
        return null;
    }
    
    public function delete($index) {
        return null;
    }
    /**
     * Returns the list size.
     *
     * @return int the length
     */
    public function size() : int {
        return $this->size;
    }

    public function toArray() : array {
        return [];
    }

    /**
     * Reset the cursor position.
     */
    public function rewind() {
        $this->position = 0;
        $this->current = $this->head;
    }

    /**
     * Returns the current node data.
     *
     * @return mixed
     */
    public function current() {
        return $this->current->data;
    }

    /**
     * Key or index that indicates the cursor position.
     *
     * @return integer The current position.
     */
    public function key() {
        return $this->position;
    }

    /**
     * Move the cursor to the next node and increments the
     * position counter.
     */
    public function next() {
        ++$this->position;
        $this->current = $this->current->next;
    }

    /**
     * Returns if the current pointer position is valid.
     *
     * @return boolean true if pointer is not last, else false.
     */
    public function valid() {
        return $this->current !== $this->head;
    }
}