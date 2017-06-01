<?php

namespace DataStructures\Trees\Nodes;

/**
 * BSTNode class. Contains all attributes that represent the node for BST
 * and AVL.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
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