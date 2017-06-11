<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees;

use DataStructures\Trees\BinarySearchTree;

/**
 * TrieNode.
 *
 * The TrieNode class represents the trie node. It uses a BST to store all children
 * nodes in worst case of O(n).
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class TrieNode {
    public $char;
    public $isWord;
    public $children;
    public $size;

    public function __construct($char = '', $isWord = false) {
        $this->char = $char;
        $this->isWord = $isWord;
        $this->children = new BinarySearchTree();
        $this->size = 0;
    }
}