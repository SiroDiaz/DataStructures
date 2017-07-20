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
use DataStructures\Lists\Nodes\SimpleLinkedListNode;
use DataStructures\Lists\ListAbstract;
use OutOfBoundsException;

/**
 * CircularLinkedList
 *
 * CircularLinkedList is a single and circular linked list that has
 * a pointer to the next node and also and last node points to head.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class CircularLinkedList extends ListAbstract {
    use ArrayAccessTrait;
    protected $head;
    private $tail;
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
     * Inserts at the beginning of the list.
     *
     * @param mixed $data
     */
    protected function insertBeginning($data) {
        $newNode = new SimpleLinkedListNode($data);
        if($this->head === null) {
            $newNode->next = &$this->head;
            $this->head = &$newNode;
            $this->tail = &$newNode;
        } else {
            $this->tail->next = &$newNode;
            $newNode->next = $this->head;
            $this->head = &$newNode;
        }
    }

    /**
     * Add a new node in the specified index.
     *
     * @param integer $index the position.
     * @param mixed $data the data to be stored.
     */
    protected function insertEnd($data) {
        $newNode = new SimpleLinkedListNode($data);
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
    protected function insertAt($index, $data) {
        $newNode = new SimpleLinkedListNode($data);
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
     * @return DataStructures\Lists\Nodes\SimpleLinkedListNode the node stored in $index.
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
     * {@inheritDoc}
     */
    public function contains($data) : bool {
        if($this->size === 0) {
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

        if($prev->data === $data) {
            return true;
        }

        return false;
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
            if($current->data === $data) {
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
        $current = $this->head;
        $prev = $this->tail;
        $i = 0;
        
        if($this->head === null) {
            return null;
        }

        if($this->head->data === $data) {
            $this->head = &$this->head->next;
            $this->tail->next = &$this->head;
            $this->size--;
            return $current->data;
        }
        while($i < $this->size) {
            if($prev->data === $data) {
                $prev->next = &$current->next;
                $this->size--;

                return $current->data;
            }

            $prev = $current;
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
     * {@inheritDoc}
     */
    protected function deleteBeginning() {
        // if only there is an element
        if($this->head->next === $this->head) {
            $temp = $this->head;
            $this->head = null;
            return $temp->data;
        }
        
        $temp = $this->head;
        $this->head = &$this->head->next;
        $this->tail->next = &$this->head;

        return $temp->data;
    }

    /**
     * {@inheritDoc}
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

        $prev->next = &$current->next;

        return $current->data;
    }

    /**
     * {@inheritDoc}
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
        $this->tail = &$prev;
        $current = null;

        return $temp->data;
    }

    public function clear() {
        while($this->head !== null) {
            $this->shift();
        }
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