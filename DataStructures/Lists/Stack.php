<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Lists;

use DataStructures\Lists\Nodes\SimpleLinkedListNode as Node;
use DataStructures\Exceptions\FullException;
use InvalidArgumentException;
use Countable;

/**
 * Stack
 *
 * Stack (LIFO) is a singly linked list that inserts and removes at the
 * beginnig of list. Insert and remove are O(1), size and empty are also O(1).
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class Stack implements Countable {
    /**
     * @var $head represents the stack head.
     */
    private $head;
    /**
     * @var $size contains the stack size. Increments each time
     *  that is inserted a new item.
     */
    private $size;
    /**
     * @var $maxSize if 0 it means that stack is unlimited, else it indicates
     *  the maximum size of the stack.
     */
    private $maxSize;

    /**
     * Initializes the stack.
     *
     * @param int $maxSize 0 by default. If greater than 0 is limited.
     * @throws \InvalidArgumentException if size is lower than 0.
     */
    public function __construct($maxSize = 0) {
        if($maxSize < 0) {
            throw new InvalidArgumentException();
        }
        $this->head = null;
        $this->maxSize = $maxSize;
        $this->size = 0;
    }

    /**
     * Returns the stack size.
     *
     * @return int the length
     */
    public function size() : int {
        return $this->size;
    }
    

    /**
     * Checks if the stack is empty.
     *
     * @return boolean true if is empty, else false.
     */
    public function empty() : bool {
        return $this->size === 0;
    }

    /**
     * Adds at the end of the stack new node containing
     * the data to be stored.
     *
     * @param mixed $data The data
     * @throws DataStructures\Exceptions\FullException if the queue is full.
     */
    public function push($data) {
        if($this->isFull()) {
            throw new FullException();
        }

        $newNode = new Node($data);
        if($this->head === null) {
            $this->head = &$newNode;
            $newNode->next = null;
        } else {
            $temp = $this->head;
            $this->head = &$newNode;
            $newNode->next = &$temp;
        }

        $this->size++;
    }

    /**
     * Removes and returns the last node in the stack.
     *
     * @return mixed data in node.
     */
    public function pop() {
        if($this->head === null) {
            return null;
        }
        
        $node = $this->head;
        $this->head = $this->head->next;
        $this->size--;

        return $node->data;
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
     * Returns true if is full the stack and false if there is
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
     * Binds to count() method. This is equal to make $this->stack->size().
     *
     * @return integer the stack size. 0 if it is empty.
     */
    public function count() {
        return $this->size;
    }
}