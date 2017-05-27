<?php

namespace DataStructures;

use DataStructures\Nodes\SimpleLinkedListNode as Node;
use OutOfBoundsException;
use Iterator;

/**
 * CircularLinkedList is a single and circular linked list that has
 * a pointer to the next node and also and last node points to head.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class CircularLinkedList implements Iterator {
    private $head;
    private $size;

    public function __construct() {
        $this->head = null;
    }

    public function size() {
        return $this->size;
    }
}