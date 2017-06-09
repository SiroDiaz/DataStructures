<?php

namespace DataStructures\Trees;

use DataStructures\Trees\Interfaces\TreeInterface;

abstract class BinaryTreeAbstract implements TreeInterface {
    protected $root;
    protected $size;

    public function empty() {
        return $this->root === null;
    }

    public function size() {
        return $this->size;
    }

    public function put($key, $data){}
    public function putOrUpdate($key, $data){}

    public function get($key){
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
    public function getRoot(){
        return $this->root;
    }

    public function exists($key){
        if($this->root === null) {
            return false;
        }

        if($this->root->key === $key) {
            return true;
        } else {
            $node = $this->root;
            while($node !== null) {
                if($key < $node->left) {
                    $node = $node->left;
                } else if($key > $node->right) {
                    $node = $node->right;
                } else {
                    return true;
                }
            }
        }

        return false;
    }

    public function floor($key){}
    public function ceil($key){}
    public function min(){}
    public function max(){}
    public function deleteMin(){}
    public function deleteMax(){}
    public function delete($key){}
    public function count() {}

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
    
    public function isLeaf($node) { // BinaryTreeNode
        return ($node !== null && $node->left === null && $node->right === null);
    }

    public function isRoot($node) {
        return $node !== null && $node->parent === null;
    }
}