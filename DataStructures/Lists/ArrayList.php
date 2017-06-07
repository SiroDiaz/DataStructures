<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Lists;

use DataStructures\Lists\Interfaces\ListInterface;

/**
 * ArrayList
 *
 * This class is an implementation of a list based in native arrays.
 * The access time is, in general, O(1) since all in PHP is a hash table.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class ArrayList implements ListInterface {
    private $data;
    private $current;
    private $position;
    private $size;

    public function __construct() {
        $this->data = [];
        $this->size = 0;
        $this->position = 0;
    }

    /**
     * Add a new node in the specified index.
     *
     * @param integer $index the position.
     * @param mixed $data the data to be stored.
     */
    public function insert($index, $data) {
        array_splice($this->data, $index, 0, $data);
    }
    
    /**
     * Removes all the array items.
     */
    public function clear() {
        $this->data = [];
    }
    
     /**
     * Returns the array in the especified index.
     *
     * @param integer $index Index that must be greater than 0
     *  and lower than the list size.
     * @return mixed The data stored in the given index
     * @throws OutOfBoundsException if index is out bounds.
     */
    public function get($index) {
        if($index < 0 || $index > $this->size - 1) {
            throw new OutOfBoundsException();
        }

        return $this->data[$index];
    }

    public function getAll() {

    }

    public function empty() : bool {
        return $this->size === 0;
    }
    
    /**
     * Removes and returns the last item in the array.
     *
     * @return mixed data in node.
     */
    public function pop() {
        return array_pop($this->data);
    }

    /**
     * Adds at the end of the list new node containing
     * the data to be stored.
     *
     * @param mixed $data The data
     */
    public function push($data) {
        $this->data[] = $data;
    }

    public function delete($index) {
        unset($this->data[$index]);
    }
    
    /**
     * Returns the array size.
     *
     * @return int the length
     */
    public function size() : int {
        return $this->size;
    }

    /**
     * Returns array stored in the data attribute.
     *
     * @return array data stored in all nodes.
     */
    public function toArray() : array {
        return $this->data;
    }

    /**
     * Reset the cursor position.
     */
    public function rewind() {
        $this->position = 0;
        $this->current = $this->data[$this->position];
    }

    /**
     * Returns the current node data.
     *
     * @return mixed
     */
    public function current() {
        return $this->current;
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
        $this->current = $this->data[$this->position];
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