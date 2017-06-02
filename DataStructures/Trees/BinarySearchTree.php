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

    /**
     * Checks if the tree is empty.
     *
     * @return boolean true if is empty, else false.
     */
    public function empty() : bool {
        return $this->root === null;
    }

    /**
     * Returns the tree size.
     *
     * @return int the length
     */
    public function size() : int {
        return $this->size;
    }

    /**
     * Inserts data in the correct position.
     *
     * @param integer|string $key the key used to store.
     * @param mixed $data the data to store.
     * @param bool $update if false the node isn't updated
     *  else if the key matches is updated.
     */
    public function put($key, $data, $update = false) {
        $newNode = new Node($key, $data);
        
        if($this->root === null) {
            $this->root = &$newNode;
            $this->size++;
            return;
        }

        $parentNode = null;
        $current = &$this->root;
        while($current !== null) {
            $parentNode = &$current;
            if($key < $current->key) {
                $current = &$current->left;
            } else if($key > $current->key) {
                $current = &$current->right;
            } else {
                if($update) {
                    $current->data = $data;
                }
                return;
            }
        }

        $newNode = new Node($key, $data, $parentNode);
        if($key < $parentNode->key) {
            $parentNode->left = &$newNode;
        } else {
            $parentNode->right = &$newNode;
        }

        $this->size++;
    }
    
    /**
     * Creates a new node or updates it if already exists.
     *
     * @param int|string $key the key.
     * @param mixed $data the data to be stored. 
     */
    public function putOrUpdate($key, $data) {
        $this->put($key, $data, true);
    }

    /**
     * Retrieve the data stored in the tree.
     *
     * @param int|string $key the key to identify the data.
     * @return mixed
     */
    public function get($key) {
        $node = $this->root;
        if($node === null) {
            return null;
        }

        while($node !== null) {
            if($key < $node->key) {
                $node = $node->left;
            } else if($key > $node->key) {
                $node = $node->right;
            } else {
                return $node->data;
            }
        }

        if($node === null) {
            return null;
        }

        return $node->data;
    }

    /**
     *
     */
    public function exists($key) : bool {
        return $this->_exists($this->root, $key);
    }

    private function _exists($node, $key) : bool {
        if($node === null) {
            return false;
        }

        if($node->key === $key) {
            return true;
        } else if($key < $node->key) {
            return $this->_exists($node->left, $key);
        } else if($key > $node->key) {
            return $this->_exists($node->right, $key);
        }
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