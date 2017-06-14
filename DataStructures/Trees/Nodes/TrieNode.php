<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees\Nodes;

/**
 * TrieNode.
 *
 * The TrieNode class represents the trie node. It uses an array to store all
 * children nodes.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class TrieNode {
    public $char;
    public $isWord;
    public $children;

    public function __construct($char = '', $isWord = false) {
        $this->char = $char;
        $this->isWord = $isWord;
        $this->children = [];
    }

    public function hasChildren() {
        return count($this->children) > 0;
    }
}