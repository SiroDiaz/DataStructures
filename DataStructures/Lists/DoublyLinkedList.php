<?php

namespace DataStructures\Lists;

use DataStructures\Lists\Interfaces\ListInterface;

class DoublyLinkedList extends ListInterface {
    private $head;
    private $tail;
    private $size;
    private $position;
    private $current;

    public function __construct() {
        $this->size = 0;
    }

    /**
     * Removes all nodes of the list. It removes from the beginning.
     */
    public function clear() {

    }
    
    /**
     * Gets the data stored in the position especified.
     *
     * @param integer $index Index that must be greater than 0
     *  and lower than the list size.
     * @return mixed The data stored in the given index
     * @throws OutOfBoundsException if index is out bounds.
     */
    public function get($index) {
        return null;
    }
    
    /**
     * Generator for retrieve all nodes stored.
     * 
     * @return null if the head is null (or list is empty)
     */
    public function getAll() {

    }
    
    /**
     * Checks if the list is empty.
     *
     * @return boolean true if is empty, else false.
     */
    public function empty() : bool {
        return $this->size === 0;
    }

    /**
     * Adds at the end of the list new node containing
     * the data to be stored.
     *
     * @param mixed $data The data
     */
    public function push($data) {
        
    }
    
    /**
     * Delete a node in the given position and returns it back.
     *
     * @param integer $index the position.
     * @throws OutOfBoundsException if index is negative
     *  or is greater than the size of the list.
     */
    public function delete($index) {
        return null;
    }
    
    /**
     * Returns the list size.
     *
     * @return int the length
     */
    public function size() : int {
        return 0;
    }
    
    /**
     * Converts/exports the list content into array type.
     *
     * @return array data stored in all nodes.
     */
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
        return $this->position < $this->size;
    }
}