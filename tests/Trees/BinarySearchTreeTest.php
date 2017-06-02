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
    }

    public function testEmpty() {
        $this->assertTrue($this->tree->empty());
        $this->tree->put(24, "Siro");
        $this->tree->put(19, "Clara");
        $this->tree->put(51, "Elisa");
        $this->assertFalse($this->tree->empty());
    }
}