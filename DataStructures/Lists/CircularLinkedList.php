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
use DataStructures\Lists\Nodes\SimpleLinkedListNode as Node;
use DataStructures\Lists\Interfaces\ListInterface;
use OutOfBoundsException;

/**
 * CircularLinkedList
 *
 * CircularLinkedList is a single and circular linked list that has
 * a pointer to the next node and also and last node points to head.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class CircularLinkedList implements ListInterface {
    use CountTrait, ArrayAccessTrait;
    private $head;
    private $tail;
    private $size;
    private $current;
    private $position;

    public function __construct() {
        $this->head = null;
        $this->tail = &$this->head;
        $this->size = 0;
        $this->position = 0;
        $this->current = &$this->head;
    }

    /**
     * Inserts data in the specified position.
     *
     * @param integer $index the position.
     * @param mixed $data the data to store.
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
     * Inserts at the beginning of the list.
     *
     * @param mixed $data
     */
    private function insertBeginning($data) {
        $newNode = new Node($data);
        if($this->head === null) {
            $newNode->next = &$this->head;
            $this->head = &$newNode;
            $this->tail = &$newNode;
        } else {
            $this->tail->next = &$newNode;
            $newNode->next = &$this->head;
            $this->head = &$newNode;
        }
    }

    /**
     * Add a new node in the specified index.
     *
     * @param integer $index the position.
     * @param mixed $data the data to be stored.
     */
    private function insertEnd($data) {
        $newNode = new Node($data);
        $this->tail->next = &$newNode;
        $newNode->next = &$this->head;
        $this->tail = &$newNode;
    }

    /**
     * Add a new node in the specified index.
     *
     * @param integer $index the position.
     * @param mixed $data the data to be stored.
     */
    private function insertAt($index, $data) {
        $newNode = new Node($data);
        $current = $this->head;
        $prev = null;
        $i = 0;
        while($i < $index) {
            $prev = $current;
            $current = $current->next;
            $i++;
        }
        
        $prev->next = &$newNode;
        $newNode->next = &$current;
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
     * Returns the last node data with O(1).
     *
     * @return mixed null if the list is empty.
     */
    public function getLast() {
        $node = $this->searchLast();

        return $node !== null ? $node->data : null;
    }

    /**
     * Returns the last node with O(1).
     *
     * @return mixed null if the list is empty.
     */
    protected function searchLast() {
        if($this->head === null) {
            return null;
        }

        return $this->tail;
    }
    
    /**
     * Returns the data stored in the given position.
     * If index is 0 or size - 1 the method is O(1) else O(n).
     *
     * @param integer $index the position.
     * @throws OutOfBoundsException if it is out of limits (< 0 or > size - 1)
     * @return mixed the data stored in $index node.
     */
    public function get($index) {
        $node = $this->search($index);
        if($node === null) {
            return null;
        }

        return $node->data;
    }

    /**
     * Returns the node stored in the given position.
     * If index is 0 or (size - 1) the method is O(1) else O(n).
     *
     * @param integer $index the position.
     * @throws OutOfBoundsException if it is out of limits (< 0 or > size - 1)
     * @return DataStructures\Lists\Nodes\SimpleLinkedListNode|null the node stored in $index.
     */
    protected function search($index) {
        if($index < 0 || $index > $this->size - 1) {
            throw new OutOfBoundsException();
        }

        if($index === 0) {
            return $this->head;
        }

        if($index === $this->size - 1) {
            return $this->searchLast();
        }

        $i = 0;
        $current = $this->head;
        while($i < $index) {
            $current = $current->next;
            $i++;
        }

        return $current;
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
        
        if($this->head->next === $this->tail) {
            yield $this->head->data;
        } else {
            $current = $this->head;
            $i = 0;
            while($i < $this->size) {
                yield $current->data;
                $current = $current->next;
                $i++;
            }
        }
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
        if($this->head === null) {
            return null;
        }
        
        // if only there is an element
        if($this->head->next === $this->head) {
            $temp = $this->head;
            $this->head = null;
            $this->size--;

            return $temp->data;
        }

        if($index === 0) {
            return $this->deleteBeginning();
        } else if($index === $this->size - 1) {
            return $this->deleteEnd();
        } else {
            return $this->deleteAt($index);
        }
    }

    /**
     * Deletes at the beginnig of the list and returns the data stored.
     *
     * @return mixed the data stored in the node.
     */
    private function deleteBeginning() {
        $temp = $this->head;
        $this->head = &$this->head->next;
        $this->tail->next = &$this->head;
        $this->size--;

        return $temp->data;
    }

    /**
     * Deletes at the specified position and returns the data stored.
     *
     * @param integer $index the position.
     * @return mixed the data stored in the node.
     */
    private function deleteAt($index) {
        $i = 0;
        $prev = $this->head;
        $current = $this->head;
        
        while($i < $index) {
            $prev = $current;
            $current = $current->next;
            $i++;
        }

        $prev->next = &$current->next;
        $this->size--;

        return $current->data;
    }

    /**
     * Deletes at the end of the list and returns the data stored.
     *
     * @return mixed the data stored in the node.
     */
    private function deleteEnd() {
        $prev = $this->head;
        $current = $this->head;
        
        while($current !== $this->tail) {
            $prev = $current;
            $current = $current->next;
        }
        
        $temp = $current;
        $prev->next = &$this->head;
        $this->tail = &$prev;
        $current = null;

        $this->size--;

        return $temp->data;
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
     * Removes all nodes of the list. It removes from the beginning.
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