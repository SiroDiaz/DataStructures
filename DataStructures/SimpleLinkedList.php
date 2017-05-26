<?php

namespace DataStructures;
use DataStructures\Nodes\SimpleLinkedListNode;

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
     * @param mixed $node The data
     */
    public function push($node) {
        $newNode = new SimpleLinkedListNode($node);
        if($this->size === 0) {
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
        while($current->next !== null) {
            yield $current->data;
            $current = $current->next;
        }
    }

    /**
     * Insert a node in the specified list position.
     *
     * @param integer $index position
     * @param mixed $node data to be saved
     */
    public function insertAt($index, $node) {
        if($index === 0 || $index === $this->size - 1) {
            return $this->push($node);
        }

        $i = 0;
        $current = $this->head;
        while($i < $index && $current->next !== null) {
            $i++;
        }

        $this->size++;
    }

    /**
     *
     */
    public function unshift($node) {

    }
}