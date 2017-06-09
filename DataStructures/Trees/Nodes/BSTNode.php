<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees\Nodes;

use DataStructures\Trees\Interfaces\BinaryNodeInterface;

/**
 * BSTNode class. Contains all attributes that represent the node for BST
 * and AVL with a pointer to the parent node.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class BSTNode implements BinaryNodeInterface {
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