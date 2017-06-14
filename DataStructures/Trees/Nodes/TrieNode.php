<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees\Nodes;

use Countable;

/**
 * TrieNode.
 *
 * The TrieNode class represents the trie node. It uses an array to store all
 * children nodes.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class TrieNode implements Countable {
    public $char;
    public $isWord;
    public $children;
    public $parent;

    public function __construct($char = '', &$parent = null, $isWord = false) {
        $this->char = $char;
        $this->isWord = $isWord;
        $this->children = [];
        $this->parent = &$parent;
    }

    public function hasChildren() : bool {
        return count($this->children) > 0;
    }

    public function isLeaf() : bool {
        return $this->parent !== null && $this->hasChildren() === 0;
    }

    public function isRoot() : bool {
        return $this->parent === null;
    }


    public function count() {
        return count($this->children);
    }
}