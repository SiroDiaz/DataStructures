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
 */
class HashMap implements HashTableInterface, Countable {
    private $size;
    private $count;
    private $loadFactor;
    private $resize;
    private $hashTable;

    public function __construct($size=100, $loadFactor=0.75, $resize=2) {
        if($size <= 0) {
            throw new OutOfBoundsException('initial size must be greater than 0');
        }
        if($loadFactor <= 0 || $loadFactor > 1) {
            throw new OutOfBoundsException('Load factor must be 0 > loadFactor <= 1. Not recommended 1.');
        }
        if($resize <= 1) {
            throw new OutOfBoundsException('resize factor must be greater than 1.');
        }

        $this->loadFactor = $loadFactor;
        $this->resize = $resize;
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

    public function getHash($key) {
        $hash = 5381;

        foreach($key as $k) {
            $hash = (($hash << 5) + $hash) + $k;
        }

        return $hash;
    }

    private function getBucket($key) {
        return $this->getHash($key) % $this->size;
    }

    public function search($key) {

    }

    public function insert($key, $val) {

    }

    public function delete($key) {

    }

    public function clear() {

    }

    private function resize() {

    }

    public function count() {
        return $this->count;
    }
}