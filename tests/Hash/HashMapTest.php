<?php

namespace DataStructures\Tests\Hash;

use DataStructures\Hash\HashMap;
use PHPUnit\Framework\TestCase;

class HashMapTest extends TestCase {
    private $hashmap;

    // Constructor tests
    public function testFailLoadFactorHigherThan1() {
        $this->expectException(\OutOfBoundsException::class);
        $this->hashmap = new HashMap(5, 1.2);
    }

    public function testFailLoadFactorLowerOrEqualTo0() {
        $this->expectException(\OutOfBoundsException::class);
        $this->hashmap = new HashMap(5, 0);
    }

    public function testFailResizeFactor() {
        $this->expectException(\OutOfBoundsException::class);
        $this->hashmap = new HashMap(5, 0, 1);
    }

    // Getters tests
    public function testGetLoadFactor() {
        $this->hashmap = new HashMap();
        $this->assertEquals($this->hashmap->getLoadFactor(), 0.75);
        $this->hashmap = new HashMap(5, 0.5);
        $this->assertEquals($this->hashmap->getLoadFactor(), 0.5);
    }

    // Functionality methods tests
    public function testSearch() {
        $this->hashmap = new HashMap(5);
    }
        
    public function testInsert() {
        $this->hashmap = new HashMap(5);
    }
        
    public function testDelete() {
        $this->hashmap = new HashMap(5);
    }
        
    public function testClear() {
        $this->hashmap = new HashMap(5);
    }
}