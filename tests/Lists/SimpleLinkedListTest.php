<?php

namespace DataStructures\Tests\Lists;

use DataStructures\Lists\SimpleLinkedList;
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
        $this->list->push(30);
        $this->assertEquals(30, $this->list->get(2));
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
        $this->list->push(20);
        $this->list->push(true);
        $this->list->push(15);
        $this->list->push(3.14);
        $this->list->push("string");

        $this->assertEquals("string", $this->list->pop());
        $this->assertEquals(3.14, $this->list->pop());
        $this->list->insert(1, ['hello']);
        $this->assertEquals(15, $this->list->pop());
        $this->assertTrue($this->list->pop());
        $this->assertSame($this->list->pop(), ['hello']);
        $this->assertSame($this->list->pop(), 20);
        $this->assertTrue($this->list->empty());
    }

    public function testUnshift() {
        $this->list->unshift(999);
        $this->assertEquals(1, $this->list->size());
        $this->assertEquals(999, $this->list->get(0));
        $this->list->unshift(888);
        $this->assertEquals(2, $this->list->size());
        $this->assertEquals(888, $this->list->get(0));
        $this->assertEquals(999, $this->list->get(1));
        $this->list->unshift(777);
        $this->assertEquals(3, $this->list->size());
        $this->assertEquals(777, $this->list->get(0));
        $this->assertEquals(888, $this->list->get(1));
        $this->assertEquals(999, $this->list->get(2));
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

    public function testIndexOf() {
        $this->assertFalse($this->list->indexOf(999));
        $this->list->unshift(999);
        $this->assertEquals(0, $this->list->indexOf(999));
        $this->list->unshift(888);
        $this->assertEquals(0, $this->list->indexOf(888));
        $this->assertEquals(1, $this->list->indexOf(999));
        $this->list->unshift(777);
        $this->assertEquals(0, $this->list->indexOf(777));
        $this->assertEquals(1, $this->list->indexOf(888));
        $this->assertEquals(2, $this->list->indexOf(999));
        $this->list->pop();
        $this->assertFalse($this->list->indexOf(999));
    }

    public function testLastIndexOf() {
        $this->assertFalse($this->list->lastIndexOf(999));
        $this->list->unshift(999);
        $this->assertEquals(0, $this->list->lastIndexOf(999));
        $this->list->unshift(888);

        $this->assertEquals(0, $this->list->lastIndexOf(888));
        $this->assertEquals(1, $this->list->lastIndexOf(999));
        $this->list->unshift(999);
        $this->assertFalse($this->list->lastIndexOf(777));
        $this->assertEquals(1, $this->list->lastIndexOf(888));
        $this->assertEquals(2, $this->list->lastIndexOf(999));
        $this->list->pop();
        $this->assertEquals(0, $this->list->lastIndexOf(999));
    }

    public function testRemove() {
        $this->assertNull($this->list->remove('string'));
        $this->list->push(3.14);
        $this->list->push(true);
        $this->list->push('string');
        $this->list->push(3.14);
        $this->assertEquals(3.14, $this->list->remove(3.14));
        $this->assertTrue($this->list->contains(3.14));
        $this->assertEquals(2, $this->list->indexOf(3.14));
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
}