<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees;

use DataStructures\Trees\BinaryTreeAbstract;
use DataStructures\Trees\Nodes\AVLNode;

/**
 * AVLTree
 *
 * This class is an implementation of a AVL tree. It has as main feature that access,
 * insertion and deletion is O(log n). This is like a BST but it has a slightly difference
 * in nodes: contains a height attribute, used to detect when is needed to rebalance the
 * tree to keep the O(log n).
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class AVLTree extends BinaryTreeAbstract {
    
    /**
     * Creates a AVLNode.
     *
     * @param int|string $key the key used to store.
     * @param mixed $data the data.
     * @param DataStructures\Trees\Nodes\AVLNode|null $parent the parent node.
     * @param DataStructures\Trees\Nodes\AVLNode|null $left the left child node.
     * @param DataStructures\Trees\Nodes\AVLNode|null $right the right child node.
     *
     * @return DataStructures\Trees\Nodes\AVLNode the new node created.
     */
    public function createNode($key, $data, $parent = null, $left = null, $right = null) {
        return new AVLNode($key, $data, $parent, $left, $right);
    }

    /**
     * Does a right rotation.
     * 
     * @param DataStructures\Trees\Nodes\AVLNode $node The node to be
     * rotated.
     * @return DataStructures\Trees\Nodes\AVLNode
     */
    private function rightRotation(AVLNode &$node) {
        $temp = &$node->left;
        $temp->parent = &$node->parent;

        $node->left = &$temp->right;
        if ($node->left !== null) {
            $node->left->parent = &$node;
        }

        $temp->right = &$node;
        $node->parent = &$temp;

        // temp took over node's place so now its parent should point to temp
        if ($temp->parent !== null) {
            if ($node === $temp->parent->left) {
                $temp->parent->left = &$temp;
            } else {
                $temp->parent->right = &$temp;
            }
        } else {
            $this->root = &$temp;
        }
        
        return $temp;
    }

    /**
     * Does a right rotation.
     *
     * @param DataStructures\Trees\Nodes\AVLNode $node The node to be
     * rotated.
     * @return DataStructures\Trees\Nodes\AVLNode
     */
    private function leftRotation(AVLNode &$node) {

        $temp = &$node->right;
        $temp->parent = &$node->parent;

        $node->right = &$temp->left;

        if ($node->right !== null) {
            $node->right->parent = &$node;
        }

        $temp->left = &$node;
        $node->parent = &$temp;

        // temp took over node's place so now its parent should point to temp
        if ($temp->parent !== null) {
            if ($node == $temp->parent->left) {
                $temp->parent->left = &$temp;
            } else {
                $temp->parent->right = &$temp;
            }
        } else {
            $this->root = &$temp;
        }
        
        return $temp;
    }

    /**
     * Double right rotation does first a left rotation of right child node
     * that detects the imbalance and finally does a right rotation
     * in the subtree root that detects the imbalance.
     * Case Right-Left.
     *
     * @param DataStructures\Trees\Nodes\AVLNode $node The node to be
     * rotated.
     * @return DataStructures\Trees\Nodes\AVLNode
     */
    private function doubleRightRotation(AVLNode &$node) {
        $this->leftRotation($node->left);
        return $this->rightRotation($node);
    }

    /**
     * Double left rotation does first a right rotation of left child node
     * that detects the imbalance and finally does a left rotation
     * in the subtree root that detects the imbalance.
     * Case Left-Right.
     *
     * @param DataStructures\Trees\Nodes\AVLNode $node The node to be
     * rotated.
     * @return DataStructures\Trees\Nodes\AVLNode
     */
    private function doubleLeftRotation(AVLNode &$node) {
        $this->rightRotation($node->right);
        return $this->leftRotation($node);
    }

    /**
     * {@inheritDoc}
     */
    public function put($key, $data, $update = false) {
        $nodeInserted = parent::put($key, $data, $update);
        $this->rebalance($nodeInserted);

        return $nodeInserted;
    }

    /**
     * {@inheritDoc}
     */
    public function delete($key) {
        $nodeDelete = $this->search($key);
        if($nodeDelete !== null) {
            $successorNode = parent::delete($key);
            if($successorNode !== null) {
                $minimumNode = ($successorNode->right !== null) ?
                    $this->getMinNode($successorNode->right) : $successorNode;
                
                $this->recomputeHeight($minimumNode);
                $this->rebalance($minimumNode);
            } else {
                $this->recomputeHeight($nodeDelete->parent);
                $this->rebalance($nodeDelete->parent);
            }

            return $successorNode;
        }
        
        return null;
    }

    /**
     * Rebalance the tree if the difference of height is greater than 1
     * between the right and left subtree or reverse. Then it apply a rotation
     * depending on the type of unbalance.
     *
     * @param DataStructures\Trees\Nodes\AVLNode
     */
    private function rebalance(&$node) {
        while($node !== null) {
            $parent = &$node->parent;

            $leftHeight = ($node->left === null) ? 0 : $node->left->height;
            $rightHeight = ($node->right === null) ? 0 : $node->right->height;
            $nodeBalance = $rightHeight - $leftHeight;

            if($nodeBalance >= 2) {
                if($node->right->right !== null) {
                    $this->leftRotation($node);
                    return;
                } else {
                    $this->doubleLeftRotation($node);
                    return;
                }
            } else if($nodeBalance <= -2) {
                if($node->left->left !== null) {
                    $this->rightRotation($node);
                    return;
                } else {
                    $this->doubleRightRotation($node);
                    return;
                }
            } else {
                $this->adjustHeight($node);
            }

            $node = &$parent;
        }
    }

    /**
     * Recomputes the height of the nodes ascending in the tree.
     * 
     * @param DataStructures\Trees\Nodes\AVLNode
     */
    private function recomputeHeight($node) {
        while($node !== null) {
            $node->height = $this->maxHeight($node->left, $node->right) + 1;
            $node = &$node->parent;
        }
    }

    /**
     * Returns the maximum height between two subtrees.
     * 
     * @param DataStructures\Trees\Nodes\AVLNode|null
     * @param DataStructures\Trees\Nodes\AVLNode|null
     * @return int the maximum height
     */
    private function maxHeight($node1, $node2) {
        if($node1 !== null && $node2 !== null) {
            return $node1->height > $node2->height ? $node1->height : $node2->height;
        } else if($node1 === null) {
            return $node2 !== null ? $node2->height : 0;
        } else if($node2 === null) {
            return $node1 !== null ? $node1->height : 0;
        }

        return 0;
    }

    /**
     * Adjust the height of the node.
     * 
     * @param DataStructures\Trees\Nodes\AVLNode
     */
    private function adjustHeight(&$node) {
        $leftHeight = ($node->left === null) ? 0 : $node->left->height;
        $rightHeight = ($node->right === null) ? 0 : $node->right->height;
        
        $node->height = 1 + max($leftHeight, $rightHeight);
    }
}