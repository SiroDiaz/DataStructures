<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Lists;

use DataStructures\Lists\Traits\{CountTrait, ArrayAccessTrait};
use DataStructures\Lists\ListAbstract;
use OutOfBoundsException;

/**
 * ArrayList
 *
 * This class is an implementation of a list based in native arrays.
 * The access time is, in general, O(1) since all in PHP is a hash table.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class ArrayList extends ListAbstract {
    use ArrayAccessTrait;

    private $data;
    private $current;
    private $position;

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
        $this->size++;
    }
    
    /**
     * Removes all the array items.
     */
    public function clear() {
        $this->data = [];
        $this->size = 0;
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

    /**
     * Returns the last node with O(1).
     *
     * @return mixed null if the array is empty.
     */
    public function getLast() {
        if(!$this->empty()) {
            return $this->data[$this->size - 1];
        }
        
        return null;
    }

    public function getAll() {
        foreach($this->data as $data) {
            yield $data;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function contains($data) : bool {
        return in_array($data, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function indexOf($data) {
        return array_search($data, $this->data, true);
    }

    /**
     * {@inheritDoc}
     */
    public function lastIndexOf($data) {
        for($i = $this->size - 1; $i >= 0; $i--) {
            if($this->data[$i] === $data) {
                return $i;
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function remove($data) {
        $i = 0;
        
        while($i < $this->size) {
            if($this->data[$i] === $data) {
                $aux = $this->data[$i];
                array_splice($this->data, $i, 1);
                
                return $aux;
            }
            $i++;
        }
        return null;
    }

    /**
     * Delete a node in the given position and returns it back.
     *
     * @param integer $index the position.
     * @throws OutOfBoundsException if index is negative
     *  or is greater than the size of the list.
     */
    public function delete($index) {
        if($this->size === 0 || $index < 0 || $index > $this->size - 1) {
            throw new OutOfBoundsException();
        }
        
        $data = $this->data[$index];
        array_splice($this->data, $index, 1);
        $this->size--;

        return $data;
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
}