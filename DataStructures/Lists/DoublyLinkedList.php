<?php

namespace DataStructures\Lists;

use DataStructures\Lists\Nodes\DoublyLinkedListNode as Node;
use DataStructures\Lists\Interfaces\ListInterface;
use OutOfBoundsException;

/**
 * SimpleLinkedList is a single linked list that has
 * a pointer to the next node but last node points to null.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class DoublyLinkedList implements ListInterface {
    private $head;
    private $tail;
    private $size;
    private $position;
    private $current;

    public function __construct() {
        $this->head = null;
        $this->tail = &$this->head;
        $this->size = 0;
        $this->position = 0;
        $this->current = &$this->head;
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
     * Gets the data stored in the position especified.
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

        if($index === 0) {
            return $this->head->data;
        }

        if($index === $this->size - 1) {
            return $this->tail->data;
        }

        $current = &$this->head;
        if($index < (int) ceil($this->size / 2)) {
            $i = 0;
            while($i < $index) {
                $current = &$current->next;
                $i++;
            }    
        } else {
            $i = $this->size;
            while($i > $index) {
                $current = &$current->prev;
                $i--;
            }
        }

        return $current->data;
    }

    /**
     * Returns the last node with O(1).
     *
     * @return mixed null if the list is empty.
     */
    public function getLast() {
        if($this->head === null) {
            return null;
        }
        return $this->tail->data;
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

        if($this->head === $this->tail) {
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
     * Checks if the list is empty.
     *
     * @return boolean true if is empty, else false.
     */
    public function empty() : bool {
        return $this->size === 0;
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
            $newNode->prev = &$this->head;
            $this->head = &$newNode;
            $this->tail = &$newNode;
        } else {
            $this->tail->next = &$newNode;
            $newNode->next = &$this->head;
            $newNode->prev = &$this->tail;
            $this->head = &$newNode;
        }
    }

    /**
     * Add a new node in the specified index.
     *
     * @param mixed $data the data to be stored.
     */
    private function insertEnd($data) {
        $newNode = new Node($data);
        $this->tail->next = &$newNode;
        $newNode->next = &$this->head;
        $newNode->prev = &$this->tail;
        $this->tail = &$newNode;
        $this->head->prev = &$newNode;
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
        $newNode->prev = &$prev;
        $newNode->next = &$current;
        $current->prev = &$newNode;
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

        $temp = $current;
        $prev->next = &$current->next;
        $current->next->prev = &$pre;
        $current = null;
        $this->size--;

        return $temp->data;
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
        $this->head->prev = &$prev;
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
     * Returns the list size.
     *
     * @return int the length
     */
    public function size() : int {
        return $this->size;
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