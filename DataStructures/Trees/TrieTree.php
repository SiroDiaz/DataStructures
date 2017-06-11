<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees;

/**
 * TrieTree
 *
 * The TrieTree class is a trie (also called digital tree and sometimes radix tree or prefix tree)
 * that is used to get in O(m) being m the word length.
 * It is used in software like word corrector and word suggest.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class TrieTree implements Countable {
    private $root;
    private $numWords;
    private $size;
    
    public function __construct() {
        $this->root = null;
        $this->numWords = 0;
        $this->size = 0;
    }

    public function numWords() : int {
        return $this->numWords;
    }

    public function size() : int {
        return $this->size;
    }

    public function count() {
        return $this->size();
    }
}