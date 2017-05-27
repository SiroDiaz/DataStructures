<?php

use DataStructures\SimpleLinkedList;
use PHPUnit\Framework\TestCase;

class SimpleLinkedListTest extends TestCase {
    private $list;

    public function setUp() {
        $this->list = new SimpleLinkedList();
    }

    public function testSize() {
        $this->assertEquals($this->list->size(), 0);
    }

    public function testEmpty() {
        $this->assertTrue($this->list->empty());
    }

    public function testPush() {
        $this->list->push(20);
        $this->assertEquals(1, $this->list->size());
        $this->assertEquals(20, $this->list->get(0));
        $this->list->push(true);
        $this->assertEquals(2, $this->list->size());
        $this->assertTrue($this->list->get(1));
    }

    public function testInsert() {
        $this->list->insert(0, 100);
        $this->assertEquals(100, $this->list->get(0));
        $this->assertEquals(1, $this->list->size());

        $this->list->insert(0, 200);
        $this->assertEquals(2, $this->list->size());
        $this->assertEquals(200, $this->list->get(0));
        $this->assertEquals(100, $this->list->get(1));

        $this->list->insert(1, 300);
        $this->assertEquals(3, $this->list->size());
        $this->assertEquals(200, $this->list->get(0));
        $this->assertEquals(300, $this->list->get(1));
        $this->assertEquals(100, $this->list->get(2));
        
        /*
        for($i = 0; $i < 100; $i++) {
            $this->list->insert($i, $i + 1);
            $this->assertEquals($i + 1, $this->list->get($i));
        }
        */
    }
    
    public function testDelete() {
        $this->assertNull($this->list->delete(10));
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        $this->assertEquals(3.14, $this->list->delete(3));
        $this->assertEquals(4, $this->list->size());
        $this->assertEquals(true, $this->list->delete(1));
        $this->assertEquals(false, $this->list->empty());
        $this->assertEquals(20, $this->list->delete(0));
    }

    public function testShift() {
        $this->assertNull($this->list->shift());
        $this->list->push(20);
        $this->list->push(true);
        $this->assertEquals(20, $this->list->shift());
        $this->assertEquals(1, $this->list->size());
        $this->assertEquals(true, $this->list->shift());
        $this->assertEquals(true, $this->list->empty());
        $this->assertNull($this->list->shift());
    }

    public function testPop() {
        $this->assertTrue(true);
    }

    public function testUnshift() {
        $this->assertTrue(true);
    }

    public function testGet() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        $this->assertTrue(true);
    }

    public function testGetAll() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        $data = [];
        foreach($this->list->getAll() as $node) {
            $data[] = $node;
        }
        $this->assertCount(5, $data);
        $this->assertSame([20, true, 15, 3.14, "string"], $data);
    }

    public function testToArray() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        $this->list->pop();
        $nodes = $this->list->toArray();
        $this->assertSame([20, true, 15, 3.14], $nodes);
    }
}