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

    public function testMin() {
        $this->tree->put(2, "two");
        $this->tree->put(3, "three");
        $this->assertEquals(2, $this->tree->min()->key);
        $this->tree->put(1, "one");
        $this->assertEquals(1, $this->tree->min()->key);
    }
    
    public function testMax() {
        $this->tree->put(1, "one");
        $this->assertEquals(1, $this->tree->max()->key);
        $this->tree->put(2, "two");
        $this->assertEquals(2, $this->tree->max()->key);
        $this->tree->put(3, "three");
        $this->assertEquals(3, $this->tree->max()->key);
    }

    public function testDelete() {
        $this->tree->put(1, "one");
        $this->tree->put(2, "two");
        $this->tree->put(3, "three");
        $this->assertEquals(1, $this->tree->delete(1)->key);
        $this->assertEquals(2, $this->tree->size());
        $this->assertEquals("three", $this->tree->delete(3)->data);
        $this->assertEquals(1, $this->tree->size());
        $this->assertEquals(2, $this->tree->delete(2)->key);
        $this->assertEquals(0, $this->tree->size());
        $this->assertNull($this->tree->delete(2));
        $this->assertTrue($this->tree->empty());
    }

    public function testDeleteMin() {
        $this->tree->put(1, "one");
        $this->tree->put(2, "two");
        $this->tree->put(3, "three");
        $this->assertEquals(1, $this->tree->deleteMin()->key);
        $this->assertEquals(2, $this->tree->size());
        $this->assertEquals(2, $this->tree->deleteMin()->key);
        $this->assertEquals(1, $this->tree->size());
        $this->tree->put(100, "hundred");
        $this->assertEquals(2, $this->tree->size());
        $this->assertEquals(3, $this->tree->deleteMin()->key);
        $this->assertEquals(1, $this->tree->size());
        $this->assertEquals(100, $this->tree->deleteMin()->key);
        $this->assertEquals(0, $this->tree->size());
    }

    public function testDeleteMax() {
        $this->tree->put(1, "one");
        $this->tree->put(2, "two");
        $this->tree->put(3, "three");
        $this->assertEquals(3, $this->tree->deleteMax()->key);
        $this->assertEquals(2, $this->tree->size());
        $this->assertEquals(2, $this->tree->deleteMax()->key);
        $this->assertEquals(1, $this->tree->size());
        $this->tree->put(100, "hundred");
        $this->assertEquals(2, $this->tree->size());
        $this->assertEquals(100, $this->tree->deleteMax()->key);
        $this->assertEquals(1, $this->tree->size());
        $this->assertEquals(1, $this->tree->deleteMax()->key);
        $this->assertEquals(0, $this->tree->size());
    }

    public function testPreorder() {
        $this->tree->put(2, "two");
        $this->tree->put(1, "one");
        $this->tree->put(3, "three");
        $this->tree->preorder(function ($node) {
            // do something with the node
            // echo $node->key . PHP_EOL;
        });
        $this->assertTrue(true);
    }

    public function testInorder() {
        $this->tree->put(2, "two");
        $this->tree->put(1, "one");
        $this->tree->put(3, "three");
        $this->tree->inorder(function ($node) {
            // do something with the node
            // echo $node->key . PHP_EOL;
        });
        $this->assertTrue(true);
    }

    public function testPostorder() {
        $this->tree->put(2, "two");
        $this->tree->put(1, "one");
        $this->tree->put(3, "three");
        $this->tree->postorder(function ($node) {
            // do something with the node
            // echo $node->key . PHP_EOL;
        });
        $this->assertTrue(true);
    }

    public function testIsLeaf() {
        $this->tree->put(2, "two");
        $this->tree->put(1, "one");
        $this->tree->put(3, "three");

        $this->assertTrue($this->tree->isLeaf($this->tree->search(3)));
        $this->assertFalse($this->tree->isLeaf($this->tree->search(2)));
        $this->assertTrue($this->tree->isLeaf($this->tree->search(1)));
    }

    public function testIsRoot() {
        $this->tree->put(2, "two");
        $this->tree->put(1, "one");
        $this->tree->put(3, "three");

        $this->assertTrue($this->tree->isRoot($this->tree->search(2)));
        $this->assertFalse($this->tree->isRoot($this->tree->search(3)));
        $this->assertFalse($this->tree->isRoot($this->tree->search(1)));
    }
}