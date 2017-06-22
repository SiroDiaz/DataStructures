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
        $aux = $node->right;
        $node->right = &$aux->left;
        $aux->left = $node;

        $node->height = 1 + max($node->left->height, $node->right->height);
        $aux->height = 1 + max($aux->right->height, $node->height);

        $node = &$aux;
    }

    /*  Does a right rotation.
     *    k2                       k1
     *  /  \                     /  \
     * X    k1         ==>      k2   Z
     *     /  \                /  \
     *    Y    Z              X    Y
     */
    private function leftRotation(AVLNode $node) {
       $aux = $node->left;
       $node->left = &$aux->right;
       $aux->right = $node;

       $node->height = 1 + max($node->left->height, $node->right->height);
       $aux->height = 1 + max($node->height, $aux->left->height);

       $node = &$aux;
    }

    /**
     * Double right rotation does first a left rotation of right child node
     * that detects the imbalance and finally does a right rotation
     * in the subtree root that detects the imbalance.
     */
    private function doubleRightRotation(AVLNode $node) {
        $this->leftRotation($node->right);
        $this->rightRotation($node);
    }

    /**
     * Double left rotation does first a right rotation of left child node
     * that detects the imbalance and finally does a left rotation
     * in the subtree root that detects the imbalance.
     */
    private function doubleLeftRotation(AVLNode $node) {
        $this->rightRotation($node->left);
        $this->leftRotation($node);
    }

    private function updateHeight(AVLNode &$node) {
        $leftHeight = ($node->left === null) ? -1 : $node->left->height;
        $rightHeight = ($node->right === null) ? -1 : $node->right->height;
    }
}