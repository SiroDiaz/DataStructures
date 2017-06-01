<?php

namespace DataStructures\Trees;

use DataStructures\Trees\Interfaces\TreeInterface;

/**
 * BinarySearchTree class. Represents a BST actions that can be realized.
 * At the beginning root is null and it can grow up to a O(n) in search,
 * delete and insert (in worst case). In best cases it will be O(log n).
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class BinarySearchTree implements TreeInterface {
    private $root;
    private $size;

    public function __construct() {
        $this->root = null;
        $this->size = 0;
    }
}