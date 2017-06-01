<?php

namespace DataStructures\Trees;

use DataStructures\Trees\Interfaces\TreeInterface;

class BinarySearchTree implements TreeInterface {
    private $root;
    private $size;

    public function __construct() {
        $this->root = null;
        $this->size = 0;
    }
}