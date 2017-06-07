<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees;

use DataStructures\Trees\Interfaces\TreeInterface;
use DataStructures\Trees\Nodes\AVLNode as Node;

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
class AVLTree implements TreeInterface {
    public function empty() {

    }

    public function size() {

    }

    private function leftRotation() {

    }

    private function rightRotation() {

    }

    private function doubleRightRotation() {

    }

    private function doubleLeftRotation() {

    }

    public function put($key, $data) {

    }

    public function putOrUpdate($key, $data) {

    }

    public function get($key) {

    }

    public function getRoot() {

    }

    public function exists($key) {

    }

    public function floor($key) {

    }

    public function ceil($key) {

    }

    public function min() {

    }

    public function max() {

    }

    public function deleteMin() {

    }

    public function deleteMax() {

    }

    public function delete($key) {

    }

    public function search($key) {

    }

    public function isLeaf($node) {

    }

    public function isRoot($node) {

    }
}