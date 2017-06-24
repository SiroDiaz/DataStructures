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
use DataStructures\Lists\Interfaces\ListInterface;
use OutOfBoundsException;
use Iterator;

/**
 * SimpleLinkedList
 *
 * SimpleLinkedList is a singly linked list that has
 * a pointer to the next node but last node points to null.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class SimpleLinkedList implements ListInterface {
    private $head;
    private $size;
    private $position;
    private $current;

    public function __construct() {
        $this->head = null;
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
        return $this->size === 0;
    }

    /**
     * Adds at the end of the list new node containing
     * the data to be stored.
     *
     * @param mixed $data The data
     */
    public function push($data) {
        $newNode = new Node($data);
        if($this->head === null) {
            $this->head = &$newNode;
            $this->current = &$this->head;
        } else {
            $current = $this->head;
            while($current->next !== null) {
                $current = $current->next;
            }
            $current->next = &$newNode;
        }

        $this->size++;
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
        if($index > $this->size - 1 || $index < 0) {
            throw new OutOfBoundsException();
        }
        

        $current = $this->head;
        $i = 0;
        while($i < $index && $current->next !== null) {
            $current = $current->next;
            $i++;
        }

        return $current->data;
    }

    /**
     * Generator for retrieve all nodes stored.
     * 
     * @return null if the head is null (or list is empty)
     */
    public function getAll() {
        if($this->head === null) {
            return;
        }

        $current = $this->head;
        while($current !== null) {
            yield $current->data;
            $current = $current->next;
        }
    }

    /**
     * Insert a node in the specified list position.
     *
     * @param integer $index position
     * @param mixed $data data to be saved
     */
    public function insert($index, $data) {
        if($this->head === null) {
            return $this->push($data);
        }

        $newNode = new Node($data);
        if($index === 0) {
            $aux = $this->head;
            $this->head = &$newNode;
            $newNode->next = &$aux;
            $this->current = &$this->head;
        } else {
            $i = 0;
            $current = $this->head;
            $prev = $current;
            while($i < $index && $current->next !== null) {
                $prev = $current;
                $current = $current->next;
                $i++;
            }

            $prev->next = &$newNode;
            $newNode->next = &$current;
        }

        $this->size++;
    }

    /**
     * Delete a node in the given position and returns it back.
     *
     * @param integer $index the position.
     * @throws OutOfBoundsException if index is negative
     *  or is greater than the size of the list.
     */
    public function delete($index) {
        if($index < 0) {
            throw new OutOfBoundsException();
        }
        if($this->head === null) {
            return null;
        }

        if($index >= $this->size) {
            return null;    // It should return an exception
        }

        if($index === 0) {
            $node = $this->head;
            $this->head = $this->head->next;
            $this->current = &$this->head;
            $this->size--;
            return $node->data;
        }
        
        $i = 0;
        $current = $this->head;
        $prev = $current;
        while($i < $index && $current->next !== null) {
            $prev = $current;
            $current = $current->next;
        }
        $prev->next = $current->next;
        $this->size--;

        return $prev->data;
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
     * Remove all nodes of the list using shift.
     */
    public function clear() {
        while($this->head !== null) {
            $this->shift();
        }
    }

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
     * Reset the cursor position.
     */
    public function rewind() {
        $this->position = 0;
        $this->current = $this->head;
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
        return $this->current !== null;
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
        try {
            return $this->get($offset);
        } catch(OutOfBoundsException $e) {
            return false;
        }
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