<?php

namespace DataStructures;

use DataStructures\Nodes\SimpleLinkedListNode as Node;
use OutOfBoundsException;

/**
 * SimpleLinkedList is a single linked list that has
 * a pointer to the next node but last node points to null.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class SimpleLinkedList {
    private $head;
    private $size;

    public function __construct() {
        $this->head = null;
        $this->size = 0;
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
        return $this->size == 0;
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
     */
    public function get($index) {
        if($this->head === null || $index > $this->size - 1 || $index < 0) {
            return null;
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
            return null;
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
            $this->header = $this->head->next;
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
}