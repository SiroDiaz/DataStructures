<?php

namespace DataStructures\Lists;

use DataStructures\Lists\Nodes\SimpleLinkedListNode as Node;
use DataStructures\Exceptions\FullException;
use InvalidArgumentException;
use Countable;

/**
 * Queue (FIFO) is a circular linked list that inserts at the end
 * of list and removes at the beginning. Insert and remove
 * are O(1), size and empty are also O(1).
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class Queue implements Countable {
    private $head;
    private $tail;
    private $size;
    private $maxSize;

    public function __construct($maxSize = 0) {
        if($maxSize < 0) {
            throw new InvalidArgumentException();
        }
        $this->maxSize = $maxSize;
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
        return $this->size;
    }

    /**
     * Checks if the queue is empty.
     *
     * @return bool true if is empty, else false.
     */
    public function empty() : bool {
        return $this->size === 0;
    }

    /**
     * Add a new node at the end of the queue.
     *
     * @param mixed $data the data to store.
     * @throws DataStructures\Exceptions\FullException if the queue is full.
     */
    public function enqueue($data) {
        if($this->isFull()) {
            throw new FullException();
        }
        
        $newNode = new Node($data);
        if($this->head === null) {
            $this->head = &$newNode;
            $this->tail = &$this->head;
            $newNode->next = &$this->tail;
        } else {
            $this->tail->next = &$newNode;
            $newNode->next = &$this->head;
            $this->tail = &$newNode;
        }
        $this->size++;
    }
    
    /**
     * Removes the first node in the queue.
     *
     * @return mixed
     */
    public function dequeue() {
        if($this->head === null) {
            return null;
        }

        if($this->head === $this->tail) {
            $temp = $this->head;
            $this->head = null;
            $this->tail = &$this->head;
            $this->size--;

            return $temp->data;
        }

        $temp = $this->head;
        $this->head = &$this->head->next;
        $this->tail->next = &$this->head;
        $this->size--;
        
        return $temp->data;
    }

    /**
     * Gets the element at the front of the queue without removing it.
     *
     * @return mixed
     */
    public function peek() {
        return ($this->head === null) ? null : $this->head->data;
    }

    /**
     * Returns true if is full the queue and false if there is
     * space available.
     *
     * @return bool 
     */
    public function isFull() {
        if($this->maxSize === 0) {
            return false;
        }
        
        return $this->size > 0 && $this->size >= $this->maxSize;
    }

    /**
     * Binds to count() method. This is equal to make $this->queue->size().
     *
     * @return integer the queue size. 0 if it is empty.
     */
    public function count() {
        return $this->size;
    }
}