<?php

namespace DataStructures\Hash;

use DataStructures\Hash\Interfaces\HashTableInterface;

class HashTable {
    private $hashTable;

    public function __construct(HashTableInterface $strategy) {
        $this->hashTable = $strategy;
    }

    /**
     * Looks for the element stored in the hash table.
     * 
     * @param string $key. 
     */
    public function search($key) {
        return $this->hashTable->search($key);
    }
     
    /**
     * Checks if is contained an element by key and returns a boolean.
     *
     * @param string $key The key to look for.
     * @param bool true if is found, else false.
     */
    public function contains($key) : bool {
        return $this->hashTable->contains($key);
    }
 
    /**
     * Inserts a new pair key-value in the hash table.
     *
     * @param string $key.
     * @param mixed $val.
     */
    public function insert($key, $val) {
        $this->hashTable->insert($key, $val);
    }
     
    /**
     * Deletes an entry by key.
     *
     * @param string $key the key to delete.
     */
    public function delete($key) {
        return $this->hashTable->delete($key);
    }
     
    /**
     * Deletes all the content in the hash table and resets the size of it.
     */
    public function clear() {
        $this->hashTable->clear();
    }
}