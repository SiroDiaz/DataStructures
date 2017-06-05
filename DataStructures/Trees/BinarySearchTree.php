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
     * Returns the root node.
     *
     * @return DataStructures\Trees\Nodes\BSTNode|null the root node.
     */
    public function getRoot() {
        return $this->root;
    }

    /**
     * Looks for the node with the given key.
     *
     * @param int|string $key the key used to look for.
     * @return bool true if was found.
     */
    public function exists($key) : bool {
        return $this->_exists($this->root, $key);
    }

    /**
     * Method that retrieves true if found a node with the specified key.
     * It's the recursive version of exists method and it's used internally
     * for traverse through a root node.
     *
     * @param DataStructures\Trees\Nodes\BSTNode $node the root node.
     * @param int|string $key the key used to look for.
     * @return bool true if exists a node with that key.
     */
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

    public function floor($key) {

    }
    
    public function ceil($key) {

    }
    
    /**
     * Gets the node with the minimum key. The most left and more bottom.
     * 
     * @return DataStructures\Trees\Nodes\BSTNode|null the minum node or
     *  null if the tree is empty.
     */
    public function min() {
        if($this->root === null) {
            return null;
        }
        
        if($this->root->left === null) {
            return $this->root;
        }

        $current = $this->root;
        while($current->left !== null) {
            $current = $current->left;
        }

        return $current;
    }

    /**
     * Returns the minimum node from a given node in position X.
     *
     * @param DataStructures\Trees\Nodes\BSTNode $node the start point.
     * @return DataStructures\Trees\Nodes\BSTNode|null the minimum node.
     */
    private function getMinNode(Node $node) {
        while($node->left !== null) {
            $node = $node->left;
        }

        return $node;
    }

    /**
     * Gets the node with the maximum key. The most right and more bottom.
     * 
     * @return DataStructures\Trees\Nodes\BSTNode|null the maximum node or
     *  null if the tree is empty.
     */
    public function max() {
        if($this->root === null) {
            return null;
        }

        if($this->root->right === null) {
            return $this->root;
        }

        $current = $this->root;
        while($current->right !== null) {
            $current = $current->right;
        }

        return $current;
    }

    /**
     * Returns the maximum node from a given node in position X.
     *
     * @param DataStructures\Trees\Nodes\BSTNode $node the start point.
     * @return DataStructures\Trees\Nodes\BSTNode|null the maximum node.
     */
    private function getMaxNode(Node $node) {
        while($node->right !== null) {
            $node = $node->right;
        }

        return $node;
    }

    /**
     * Deletes the node with the minimum key and returns it. The most left and more bottom.
     * 
     * @param DataStructures\Trees\Nodes\BSTNode|null if null takes the root.
     * @return DataStructures\Trees\Nodes\BSTNode|null the minimum node or
     *  null if the tree is empty.
     */
    public function deleteMin(Node $node = null) {
        $node = $this->getMinNode($node ?? $this->root);
        if($node !== null) {
            $this->_delete($node);
        }
        
        return $node;
    }
    
    /**
     * Deletes the node with the maximum key and returns it. The most right and more bottom.
     * 
     * @param DataStructures\Trees\Nodes\BSTNode|null if null takes the root.
     * @return DataStructures\Trees\Nodes\BSTNode|null the maximum node or
     *  null if the tree is empty.
     */
    public function deleteMax(Node $node = null) {
        $node = $this->getMaxNode($node ?? $this->root);
        if($node !== null) {
            $this->_delete($node);
        }

        return $node;
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
     * Replaces the node n to remove a new one k and links k with the parent
     * of n.
     *
     * @param DataStructures\Trees\Nodes\BSTNode $nodeToReplace the node to remove.
     * @param DataStructures\Trees\Nodes\BSTNode|null $newNode the newNode
     *  to link with the $nodeToReplace parent.
     * @return DataStructures\Trees\Nodes\BSTNode the new linked node.
     */
    private function replace(&$nodeToReplace, &$newNode) {
        if($nodeToReplace->parent === null) {
            $this->root = &$newNode;
        } else if($nodeToReplace === $nodeToReplace->parent->left) {
            $nodeToReplace->parent->left = &$newNode;
        } else if($nodeToReplace === $nodeToReplace->parent->right) {
            $nodeToReplace->parent->right = &$newNode;
        }

        if($newNode !== null) {
            $newNode->parent = &$nodeToReplace->parent;
        }

        return $newNode;
    }

    /**
     * Deletes the selected node if is not null and returns the node
     * that replaces the deleted node. Also decrease the size of tree.
     *
     * @param DataStructures\Trees\Nodes\BSTNode|null The node to be deleted.
     * @return the node that replaces the deleted.
     */
    private function _delete(Node &$node) {
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

    /**
     * Retrieves the node with the specified key.
     *
     * @param int|string $key the key used to store.
     * @return DataStructures\Trees\Nodes\BSTNode|null the node or null.
     */
    public function search($key) {
        if($this->root === null) {
            return null;
        }

        if($this->root->key === $key) {
            return $this->root;
        } else {
            $node = $this->root;
            while($node !== null) {
                if($key < $node->key) {
                    $node = $node->left;
                } else if($key > $node->key) {
                    $node = $node->right;
                } else {
                    return $node;
                }
            }
        }

        return null;
    }

    /**
     * Returns true if is leaf the node.
     *
     * @param DataStructures\Trees\Nodes\BSTNode|null $node default to null.
     * @return true if is leaf the node, is not null and their subtrees has no
     *  pointers to successors.
     */
    public function isLeaf($node) {
        return $node !== null && $node->left === null && $node->right === null;
    }

    /**
     * Checks if a node is root. New nodes that does not point to any other node
     * also are called a root node.
     *
     * @param DataStructures\Trees\Nodes\BSTNode|null $node default to null.
     * @return true if is root the node, is not null and their subtrees has no
     *  pointers to successors.
     */
    public function isRoot($node) {
        return $node !== null && $node->parent === null;
    }

    /**
     * Traverse in preorder. This is: first visit the root, then
     * the left subtree and finally the right subtree.
     */
    public function preorder(Callable $callback = null) {
        $this->_preorder($this->root, $callback);
    }

    private function _preorder($node, Callable $callback = null) {
        if($node === null) {
            return;
        }
        if($callback !== null) {
            call_user_func($callback, $node);
        }
        $this->_preorder($node->left, $callback);
        $this->_preorder($node->right, $callback);
    }

    /**
     * Traverse in inorder. This is: first visit the left subtree,
     * then the root and finally the right subtree.
     */
    public function inorder(Callable $callback = null) {
        $this->_inorder($this->root);
    }

    private function _inorder($node, Callable $callback = null) {
        if($node === null) {
            return;
        }

        $this->_inorder($node->left, $callback);
        if($callback !== null) {
            call_user_func($callback, $node);
        }
        $this->_inorder($node->right, $callback);
    }

    /**
     * Traverse in postorder. This is: first visit the left subtree,
     * then the right subtree and finally the root.
     */
    public function postorder(Callable $callback = null) {
        $this->_postorder($this->root, $callback);
    }

    private function _postorder($node, Callable $callback = null) {
        if($node === null) {
            return;
        }
        $this->_postorder($node->left, $callback);
        $this->_postorder($node->right, $callback);
        if($callback !== null) {
            call_user_func($callback, $node);
        }
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