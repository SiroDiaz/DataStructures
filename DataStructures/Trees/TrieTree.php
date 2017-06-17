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
                    $current->children[$char] = new TrieNode($char, $current, true);
                    $this->numWords++;
                } else {
                    $current->children[$char] = new TrieNode($char, $current, false);
                }
                $this->size++;
            } else {
                if($i === mb_strlen($word) - 1) {
                    if($current->children[$char]->isWord === false) {
                        $current->children[$char]->isWord = true;
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

    /**
     * Removes a word from the tree.
     *
     * @param string $word the word to delete if it is contained in the trie.
     */
    public function delete($word) {
        $wordLength = mb_strlen($word);
        $i = 0;
        $current = $this->root;
        
        while($i < $wordLength) {
            if($current->hasChildren()) {
                $char = mb_substr($word, $i, 1, 'UTF-8');
                if(isset($current->children[$char])) {
                    $node = &$current->children[$char];
                    if(($i === $wordLength - 1) && $node->isWord) {
                        if($node->hasChildren()) {
                            $node->isWord = false;
                        } else {
                            $parentNode = &$node->parent;
                            unset($parentNode->children[$char]);
                            $this->size--;
                            $j = $i - 1;

                            while($j >= 0 && $parentNode->isLeaf() && !$parentNode->isWord) {
                                $char = mb_substr($word, $j, 1, 'UTF-8');
                                $parentNode = &$parentNode->parent;
                                unset($parentNode->children[$char]);
                                $this->size--;
                                $j--;
                            }
                        }

                        $this->numWords--;
                    }
                }
            } else {
                return;
            }

            if(isset($current->children[$char])) {
                $current = $current->children[$char];
            } else {
                $current = $current->parent;    //TODO need to delete all leaf nodes
            }
            $i++;
        }
    }

    /**
     * Removes all nodes (and words) in the tree and resets the size
     * and word count.
     */
    public function clear() {
        foreach($this->root->children as $key => &$node) {
            $this->_clear($node);
            unset($this->root->children[$key]);
        }

        $this->size = 0;
        $this->numWords = 0;
    }

    /**
     * Recursive clear that removes all nodes, included leaf, except
     * the references to the first children.
     *
     * @param DataStructures\Trees\Nodes\TrieNode|null the node to traverse.
     * @return DataStructures\Trees\Nodes\TrieNode|null the next node to delete.
     */
    private function _clear(TrieNode &$node = null) {
        foreach($node->children as $char => &$n) {
            $aux = $node->children[$char];
            unset($node->children[$char]);
            $node = null;
            return $this->_clear($aux);
        }
    }

    /**
     * Returns an array containing all words stored in the tree.
     * It starts to search from the root that contains an empty string
     * using the withPrefix method.
     *
     * @return array an empty array if there are not words in the tree.
     */
    public function getWords() : array {
        if($this->size === 0) {
            return [];
        }

        return $this->withPrefix('');
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
     * Returns an array with all words that has the especified prefix.
     * For example, with prefix 'he' it will retrieve: hell, hello, ....
     *
     * @param string $prefix The prefix that must have all words.
     * @return array All words that contains the prefix.
     */
    public function withPrefix($prefix) : array {
        $node = $this->getNodeFromPrefix($prefix);
        $words = [];
        if($node !== null) {
            if($node->isWord) {
                $words[] = $prefix;
            }
            foreach($node->children as $char => $n) {
                $words = $this->_traverseWithPrefix($node->children[$char], $words, $prefix . $char);
            }
        }

        return $words;
    }

    /**
     *
     */
    private function _traverseWithPrefix(TrieNode $node = null, $words = [], $word) {
        if($node->isWord) {
            $words[] = $word;
        }

        if(empty($node->children)) {
            return $words;
        }

        foreach($node->children as $char => &$n) {
            $words = $this->_traverseWithPrefix($node->children[$char], $words, $word . $char);
        }

        return $words;
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