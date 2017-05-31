<?php

namespace DataStructures\Lists\Nodes;

/**
 * SimpleLinkedListNode is the node atomic structure of lists.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class SimpleLinkedListNode {
    public $data = null;
    public $next = null;

    public function __construct($data) {
        $this->data = $data;
    }
}