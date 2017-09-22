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
        $this->hashmap = new HashMap(2);
        $this->hashmap->insert('a', 'All');
        $this->hashmap->insert('ax', 'Axon');
        $this->assertEquals($this->hashmap->getSize(), 4);
        $this->hashmap->insert('b', 'Before');
        $this->assertEquals($this->hashmap->getSize(), 8);
        $this->hashmap->insert('c', 'Class');
        $this->hashmap->insert('d', 'Dig');
        $this->hashmap->insert('hello_world', 'Hello World!');
        $this->assertEquals($this->hashmap->getSize(), 16);
        $this->assertEquals($this->hashmap->search('a'), 'All');
        $this->assertEquals($this->hashmap->search('ax'), 'Axon');
        $this->assertEquals($this->hashmap->search('b'), 'Before');
        $this->assertEquals($this->hashmap->search('c'), 'Class');
        $this->assertEquals($this->hashmap->search('d'), 'Dig');
        $this->assertEquals($this->hashmap->search('hello_world'), 'Hello World!');
    }
        
    public function testDelete() {
        $this->hashmap = new HashMap(5);
        $this->hashmap->insert('a', 'All');
        $this->hashmap->insert('ax', 'Axon');
        $this->hashmap->insert('b', 'Before');
        $this->hashmap->insert('c', 'Class');
        $this->hashmap->insert('d', 'Dig');
        $this->hashmap->insert('hello_world', 'Hello World!');
        $this->assertEquals($this->hashmap->delete('d'), 'Dig');
        $this->assertEquals($this->hashmap->getCount(), 5);
        $this->assertEquals($this->hashmap->delete('c'), 'Class');
        $this->assertEquals($this->hashmap->getCount(), 4);

        $this->assertEquals($this->hashmap->delete('b'), 'Before');
        $this->assertEquals($this->hashmap->getCount(), 3);
        $this->assertEquals($this->hashmap->delete('ax'), 'Axon');
        $this->assertEquals($this->hashmap->getCount(), 2);
        $this->assertEquals($this->hashmap->delete('a'), 'All');
        $this->assertEquals($this->hashmap->getCount(), 1);
        $this->assertEquals($this->hashmap->delete('hello_world'), 'Hello World!');
        $this->assertEquals($this->hashmap->getCount(), 0);
    }
        
    public function testClear() {
        $this->hashmap = new HashMap(5);
        $this->hashmap->insert('a', 'All');
        $this->hashmap->insert('ax', 'Axon');
        $this->hashmap->insert('b', 'Before');
        $this->hashmap->insert('c', 'Class');
        $this->hashmap->insert('d', 'Dig');
        $this->hashmap->insert('hello_world', 'Hello World!');
        $this->hashmap->clear();
        $this->assertEquals($this->hashmap->getCount(), 0);
        $this->assertEquals($this->hashmap->getSize(), 5);
    }
}