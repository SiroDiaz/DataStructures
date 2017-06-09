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
use DataStructures\Trees\Interfaces\BinaryNodeInterface;
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

    /**
     * Inserts data in the correct position.
     *
     * @param integer|string $key the key used to store.
     * @param mixed $data the data to store.
     * @param bool $update if false the node isn't updated
     *  else if the key matches is updated.
     */
    public function put($key, $data, $update = false) {
        $newNode = new BSTNode($key, $data);
        
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

        $newNode->parent = &$parentNode;
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
     * Deletes the node with the maximum key and returns it. The most right and more bottom.
     * 
     * @param DataStructures\Trees\Nodes\BSTNode|null if null takes the root.
     * @return DataStructures\Trees\Nodes\BSTNode|null the maximum node or
     *  null if the tree is empty.
     */
    public function delete($key) {
        $deleteNode = $this->search($key);
        if($deleteNode !== null) {
            $this->_delete($deleteNode);
            return $deleteNode;
        }

        return null;
    }

    /**
     * Deletes the selected node if is not null and returns the node
     * that replaces the deleted node. Also decrease the size of tree.
     *
     * @param DataStructures\Trees\Nodes\BSTNode|null The node to be deleted.
     * @return the node that replaces the deleted.
     */
    protected function _delete(BinaryNodeInterface &$node) {
        if($node !== null) {
            $nodeToReturn = null;
            if($node->left === null) {
                $nodeToReturn = $this->replace($node, $node->right);
            } else if($node->right === null) {
                $nodeToReturn = $this->replace($node, $node->left);
            } else {
                $successorNode = $this->getMinNode($node->right);
                if($successorNode->parent !== $node) {
                    $this->replace($successorNode, $successorNode->right);
                    $successorNode->right = &$node->right;
                    $successorNode->right->parent = &$successorNode;
                }

                $this->replace($node, $successorNode);
                $successorNode->left = &$node->left;
                $successorNode->left->parent = &$successorNode;
                $nodeToReturn = &$successorNode;
            }

            $this->size--;
            return $nodeToReturn;
        }

        return null;
    }

    
}