<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees;

use DataStructures\Trees\Nodes\TrieNode;
use Countable;

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
        $this->root = new TrieNode();
        $this->numWords = 0;
        $this->size = 0;
    }

    /**
     * Returns the number of words stored in the trie.
     *
     * @return int the number of words.
     */
    public function numWords() : int {
        return $this->numWords;
    }

    /**
     * Returns true if the tree is empty. Number of prefixes is 0.
     *
     * @return bool true if empty.
     */
    public function empty() : bool {
        return $this->size === 0;
    }

    /**
     * Returns the number of prefixes that are contained in the trie.
     *
     * @return int the num of prefixes.
     */
    public function size() : int {
        return $this->size;
    }

    /**
     * Inserts a new word in the tree. If the word exists it doesn't do nothing.
     *
     * @param string $word the word to be added.
     */
    public function add($word) {
        $word = trim($word);
        if(mb_strlen($word) === 0) {
            return;
        }

        $current = &$this->root;
        for($i = 0; $i < mb_strlen($word); $i++) {
            $char = mb_substr($word, $i, 1, 'UTF-8');
            if(!isset($current->children[$char])) {
                if($i === mb_strlen($word) - 1) {
                    $current->children[$char] = new TrieNode($char, true);
                    $current->isWord = true;
                    $this->numWords++;
                } else {
                    $current->children[$char] = new TrieNode($char, false);
                }
                $this->size++;
            } else {
                if($i === mb_strlen($word) - 1) {
                    if($current->isWord === false) {
                        $current->isWord = true;
                        $this->numWords++;
                    }
                }
            }

            $current = &$current->children[$char];
        }
    }

    /**
     * Returns true if the word is stored in the tree.
     *
     * @param string $word The word to check if exists.
     * @param bool true if is contained.
     */
    public function contains($word) : bool {
        $word = trim($word);
        $wordLength = mb_strlen($word);
        if($wordLength === 0) {
            return true;
        }

        $i = 0;
        $found = true;
        $current = $this->root;
        while($found && $i < $wordLength) {
            $char = mb_substr($word, $i, 1);
            if(isset($current->children[$char])) {
                $current = $current->children[$char];
            } else {
                $found = false;
            }
            $i++;
        }

        if($found && $current->isWord) {
            return true;
        }

        return false;
    }

    public function getWords() : array {
        return [];
    }

    /**
     * Checks if there is any word that starts with a concrete prefix.
     *
     * @param string $prefix The prefix to look up.
     * @return true if there are words that start with the especified prefix.
     */
    public function startsWith($prefix) : bool {
        return $this->getNodeFromPrefix($prefix) !== null;
    }

    /**
     * Retrieves the node where ends the prefix especified.
     *
     * @param string $prefix The prefix to look for.
     * @return DataStructures\Trees\Nodes\TrieNode|null null if not found.
     */
    private function getNodeFromPrefix($prefix) {
        if($this->size === 0) {
            return null;
        }
        
        $i = 0;
        $current = $this->root;
        $prefixLength = mb_strlen(trim($prefix));
        while($i < $prefixLength) {
            $char = mb_substr($prefix, $i, 1, 'UTF-8');
            if(!isset($current->children[$char])) {
                return null;
            }
            $current = $current->children[$char];
            $i++;
        }

        return $current;
    }

    /**
     * Gets the number of words stored in the tree.
     *
     * @return int The word count.
     */
    public function wordCount() : int {
        return $this->numWords;
    }

    /**
     * Gets the number of prefixes stored in the tree.
     *
     * @return int The word count.
     */
    public function count() : int {
        return $this->size();
    }
}