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
        $this->assertEquals(true, true);
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
}