<?php

use DataStructures\Lists\Stack;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase {
    private $stack;

    public function setUp() {
        // $this->stack = new Stack();
    }

    public function testContructMaxSize() {
        $this->expectException(InvalidArgumentException::class);
        $this->stack = new Stack(-1);
    }
    
    /*
    public function testEnqueueWithMaxSize() {
        $this->stack = new Stack(5);
        $this->stack->push(1);
        $this->assertEquals($this->stack->peek(), 1);
        $this->stack->push(2);
        $this->assertEquals($this->stack->peek(), 1);
        $this->stack->push(3);
        $this->assertEquals($this->stack->peek(), 1);
        $this->stack->push(4);
        $this->stack->push(5);
        $this->expectException(FullException::class);
        $this->stack->push(6);
    }

    public function testEnqueue() {
        $this->stack = new Stack();
        $this->stack->push(1);
        $this->stack->push(2);
        $this->stack->push(3);
        $this->stack->push(4);
        $this->stack->push(5);
        $this->assertEquals($this->stack->size(), 5);
        $this->assertEquals($this->stack->peek(), 1);
    }

    public function testDequeue() {
        $this->stack = new Stack();
        $this->assertNull($this->stack->pop());
        $this->stack->push(1);
        $this->stack->push(2);
        $this->stack->push(3);
        $this->stack->push(4);
        $this->stack->push(5);
        $this->assertEquals($this->stack->pop(), 1);
        $this->assertEquals($this->stack->pop(), 2);
        $this->assertEquals($this->stack->pop(), 3);
        $this->assertEquals($this->stack->pop(), 4);
        $this->assertEquals($this->stack->pop(), 5);
    }

    public function testDequeueWithMaxSize() {
        $this->stack = new Stack(4);
        $this->stack->push(1);
        $this->stack->push(2);
        $this->stack->push(3);
        $this->stack->push(5);
    }

    public function testSize() {
        $this->stack = new Stack();
        $this->assertEquals($this->stack->size(), 0);
        $this->stack->push(1);
        $this->assertEquals($this->stack->size(), 1);
        $this->stack->push(2);
        $this->assertEquals($this->stack->size(), 2);
        $this->stack->push(3);
        $this->assertEquals($this->stack->size(), 3);
        $this->stack->push(4);
        $this->assertEquals($this->stack->size(), 4);
        $this->stack->push(5);
        $this->assertEquals($this->stack->size(), 5);
    }

    public function testEmpty() {
        $this->stack = new Stack();
        $this->assertTrue($this->stack->empty());
        $this->stack->push(true);
        $this->assertFalse($this->stack->empty());
        $this->stack->push("string");
        $this->stack->push(3.14);
        $this->stack->pop();
        $this->stack->pop();
        $this->stack->pop();
        $this->assertTrue($this->stack->empty());
    }

    public function testPeek() {
        $this->stack = new Stack();
        $this->assertNull($this->stack->peek());
        $this->stack->push(1000);
        $this->assertEquals($this->stack->peek(), 1000);
        $this->stack->push(false);
        $this->assertEquals($this->stack->peek(), 1000);
        $this->stack->push(3.14);
        $this->assertEquals($this->stack->peek(), 1000);
        $this->stack->push(4);
        $this->assertEquals($this->stack->pop(), 1000);
        $this->assertEquals($this->stack->peek(), false);
        $this->assertEquals($this->stack->pop(), false);
        $this->assertEquals($this->stack->peek(), 3.14);
        $this->assertEquals($this->stack->pop(), 3.14);
        $this->assertEquals($this->stack->peek(), 4);
        $this->assertEquals($this->stack->pop(), 4);
        $this->assertNull($this->stack->peek());
    }

    public function testIsFull() {
        $this->stack = new Stack();
        $this->assertFalse($this->stack->isFull());
        $this->stack->push(['hello']);
        $this->stack->push(false);
        $this->stack->push(['hello']);
        $this->stack->push(false);
        $this->stack->push(['hello']);
        $this->stack->push(false);
        $this->stack->push(['hello']);
        $this->stack->push(false);
        $this->assertFalse($this->stack->isFull());
    }

    public function testIsFullWithMaxSize() {
        $this->stack = new Stack(2);
        $this->stack->push(['hello']);
        $this->stack->push(false);
        $this->assertTrue($this->stack->isFull());
        $this->stack->pop();
        $this->assertFalse($this->stack->isFull());
    }
    */
}