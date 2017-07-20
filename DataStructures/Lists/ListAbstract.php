<?php

namespace DataStructures\Lists;

use DataStructures\Lists\Interfaces\ListInterface;
use OutOfBoundsException;

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

    /**
     * Add a new node in the specified index.
     *
     * @param mixed $data the data to be stored.
     */
    protected abstract function insertEnd($data);

    /**
     * Inserts at the beginning of the list.
     *
     * @param mixed $data
     */
    protected abstract function insertBeginning($data);

    /**
     * Removes all nodes of the list. It removes from the beginning.
     */
    public function clear() {
        while($this->head !== null) {
            $this->shift();
        }
    }

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

    /**
     * Delete a node in the given position and returns it back.
     *
     * @param integer $index the position.
     * @throws OutOfBoundsException if index is negative
     *  or is greater than the size of the list.
     */
    public function delete($index) {
        if($index < 0 || ($index > 0 && $index > $this->size - 1)) {
            throw new OutOfBoundsException();
        }

        // if the list is empty
        if($this->empty()) {
            return null;
        }
        
        $nodeData = null;
        if($index === 0) {
            $nodeData = $this->deleteBeginning();
        } else if($index === $this->size - 1) {
            $nodeData = $this->deleteEnd();
        } else {
            $nodeData = $this->deleteAt($index);
        }

        $this->size--;
        return $nodeData;
    }

    /**
     * Deletes at the beginnig of the list and returns the data stored.
     *
     * @return mixed the data stored in the node.
     */
    protected abstract function deleteBeginning();

    /**
     * Deletes at the specified position and returns the data stored.
     *
     * @param integer $index the position.
     * @return mixed the data stored in the node.
     */
    protected abstract function deleteAt($index);

    /**
     * Deletes at the end of the list and returns the data stored.
     *
     * @return mixed the data stored in the node.
     */
    protected abstract function deleteEnd();

    /**
     * Converts/exports the list content into array type.
     *
     * @return array data stored in all nodes.
     */
    public function toArray() : array {
        $arr = [];
        foreach($this->getAll() as $node) {
            $arr[] = $node;
        }

        return $arr;
    }
}