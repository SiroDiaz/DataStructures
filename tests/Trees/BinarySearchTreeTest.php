<?php

use DataStructures\Trees\BinarySearchTree;
use PHPUnit\Framework\TestCase;

class BinarySearchTreeTest extends TestCase {
    private $tree;

    public function setUp() {
        $this->tree = new BinarySearchTree();
    }

    public function testPut() {
        $this->tree->put(24, "Siro");
        $this->tree->put(19, "Clara");
        $this->tree->put(51, "Elisa");
        $this->assertEquals(3, $this->tree->size());
        $this->assertEquals("Siro", $this->tree->get(24));
        $this->assertEquals("Clara", $this->tree->get(19));
        $this->assertEquals("Elisa", $this->tree->get(51));
        $this->assertNull($this->tree->get(100));
    }

    public function testPutWithUpdate() {
        $this->tree->put(24, "Siro");
        $this->tree->put(19, "Clara");
        $this->tree->put(51, "Elisa");
        $this->assertEquals(3, $this->tree->size());
        $this->tree->put(51, "Pepe", true);
        $this->tree->put(24, "John", true);
        $this->assertEquals("John", $this->tree->get(24));
        $this->assertEquals("Clara", $this->tree->get(19));
        $this->assertEquals("Pepe", $this->tree->get(51));
    }

    public function testPutOrUpdate() {
        $this->tree->put(24, "Siro");
        $this->tree->put(19, "Clara");
        $this->tree->put(51, "Elisa");
        $this->assertEquals(3, $this->tree->size());
        $this->tree->putOrUpdate(24, "John", true);
        $this->assertEquals(3, $this->tree->size());
        $this->tree->putOrUpdate(34, "Ana");
        $this->assertEquals(4, $this->tree->size());
        $this->assertEquals("John", $this->tree->get(24));
        $this->assertEquals("Clara", $this->tree->get(19));
        $this->assertEquals("Elisa", $this->tree->get(51));
        $this->assertEquals("Ana", $this->tree->get(34));
    }

    public function testEmpty() {
        $this->assertTrue($this->tree->empty());
        $this->tree->put(24, "Siro");
        $this->tree->put(19, "Clara");
        $this->tree->put(51, "Elisa");
        $this->assertFalse($this->tree->empty());
    }

    public function testSize() {
        $this->assertEquals(0, $this->tree->size());
        $this->tree->put(24, "Siro");
        $this->assertEquals(1, $this->tree->size());
        $this->tree->put(19, "Clara");
        $this->assertEquals(2, $this->tree->size());
        $this->tree->put(51, "Elisa");
        $this->assertEquals(3, $this->tree->size());
    }

    public function testExists() {
        $this->assertFalse($this->tree->exists("greet"));
        $this->tree->put("greet", "saludo");
        $this->tree->put("tree", "árbol");
        $this->tree->put("water", "agua");
        $this->assertTrue($this->tree->exists("greet"));
        $this->assertTrue($this->tree->exists("tree"));
        $this->assertTrue($this->tree->exists("water"));
        $this->assertFalse($this->tree->exists("sun"));
    }

    public function testSearch() {
        $this->tree->put("greet", "saludo");
        $this->tree->put("tree", "árbol");
        $this->tree->put("water", "agua");
        $this->assertEquals("greet", $this->tree->search("greet")->key);
        $this->assertEquals("árbol", $this->tree->search("tree")->data);
        $this->assertEquals("water", $this->tree->search("water")->key);
        $this->assertNull($this->tree->search(100));
    }

    public function testGetMin() {
        $this->tree->put(2, "two");
        $this->tree->put(3, "three");
        $this->assertEquals(2, $this->tree->getMin()->key);
        $this->tree->put(1, "one");
        $this->assertEquals(1, $this->tree->getMin()->key);
    }

    public function testGetMax() {
        $this->tree->put(1, "one");
        $this->assertEquals(1, $this->tree->getMax()->key);
        $this->tree->put(2, "two");
        $this->assertEquals(2, $this->tree->getMax()->key);
        $this->tree->put(3, "three");
        $this->assertEquals(3, $this->tree->getMax()->key);
    }
}