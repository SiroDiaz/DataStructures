<?php

namespace DataStructures\Trees\Nodes;

class BSTNode {
    public $key;   // key used to insert, remove and retrieve
    public $data;  // associated data
    public $left;  // left subtree
    public $right; // right subtree
    public $size;  // number of nodes in subtree

    public function __construct($key, $data, BSTNode $left = null, BSTNode $right = null) {
        $this->key = $key;
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
        $this->size = 0;
    }
}