<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees;

use DataStructures\Trees\Nodes\BSTNode;
use DataStructures\Trees\BinaryTreeAbstract;

/**
 * BinarySearchTree
 * 
 * Represents a BST actions that can be realized. All the implementation
 * is in BinaryTreeAbstract class.
 * At the beginning root is null and it can grow up to a O(n) in search,
 * delete and insert (in worst case). In best cases it will be O(log n).
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class BinarySearchTree extends BinaryTreeAbstract {

    public function __construct() {
        $this->root = null;
        $this->size = 0;
    }

    public function createNode($key, $data, $parent = null, $left = null, $right = null) {
        return new BSTNode($key, $data, $parent, $left, $right);
    }
}