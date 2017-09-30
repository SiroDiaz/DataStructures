<?php

namespace DataStructures\Hash;

abstract class HashAbstract {
    protected $size;
    protected $count;
    protected $loadFactor;
    protected $resize;
    protected $defaultSize;

    /**
     * Returns the load factor.
     * 
     * @return float|int the load factor
     */
     public function getLoadFactor() {
        return $this->loadFactor;
    }

    /**
     * Returns the size of the hash table.
     * 
     * @return int the size
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * Returns the number of elements stored in the hash table.
     * 
     * @return int the total of elements stored in the hash table.
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * Checks if is necessary to resize the hash table.
     *
     * @return bool true if the length is over the load factor percent.
     */
    protected function needsResize() {
        return $this->count >= $this->size * $this->loadFactor;
    }
}
