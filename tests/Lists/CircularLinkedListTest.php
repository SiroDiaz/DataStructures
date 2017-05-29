<?php

use DataStructures\Lists\CircularLinkedList;
use PHPUnit\Framework\TestCase;

class CircularLinkedListTest extends TestCase {
    private $list;

    public function setUp() {
        $this->list = new CircularLinkedList();
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
        
        $this->list->push(30);
        // echo $this->list->get(0) . $this->list->get(1) . $this->list->get(2) . PHP_EOL;
        $this->assertEquals(20, $this->list->get(0));
        $this->assertEquals(30, $this->list->get(1));
        $this->assertEquals(true, $this->list->get(2));
    }
    
    public function testGetLast() {
        $this->assertNull($this->list->getLast());
        $this->list->push(true);
        $this->list->push(50);
        $this->list->push("string");
        $this->assertEquals("string", $this->list->getLast());
    }

    public function testInsert() {
        $this->list->insert(0, 100);
        $this->assertEquals(100, $this->list->get(0));
        $this->assertEquals(1, $this->list->size());
        
        $this->list->insert(0, 200);
        $this->assertEquals(2, $this->list->size());
        $this->assertEquals(200, $this->list->get(0));
        $this->assertEquals(100, $this->list->get(1));
        $this->assertEquals($this->list->getLast(), 100);
        
        $this->list->insert(1, 300);
        $this->assertEquals(3, $this->list->size());
        $this->assertEquals(200, $this->list->get(0));
        $this->assertEquals(300, $this->list->get(1));
        $this->assertEquals(100, $this->list->get(2));
        $this->list->insert(2, 1000);
        $this->assertEquals($this->list->get(2), 1000);
        $this->assertEquals($this->list->get(3), 100);
    }
    
    /*
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
    */

    public function testUnshift() {
        $this->list->unshift(999);
        $this->assertEquals(1, $this->list->size());
        $this->assertEquals(999, $this->list->get(0));
        $this->assertEquals($this->list->getLast(), 999);
        $this->list->unshift(888);
        $this->assertEquals(2, $this->list->size());
        $this->assertEquals(888, $this->list->get(0));
        $this->assertEquals(999, $this->list->get(1));
        $this->assertEquals($this->list->getLast(), 999);
        $this->list->unshift(777);
        $this->assertEquals(3, $this->list->size());
        $this->assertEquals(777, $this->list->get(0));
        $this->assertEquals(888, $this->list->get(1));
        $this->assertEquals(999, $this->list->get(2));
        $this->assertEquals($this->list->getLast(), 999);
    }
    
    public function testGet() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        $this->assertEquals($this->list->get(0), 20);
        $this->assertTrue($this->list->get(1));
        $this->assertEquals($this->list->get(2), 15);
        $this->assertEquals($this->list->get(3), 3.14);
        $this->assertEquals($this->list->get(4), "string");
    }

    public function testGetWithException() {
        $this->expectException(OutOfBoundsException::class);
        $this->list->get(5);
    }

    public function testGetOutOfBound() {
        $this->expectException(OutOfBoundsException::class);
        $this->list->get(-1);
    }

    /*
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
    */
}