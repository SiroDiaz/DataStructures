<?php

namespace DataStructures\Lists\Nodes;

/**
 * DoublyLinkedList represents the node structure that points to 
 * the next and previous node.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class DoublyLinkedListNode {
    public $data;
    public $next;
    public $prev;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
        $this->prev = null;
    }
}