<?php

namespace DataStructures\Lists;

use DataStructures\Lists\Nodes\SimpleLinkedListNode as Node;
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
    private $tail;
    private $size;
    private $current;
    private $position;

    public function __construct() {
        $this->head = null;
        $this->tail = &$this->head;
        $this->size = 0;
        $this->position = 0;
        $this->current = &$this->head;
    }

    /**
     * Returns the list size.
     *
     * @return int the length
     */
    public function size() : int {
        return $this->size;
    }

    /**
     * Checks if the list is empty.
     *
     * @return boolean true if is empty, else false.
     */
    public function empty() : bool {
        return $this->size == 0;
    }

    public function insert($index, $data) {
        if($index < 0) {
            throw new OutOfBoundsException();
        }

        if($index === 0) {
            $this->insertBegining($data);
        } else if($index >= $this->size) {
            $this->insertEnd($data);
        } else if($index > 0 && $index < $this->size) {
            $this->insertAt($index, $data);
        }
        
        $this->size++;
    }

    private function insertBegining($data) {
        $newNode = new Node($data);
        if($this->head === null) {
            $newNode->next = &$this->head;
            $this->head = &$newNode;
            $this->tail = &$newNode;
        } else {
            $this->tail->next = &$newNode;
            $newNode->next = &$this->head;
            $this->head = &$newNode;
        }
    }

    private function insertEnd($data) {
        $newNode = new Node($data);
        $this->tail->next = &$newNode;
        $newNode->next = &$this->head;
        $this->tail = &$newNode;
    }

    private function insertAt($index, $data) {
        $newNode = new Node($data);
        $current = $this->head;
        $prev = null;
        $i = 0;
        while($i < $index) {
            $prev = $current;
            $current = $current->next;
            $i++;
        }
        
        $prev->next = &$newNode;
        $newNode->next = &$current;
    }

    public function push($data) {
        $this->insert($this->size, $data);
    }

    public function unshift($data) {
        $this->insert(0, $data);
    }

    /**
     *
     */
    public function getLast() {
        return $this->tail->data;
    }
    
    public function get($index) {
        if($index < 0 || $index > $this->size - 1) {
            throw new OutOfBoundsException();
        }

        if($index === 0) {
            return $this->head->data;
        }

        $i = 0;
        $current = $this->head;
        while($i < $index) {
            $current = $current->next;
            $i++;
        }

        return $current->data;
    }
    
    public function delete($index) {
        return null;
    }

    public function toArray() : array {
        return [];
    }

    /**
     * Reset the cursor position.
     */
    public function rewind() {
        $this->position = 0;
        $this->current = &$this->head;
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
        return $this->current !== $this->tail;
    }
}