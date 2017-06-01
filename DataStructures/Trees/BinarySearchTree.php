<?php

namespace DataStructures\Trees;

use DataStructures\Trees\Interfaces\TreeInterface;
use DataStructures\Trees\Nodes\BSTNode as Node;
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

    public function empty() : bool {
        return $this->root === null;
    }

    public function size() : int {
        return $this->size;
    }
    
    public function put($key, $data) {

    }

    public function update($key, $data) {

    }

    public function get($key) {

    }

    public function getMin() {

    }

    public function getMax() {

    }

    public function deleteMin() {

    }

    public function deleteMax() {
        
    }

    public function delete($key) {

    }

    private function search($key) : Node {
        return null;
    }

    /**
     * Binds to count() method. This is equal to make $this->tree->size().
     *
     * @return integer the tree size. 0 if it is empty.
     */
    public function count() {
        return $this->size;
    }
}