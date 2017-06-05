<?php

namespace DataStructures\Trees\Nodes;

use DataStructures\Trees\Nodes\BSTNode;

/**
 * AVLNode is the container class that represent a node inside a AVL tree.
 * It is like BST node but has an adicional attribute: height. Height is used
 * to know when to balance the AVL tree.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class AVLNode extends BSTNode {
    public $height; // the node height

    public function __construct($key, $data, $parent = null, $left = null, $right = null) {
        parent::__construct($key, $data, $parent, $left, $right);
        $this->height = 0;
    }
}