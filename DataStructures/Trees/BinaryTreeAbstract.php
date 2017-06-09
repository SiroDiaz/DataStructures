<?php

namespace DataStructures\Trees;

use DataStructures\Trees\Interfaces\TreeInterface;

abstract class BinaryTreeAbstract implements TreeInterface {
    protected $root;
    protected $size;

    public function search($key) {
        if($this->root === null) {
            return null;
        }

        if($this->root->key === $key) {
            return $this->root->data;
        } else {
            $node = $this->root;
            while($node !== null) {
                if($key < $node->left) {
                    $node = $node->left;
                } else if($key > $node->right) {
                    $node = $node->right;
                } else {
                    return $node->data;
                }
            }
        }

        return null;
    }
    
    public function isLeaf(BinaryTreeNode $node) {
        return ($node !== null && $node->left === null && $node->right === null);
    }

    public function isRoot($node) {
        return $node !== null && $node->parent === null;
    }
}