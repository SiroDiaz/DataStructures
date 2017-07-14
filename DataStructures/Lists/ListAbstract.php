<?php

namespace DataStructures\Lists;

use DataStructures\Lists\Interfaces\ListInterface;

abstract class ListAbstract implements ListInterface {
    protected $size;

    /**
     * Insert a node in the specified list position.
     *
     * @param integer $index position
     * @param mixed $data data to be saved
     */
    public function insert($index, $data) {
        if($index < 0) {
            throw new OutOfBoundsException();
        }

        if($index === 0) {
            $this->insertBeginning($data);
        } else if($index >= $this->size) {
            $this->insertEnd($data);
        } else if($index > 0 && $index < $this->size) {
            $this->insertAt($index, $data);
        }
        
        $this->size++;
    }

    /**
     * Add a new node in the specified index.
     *
     * @param integer $index the position.
     * @param mixed $data the data to be stored.
     */
    protected abstract function insertAt($index, $data);

    protected abstract function insertEnd($data);

    protected abstract function insertBeginning($data);

    /**
     * Binds to count() method. This is equal to make $this->tree->size().
     *
     * @return integer the tree size. 0 if it is empty.
     */
    public function count() {
        return $this->size;
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
        $this->insert($this->size, $data);
    }

    /**
     * Adds at the beginning a node in the list.
     *
     * @param mixed $data
     * @return mixed the data stored.
     */
    public function unshift($data) {
        $this->insert(0, $data);
    }

    /**
     * Deletes the first node of the list and returns it.
     *
     * @return mixed the data.
     */
    public function shift() {
        return $this->delete(0);
    }

    /**
     * Removes and returns the last node in the list.
     *
     * @return mixed data in node.
     */
    public function pop() {
        return $this->delete($this->size - 1);
    }
}