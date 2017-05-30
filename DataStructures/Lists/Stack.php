<?php

namespace DataStructures\Lists;

use DataStructures\Lists\Nodes\SimpleLinkedListNode as Node;
use DataStructures\Exceptions\FullException;
use OutOfBoundsException;

/**
 * Stack (LIFO) is a doubly linked list that inserts at the end
 * of list and removes at the end. Insert and remove
 * are O(1), size and empty are also O(1).
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class Stack {
    private $head;
    private $size;
    private $maxSize;

    public function __construct($maxSize = -1) {
        if($maxSize < -1 || $maxSize === 0) {
            throw new OutOfBoundsException();
        }
        $this->maxSize = $maxSize;
        $this->size = 0;
    }

    /**
     * Returns the stack size.
     *
     * @return int the length
     */
    public function size() : int {
        return 0;
    }
    

    /**
     * Checks if the stack is empty.
     *
     * @return boolean true if is empty, else false.
     */
    public function empty() : bool {
        return false;
    }

    /**
     * Adds at the end of the stack new node containing
     * the data to be stored.
     *
     * @param mixed $data The data
     */
    public function push($data) {
        
    }

    /**
     * Removes and returns the last node in the stack.
     *
     * @return mixed data in node.
     */
    public function pop() {
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
     * Returns true if is full the stack and false if there is
     * space available.
     *
     * @return bool 
     */
    public function isFull() {
        return false;
    }
}