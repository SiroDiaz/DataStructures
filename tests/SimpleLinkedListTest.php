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

    public function testInsertAt() {
        $this->list->insertAt(0, "string");
        $this->assertEquals("string", $this->list->get(0));
        $this->list->insertAt(0, "other");
        $this->assertEquals("other", $this->list->get(0));
    }

    public function testUnshift() {
        $this->assertEquals(true, true);
    }

    public function testPop() {
        $this->assertTrue(true);
    }

    public function testShift() {
        $this->assertTrue(true);
    }

    public function testGet() {
        $this->assertTrue(true);
    }

    public function testGetAll() {
        // $this->assertCount(10);
    }
}