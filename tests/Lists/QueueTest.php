<?php

use DataStructures\Exceptions\FullException;
use DataStructures\Lists\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase {
    private $queue;

    public function testContructMaxSize() {
        $this->expectException(InvalidArgumentException::class);
        $this->queue = new Queue(-1);
    }

    public function testEnqueueWithMaxSize() {
        $this->queue = new Queue(5);
        $this->queue->enqueue(1);
        $this->assertEquals($this->queue->peek(), 1);
        $this->queue->enqueue(2);
        $this->assertEquals($this->queue->peek(), 1);
        $this->queue->enqueue(3);
        $this->assertEquals($this->queue->peek(), 1);
        $this->queue->enqueue(4);
        $this->queue->enqueue(5);
        $this->expectException(FullException::class);
        $this->queue->enqueue(6);
    }

    public function testEnqueue() {
        $this->queue = new Queue();
        $this->queue->enqueue(1);
        $this->queue->enqueue(2);
        $this->queue->enqueue(3);
        $this->queue->enqueue(4);
        $this->queue->enqueue(5);
        // $this->queue->head->data . $this->queue->head->next->data . $this->queue->head->next->next->data . PHP_EOL;
        $this->assertEquals($this->queue->size(), 5);
        $this->assertEquals($this->queue->peek(), 1);
    }

    public function testDequeue() {
        $this->queue = new Queue();
        $this->assertNull($this->queue->dequeue());
        $this->queue->enqueue(1);
        $this->queue->enqueue(2);
        $this->queue->enqueue(3);
        $this->queue->enqueue(4);
        $this->queue->enqueue(5);
        $this->assertEquals($this->queue->dequeue(), 1);
        $this->assertEquals($this->queue->dequeue(), 2);
        $this->assertEquals($this->queue->dequeue(), 3);
        $this->assertEquals($this->queue->dequeue(), 4);
        $this->assertEquals($this->queue->dequeue(), 5);
    }

    public function testDequeueWithMaxSize() {
        $this->queue = new Queue(4);
        $this->queue->enqueue(1);
        $this->queue->enqueue(2);
        $this->queue->enqueue(3);
        $this->queue->enqueue(5);
    }

    public function testSize() {
        $this->queue = new Queue();
        $this->assertEquals($this->queue->size(), 0);
        $this->queue->enqueue(1);
        $this->assertEquals($this->queue->size(), 1);
        $this->queue->enqueue(2);
        $this->assertEquals($this->queue->size(), 2);
        $this->queue->enqueue(3);
        $this->assertEquals($this->queue->size(), 3);
        $this->queue->enqueue(4);
        $this->assertEquals($this->queue->size(), 4);
        $this->queue->enqueue(5);
        $this->assertEquals($this->queue->size(), 5);
    }

    public function testEmpty() {
        $this->queue = new Queue();
        $this->assertTrue($this->queue->empty());
        $this->queue->enqueue(true);
        $this->assertFalse($this->queue->empty());
        $this->queue->enqueue("string");
        $this->queue->enqueue(3.14);
        $this->queue->dequeue();
        $this->queue->dequeue();
        $this->queue->dequeue();
        $this->assertTrue($this->queue->empty());
    }

    public function testPeek() {
        $this->queue = new Queue();
        $this->assertNull($this->queue->peek());
        $this->queue->enqueue(1000);
        $this->assertEquals($this->queue->peek(), 1000);
        $this->queue->enqueue(false);
        $this->assertEquals($this->queue->peek(), 1000);
        $this->queue->enqueue(3.14);
        $this->assertEquals($this->queue->peek(), 1000);
        $this->queue->enqueue(4);
        $this->assertEquals($this->queue->dequeue(), 1000);
        $this->assertEquals($this->queue->peek(), false);
        $this->assertEquals($this->queue->dequeue(), false);
        $this->assertEquals($this->queue->peek(), 3.14);
        $this->assertEquals($this->queue->dequeue(), 3.14);
        $this->assertEquals($this->queue->peek(), 4);
        $this->assertEquals($this->queue->dequeue(), 4);
        $this->assertNull($this->queue->peek());
    }

    public function testIsFull() {
        $this->queue = new Queue();
        $this->assertFalse($this->queue->isFull());
        $this->queue->enqueue(['hello']);
        $this->queue->enqueue(false);
        $this->queue->enqueue(['hello']);
        $this->queue->enqueue(false);
        $this->queue->enqueue(['hello']);
        $this->queue->enqueue(false);
        $this->queue->enqueue(['hello']);
        $this->queue->enqueue(false);
        $this->assertFalse($this->queue->isFull());
    }

    public function testIsFullWithMaxSize() {
        $this->queue = new Queue(2);
        $this->queue->enqueue(['hello']);
        $this->queue->enqueue(false);
        $this->assertTrue($this->queue->isFull());
        $this->queue->dequeue();
        $this->assertFalse($this->queue->isFull());
    }
}