<?php

namespace DataStructures\Trees\Nodes;

/**
 * BSTNode class. Contains all attributes that represent the node for BST
 * and AVL with a pointer to the parent node.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class BSTNode {
    public $key;    // key used to insert, remove and retrieve
    public $data;   // associated data
    public $parent; // the parent node
    public $left;   // left subtree
    public $right;  // right subtree

    public function __construct($key, $data, $parent = null, $left = null, $right = null) {
        $this->key = $key;
        $this->data = $data;
        $this->parent = $parent;
        $this->left = $left;
        $this->right = $right;
    }
}