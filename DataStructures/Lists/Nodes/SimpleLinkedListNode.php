<?php

namespace DataStructures\Lists\Nodes;

class SimpleLinkedListNode {
    public $data = null;
    public $next = null;

    public function __construct($data) {
        $this->data = $data;
    }
}