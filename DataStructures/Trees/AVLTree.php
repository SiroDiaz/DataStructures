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
     * Example, rotate Y
     *    k2                   k1
     *   /  \                 /  \
     *  k1   Z     ==>       X   k2
     * / \                      /  \
     *X   Y                    Y    Z
     *
     */
    private function rightRotation(AVLNode $node) {
        $temp = &$node->left;

        if($node->parent !== null) {
            if($node->parent->right !== null) {
                $node->parent->right = &$temp;
            } else {
                $node->parent->left = &$temp;
            }
        }

        $temp->parent = &$node->parent;
        $node->parent = &$temp;
        $node->left = $temp->right;
        if($node->left !== null) {
            $node->left->parent = &$node;
        }
        $temp->right = &$node;

        $this->adjustHeight($node);
        $this->adjustHeight($temp);

        return $temp;
    }

    /*  Does a right rotation.
     *    k2                       k1
     *  /  \                     /  \
     * X    k1         ==>      k2   Z
     *     /  \                /  \
     *    Y    Z              X    Y
     */
    private function leftRotation(AVLNode $node) {
        $temp = &$node->right;
        if($node->parent !== null) {
            if($node->parent->right === $node) {
                $node->parent->right = &$node;
            } else {
                $node->parent->left = &$node;
            }
        }
        $temp->parent = &$node->parent;
        $node->parent = &$temp;
        $node->right = $temp->left;
        if($node->right !== null) {
            $node->right->parent = &$node;
        }
        $temp->left = &$node;

        $this->adjustHeight($node);
        $this->adjustHeight($temp);

        return $temp;
    }

    /**
     * Double right rotation does first a left rotation of right child node
     * that detects the imbalance and finally does a right rotation
     * in the subtree root that detects the imbalance.
     * Case Right-Left.
     */
    private function doubleRightRotation(AVLNode $node) {
        $this->leftRotation($node->right);
        $this->rightRotation($node);
    }

    /**
     * Double left rotation does first a right rotation of left child node
     * that detects the imbalance and finally does a left rotation
     * in the subtree root that detects the imbalance.
     * Case Left-Right.
     */
    private function doubleLeftRotation(AVLNode $node) {
        $this->rightRotation($node->left);
        $this->leftRotation($node);
    }

    public function put($key, $data, $update = false) {
        $nodeInserted = parent::put($key, $data, $update);
    }

    private function adjustHeight(AVLNode $node) {
        $node->height = 1 + max($node->left->height, $node->right->height);
    }
}