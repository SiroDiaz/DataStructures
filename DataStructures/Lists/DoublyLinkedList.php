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
use DataStructures\Lists\Nodes\DoublyLinkedListNode;
use DataStructures\Lists\ListAbstract;
use OutOfBoundsException;

/**
 * DoublyLinkedList
 *
 * DoublyLinkedList is a double linked list that has
 * a pointer to the next and the previous node.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class DoublyLinkedList extends ListAbstract {
    use ArrayAccessTrait;

    protected $head;
    private $tail;
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
     * Gets the node stored in the position especified.
     * If index is 0 or (size - 1) the method is O(1) else O(n).
     *
     * @param integer $index the position.
     * @throws OutOfBoundsException if it is out of limits (< 0 or > size - 1)
     * @return DataStructures\Lists\Nodes\DoublyLinkedListNode|null the node stored in $index.
     */
    protected function search($index) {
        if($index < 0 || $index > $this->size - 1) {
            throw new OutOfBoundsException();
        }

        if($index === 0) {
            return $this->head;
        }

        if($index === $this->size - 1) {
            return $this->tail;
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

        return $current;
    }

    /**
     * Returns the data in the last node with O(1).
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
     * Returns the last node with O(1).
     *
     * @return DataStructures\Lists\Nodes\DoublyLinkedListNode|null if the list is empty.
     */
    public function searchLast() {
        if($this->head === null) {
            return null;
        }
        return $this->tail;
    }

    /**
     * {@inheritDoc}
     */
    public function contains($data) : bool {
        if($this->empty()) {
            return false;
        }

        $current = $this->head->next;
        $prev = $this->head;
        while($current !== $this->head) {
            if($prev->data === $data) {
                return true;
            }
            $prev = $current;
            $current = $current->next;
        }

        return $prev->data === $data;
    }

    /**
     * {@inheritDoc}
     */
    public function indexOf($data) {
        if($this->head === null) {
            return false;
        }
        
        $current = $this->head;
        $i = 0;
        
        while($i < $this->size) {
            if($current->data === $data) {
                return $i;
            }

            $current = $current->next;
            $i++;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function lastIndexOf($data) {
        if($this->head === null) {
            return false;
        }
        
        $current = $this->head;
        $i = 0;
        $pos = false;
        while($i < $this->size) {
            if($current->data == $data) {
                $pos = $i;
            }

            $current = $current->next;
            $i++;
        }

        return $pos;
    }

    /**
     * {@inheritDoc}
     */
    public function remove($data) {
        $current = &$this->head;
        $i = 0;
        
        if($this->head === null) {
            return null;
        }

        if($this->head->data === $data) {
            $this->head = &$this->head->next;
            $this->head->prev = &$this->tail;
            $this->size--;
            
            return $data;
        }

        while($i < $this->size) {
            if($current->data === $data) {
                $current->prev = &$current->next;
                $current = null;
                $this->size--;
                return $data;
            }

            $current = $current->next;
        }

        return null;
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
     * {@inheritDoc}
     */
    protected function insertBeginning($data) {
        $newNode = new DoublyLinkedListNode($data);
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

    protected function insertEnd($data) {
        $newNode = new DoublyLinkedListNode($data);
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
    protected function insertAt($index, $data) {
        $newNode = new DoublyLinkedListNode($data);
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
     * Deletes at the beginnig of the list and returns the data stored.
     *
     * @return mixed the data stored in the node.
     */
    protected function deleteBeginning() {
        // if only there is an element
        if($this->head->next === $this->head) {
            $temp = $this->head;
            $this->head = null;
        } else {
            $temp = $this->head;
            $this->head = &$this->head->next;
            $this->tail->next = &$this->head;
            
        }
        return $temp->data;
    }

    /**
     * Deletes at the specified position and returns the data stored.
     *
     * @param integer $index the position.
     * @return mixed the data stored in the node.
     */
    protected function deleteAt($index) {
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

        return $temp->data;
    }

    /**
     * Deletes at the end of the list and returns the data stored.
     *
     * @return mixed the data stored in the node.
     */
    protected function deleteEnd() {
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

        return $temp->data;
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