<?php

namespace DataStructures\Lists;

use DataStructures\Lists\Interfaces\ListInterface;

class ArrayList implements ListInterface {
    private $data;
    private $current;
    private $position;
    private $size;

    public function __construct() {
        $this->data = [];
        $this->size = 0;
    }

    public function insert($index, $data) {

    }
    
    public function clear() {

    }
    
    public function get($index) {

    }

    public function getAll() {

    }

    public function empty() : bool {
        return true;
    }
    
    public function delete($index) {

    }
    
    public function size() : int {
        return 0;
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
        return $this->position < $this->size;
    }

    /**
     * Binds to count() method. This is equal to make $this->list->size().
     *
     * @return integer the list size. 0 if it is empty.
     */
    public function count() {
        return $this->size;
    }

    public function offsetSet($offset, $valor) {
        //TODO
        if (is_null($offset)) {
            // $this->contenedor[] = $valor;
        } else {
            // $this->contenedor[$offset] = $valor;
        }
    }
    
    public function offsetExists($offset) {
        //TODO
        return false;
        // return isset($this->contenedor[$offset]);
    }

    public function offsetUnset($offset) {
        //TODO
        // unset($this->contenedor[$offset]);
    }

    public function offsetGet($offset) {
        //TODO
        return false;
        // return isset($this->contenedor[$offset]) ? $this->contenedor[$offset] : null;
    }
}