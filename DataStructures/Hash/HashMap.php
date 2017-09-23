<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Hash;

use DataStructures\Hash\Interfaces\HashTableInterface;
use DataStructures\Trees\AVLTree;
use OutOfBoundsException;
use Countable;

/**
 * Separate Chaining (Open Hashing) is a type of hash table that has as main
 * feature a fast search, insertion and deletion in O(1) (when n/B is near to 0),
 * but when it increases its size operations take O(1+(n/B)) when 1 is the hash calculation
 * and n/B is the number of elements stored(n) in the hashmap divided by B (buckets).
 * 
 * Memory usage since it is an array pointing (not pointers i know, but understand it if you use languages
 * like C or C++) to an AVL tree it will take B * k1 + n * (2 * k1 + k2).
 */
class HashMap implements HashTableInterface, Countable {
    private $size;
    private $count;
    private $loadFactor;
    private $resize;
    private $defaultSize;
    private $hashTable;

    public function __construct($size=100, $loadFactor=0.75, $resize=2) {
        if($size <= 0) {
            throw new OutOfBoundsException('initial size must be greater than 0.');
        }
        if(is_float($size)) {
            throw new InvalidArgumentException('Size must be an integer.');
        }
        if($loadFactor <= 0 || $loadFactor > 1) {
            throw new OutOfBoundsException('Load factor must be 0 > loadFactor <= 1. Not recommended 1.');
        }
        if($resize <= 1) {
            throw new OutOfBoundsException('resize factor must be greater than 1.');
        }
        if(is_float($resize)) {
            throw new InvalidArgumentException('resize must be an integer.');
        }

        $this->loadFactor = $loadFactor;
        $this->resize = $resize;
        $this->defaultSize = $size;
        $this->size = $size;
        $this->count = 0;
        $this->hashTable = array_fill(0, $this->size, new AVLTree());
    }

    public function getLoadFactor() {
        return $this->loadFactor;
    }

    public function getSize() {
        return $this->size;
    }

    public function getCount() {
        return $this->count;
    }

    private function needsResize() {
        return $this->count >= $this->size * $this->loadFactor;
    }

    private function getHash($key) {
        $hash = 5381;

        for($i = 0; $i < mb_strlen($key); $i++) {
            $hash = (($hash << 5) + $hash) + ord(mb_substr($key, $i, 1));
        }

        return $hash;
    }

    private function getBucket($key) {
        return abs($this->getHash($key) % $this->size);
    }

    public function search($key) {
        $bucket = $this->getBucket($key);
        return $this->hashTable[$bucket]->get($key);
    }

    public function contains($key) : bool {
        $bucket = $this->getBucket($key);
        return $this->hashTable[$bucket]->exists($key);
    }

    public function insert($key, $val) {
        $bucket = $this->getBucket($key);
        $this->hashTable[$bucket]->put($key, $val, true);
        $this->count++;
        if($this->needsResize()) {
            $this->resize();
        }
    }

    public function delete($key) {
        $bucket = $this->getBucket($key);
        $deletedNode = $this->hashTable[$bucket]->delete($key);
        if($deletedNode !== null) {
            $this->count--;
            return $deletedNode->data;
        }

        return null;
    }

    public function clear() {
        $this->hashTable = [];
        $this->size = $this->defaultSize;
        $this->count = 0;
        $this->hashTable = array_fill(0, $this->size, new AVLTree());
    }

    private function resize() {
        $oldSize = $this->size;
        $this->size = $this->size * $this->resize;
        $oldTable = $this->hashTable;
        $this->hashTable = array_fill(0, $this->size, new AVLTree());
        for($bucket = 0; $bucket < $oldSize; $bucket++) {
            $tree = $oldTable[$bucket];
            $tree->preorder(function($node) {
                $newBucket = $this->getBucket($node->key);
                $this->hashTable[$newBucket]->put($node->key, $node->data);
            });
        }

        unset($oldTable);
    }

    public function count() {
        return $this->count;
    }
}