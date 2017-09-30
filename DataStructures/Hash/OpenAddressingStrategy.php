<?php

namespace DataStructures\Hash;

use DataStructures\Hash\Interfaces\HashTableInterface;
use DataStructures\Hash\HashAbstract;
use DataStructures\Hash\HashEntry;
use OutOfBoundsException;

class OpenAddressingStrategy extends HashAbstract implements HashTableInterface {
    
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
        $this->hashTable = array_fill(0, $this->size, null);
    }
    /**
     * DJB2 hash function implementation for PHP.
     * 
     * @param string $key The key to hash
     * @return int the hash result
     */
     private function getHash($key, $incr = 0) {
        $hash = 5381;

        for($i = 0; $i < mb_strlen($key); $i++) {
            $hash = (($hash << 5) + $hash) + ord(mb_substr($key, $i, 1));
        }

        return abs((abs($hash) + $incr) % $this->size);
    }

    /**
     * {@inheritDoc}
     */
    public function search($key) {
        $i = 0;
        $currentEntry = $this->hashTable[$this->getHash($key, $i)];
        while($currentEntry !== null) {
            if($currentEntry->getKey() === $key) {
                return $currentEntry->getValue();
            }

            if($currentEntry === null) {
                return null;
            }

            $currentEntry = $this->hashTable[$this->getHash($key, ++$i)];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function contains($key) : bool {
        $i = 0;
        $currentEntry = $this->hashTable[$this->getHash($key, $i)];
        while($currentEntry !== null) {
            if($currentEntry->getKey() === $key) {
                return true;
            }

            $currentEntry = $this->hashTable[$this->getHash($key, ++$i)];
        }

        return false;
    }
 
    /**
     * {@inheritDoc}
     */
    public function insert($key, $val) {
        $i = 0;
        $index = $this->getHash($key, $i);

        if($this->hashTable[$index] === null) {
            $entry = new HashEntry($key, $val);
            $this->hashTable[$index] = $entry;
            $this->count++;
        } else {
            while($this->hashTable[$index] !== null) {
                if($this->hashTable[$index]->getKey() === $key) {
                    $this->hashTable[$index] = new HashEntry($key, $val);
                    return;
                }
                $index = $this->getHash($key, ++$i);
            }
    
            if($this->hashTable[$index] === null) {
                $entry = new HashEntry($key, $val);
                $this->hashTable[$index] = $entry;
                $this->count++;
            }
        }
        

        if($this->needsResize()) {
            $this->resize();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function delete($key) {
        $i = 0;
        $index = $this->getHash($key, $i);
        while($this->hashTable[$index] !== null && $key !== $this->hashTable[$index]->getKey()) {
            $index = $this->getHash($key, ++$i);
        }

        if($this->hashTable[$index] !== null && $key === $this->hashTable[$index]->getKey()) {
            $deletedEntry = $this->hashTable[$index];
            $this->hashTable[$index] = null;
            $this->count--;
            
            // set the current index as null and start moving the next element to previous
            // position.
            
            while($this->hashTable[++$index % $this->size] !== null) {
                $i = 0;
                $newIndex = $this->getHash($this->hashTable[$index]->getKey(), $i);
                while($this->hashTable[$newIndex] !== null) {
                    $newIndex = $this->getHash($this->hashTable[$index]->getKey(), ++$i);
                }
                $this->hashTable[$newIndex] = $this->hashTable[$index];
                $this->hashTable[$index] = null;
            }
            
            return $deletedEntry->getValue();
        }

        return null;
    }
     
    /**
     * {@inheritDoc}
     */
    public function clear() {
        $this->size = $this->defaultSize;
        $this->hashTable = array_fill(0, $this->size, null);
        $this->count = 0;
    }
    
    /**
     *
     */
    private function resize() {
        $oldSize = $this->size;
        $this->size = $this->size * $this->resize;
        $oldTable = $this->hashTable;
        $this->hashTable = array_fill(0, $this->size, null);
        
        for($bucket = 0; $bucket < $oldSize; $bucket++) {
            $entry = $oldTable[$bucket];
            if($entry !== null) {
                $i = 0;
                $index = $this->getHash($entry->getKey(), $i);
                while($this->hashTable[$index] !== null) {
                    if($this->hashTable[$index]->getKey() === $entry->getKey()) {
                        break;
                    }
                    $index = $this->getHash($entry->getKey(), ++$i);
                }
                
                if($this->hashTable[$index] === null) {
                    $this->hashTable[$index] = $entry;
                } else if($this->hashTable[$index]->getKey() !== $entry->getKey()) {
                    $this->hashTable[$index] = $entry;
                }
            }
        }

        unset($oldTable);
    }
}
