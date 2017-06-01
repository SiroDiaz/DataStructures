<?php

class BSTNode {
    public $data;  // associated data
    public $left;  // left subtree
    public $right; // right subtree
    public $size;  // number of nodes in subtree

    public function __construct($data, BSTNode $left = null, BSTNode $right = null) {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
        $this->size = 0;
    }
}