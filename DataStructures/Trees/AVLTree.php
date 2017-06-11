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

    private function rightRotation(AVLNode $node) {
        $tempParent = &$node->parent;
        $tempRight = &$node->right;
        $veryChildren = &$tempRight->left;

        if($tempParent === null) {
            $this->root = &$tempRight;
            $tempRight->parent = null;
        } else {
            $tempRight->parent = &$tempParent;
            if($tempRight->key < $tempParent->key) {
                $tempParent->left = &$tempRight;
            } else {
                $tempParent->right = &$tempRight;
            }
        }

        $parentRight->left = &$node;
        $node->parent = &$tempRight;
        $node->right = &$veryChildren;
    }

    private function leftRotation(AVLNode $node) {
        $tempParent = &$node->parent;
        $tempLeft = &$node->left;
        $veryChildren = &$tempLeft->right;

        if($tempParent === null) {
            $this->root = &$tempLeft;
            $tempLeft->parent = null;
        } else {
            $tempLeft->parent = &$tempParent;
            if($tempLeft->key < $tempParent->key) {
                $tempParent->left = &$tempLeft;
            } else {
                $tempParent->right = &$tempLeft;
            }
        }
    
        $tempLeft->right = &$node;
        $node->parent = &$tempLeft;
        $node->left = &$veryChildren;
    }

    private function doubleRightRotation(AVLNode $node) {
        $node->right = $this->rightRotation($node->right);
        return $this->leftRotation($node);
    }

    private function doubleLeftRotation(AVLNode $node) {
        $node->left = $this->leftRotation($node->left);
        return $this->rightRotation($node);
    }

    private function updateHeight(AVLNode &$node) {
        $leftHeight = ($node->left === null) ? -1 : $node->left->height;
        $rightHeight = ($node->right === null) ? -1 : $node->right->height;
    }
}