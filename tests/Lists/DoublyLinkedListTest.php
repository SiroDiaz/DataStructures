<?php

namespace DataStructures\Tests\Lists;

use DataStructures\Lists\DoublyLinkedList;
use PHPUnit\Framework\TestCase;

class DoublyLinkedListTest extends TestCase {
    private $list;

    public function setUp() {
        $this->list = new DoublyLinkedList();
    }

    public function testSize() {
        $this->assertEquals($this->list->size(), 0);
        $this->list->push(true);
        $this->list->push(2);
        $this->assertEquals($this->list->size(), 2);
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
        $this->assertEquals(100, $this->list->getLast());
        
        $this->list->insert(1, 300);
        $this->assertEquals(3, $this->list->size());
        $this->assertEquals(200, $this->list->get(0));
        $this->assertEquals(300, $this->list->get(1));
        $this->assertEquals(100, $this->list->get(2));
        $this->list->insert(2, 1000);
        $this->assertEquals(1000, $this->list->get(2));
        $this->assertEquals(100, $this->list->get(3));
        $this->list->insert(6, true);
        $this->assertTrue($this->list->get(4));
        $this->assertEquals(5, $this->list->size());
    }
    
    public function testDeleteException() {
        $this->expectException(\OutOfBoundsException::class);
        $this->list->delete(10);
    }
    
    public function testDelete() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        
        $this->assertEquals($this->list->delete(4), "string");
        $this->assertEquals(3.14, $this->list->delete(3));
        
        $this->assertEquals(3, $this->list->size());
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
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        
        $this->assertEquals($this->list->pop(), "string");
        $this->assertEquals(3.14, $this->list->pop());
        $this->list->insert(1, ['hello']);
        $this->assertEquals(15, $this->list->pop());
        $this->assertTrue($this->list->pop());
        $this->assertSame($this->list->pop(), ['hello']);
        $this->assertSame($this->list->pop(), 20);
        $this->assertTrue($this->list->empty());
    }
    
    public function testPopException() {
        $this->expectException(\OutOfBoundsException::class);
        $this->list->pop();
    }
    
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
        $this->expectException(\OutOfBoundsException::class);
        $this->list->get(5);
    }

    public function testGetOutOfBound() {
        $this->expectException(\OutOfBoundsException::class);
        $this->list->get(-1);
    }
    
    public function testGetAll() {
        foreach($this->list->getAll() as $node) {
            $this->assertNull($node);
        }
        
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
    
    public function testClear() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        $this->list->clear();
        $this->assertEmpty($this->list->toArray());
        $this->assertEquals($this->list->size(), 0);
    }

    public function testGetAsArray() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        $this->assertEquals(20, $this->list[0]);
        $this->assertEquals(true, $this->list[1]);
        $this->assertEquals(15, $this->list[2]);
        $this->assertEquals(3.14, $this->list[3]);
        $this->assertEquals('string', $this->list[4]);
    }

    public function testOffsetUnset() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");
        unset($this->list[0]);
        unset($this->list[1]);
        unset($this->list[1]);
        unset($this->list[1]);
        unset($this->list[0]);
        $this->assertEquals(0, $this->list->size());
    }

    public function testContains() {
        $this->assertFalse($this->list->contains(999));
        $this->list->unshift(999);
        $this->assertTrue($this->list->contains(999));
        $this->list->unshift(888);
        $this->assertTrue($this->list->contains(888));
        $this->list->unshift(777);
        $this->assertTrue($this->list->contains(777));
        $this->list->pop();
        $this->assertFalse($this->list->contains(999));
    }

    public function testIsset() {
        $this->list->push(20);
        $this->list->push(true);
        $this->assertTrue(isset($this->list[0]));
        $this->assertTrue(isset($this->list[1]));
        $this->assertFalse(isset($this->list[2]));
    }

    public function testOffsetSet() {
        $this->list->push(20);
        $this->list[1] = 30;
        $this->list[] = 40;
        $this->list[] = 'string';
        $this->assertEquals(4, $this->list->size());
    }

    public function testIterator() {
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");

        $this->list->shift();
        $expectedResult = [];
        $result = [];
        foreach($this->list->getAll() as $node) {
            $expectedResult[] = $node;
        }
        foreach($this->list as $index => $val) {
            $result[] = $val;
        }

        $this->assertSame($expectedResult, $result);
    }
}