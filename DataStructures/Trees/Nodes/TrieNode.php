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

    /**
     * Returns if the node has children.
     *
     * @return bool true if there is one or more children.
     */
    public function hasChildren() : bool {
        return count($this->children) > 0;
    }

    /**
     * Returns if the node is leaf: it has not children nodes and
     * it is not root.
     *
     * @return bool true if is leaf.
     */
    public function isLeaf() : bool {
        return $this->parent !== null && $this->hasChildren() === false;
    }

    /**
     * Checks if is the node is root.
     *
     * @return bool true is it has not parent node.
     */
    public function isRoot() : bool {
        return $this->parent === null;
    }

    /**
     * Returns the number of children. Binds count().
     *
     * @return int The node count.
     */
    public function count() {
        return count($this->children);
    }
}