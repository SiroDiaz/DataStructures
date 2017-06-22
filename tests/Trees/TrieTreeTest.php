<?php

namespace DataStructures\Tests\Trees;

use PHPUnit\Framework\TestCase;
use DataStructures\Trees\TrieTree;

class TrieTreeTest extends TestCase {
    private $tree;

    public function setUp() {
        $this->tree = new TrieTree();
    }

    public function testAdd() {
        $this->tree->add('hello');
        $this->tree->add('bye');
        $this->assertEquals(8, $this->tree->size());
        $this->tree->add('hello');
        $this->assertEquals(8, $this->tree->size());
        $this->tree->add('hell');
        $this->assertEquals(8, $this->tree->size());
    }

    public function testWordCount() {
        $this->tree->add('hello');
        $this->assertEquals(1, $this->tree->wordCount());
        $this->tree->add('bye');
        $this->assertEquals(2, $this->tree->wordCount());
        $this->tree->add('hello');
        $this->assertEquals(2, $this->tree->wordCount());
        $this->tree->add('hell');
        $this->assertEquals(3, $this->tree->wordCount());
    }

    public function testContains() {
        $this->tree->add('hello');
        $this->assertTrue($this->tree->contains('hello'));
        $this->tree->add('bye');
        $this->assertTrue($this->tree->contains('bye'));
        $this->assertFalse($this->tree->contains('what'));
    }

    public function testStartsWith() {
        $this->assertFalse($this->tree->startsWith('hello'));
        $this->tree->add('hello');
        $this->tree->add('bye');
        $this->assertTrue($this->tree->startsWith('b'));
        $this->assertTrue($this->tree->startsWith('hel'));
        $this->assertFalse($this->tree->startsWith('hellooo'));
    }

    public function testWithPrefix() {
        $this->tree->add('hello');
        $this->tree->add('hell');
        $this->tree->add('bye');
        $this->tree->add('beyond');
        $withH = $this->tree->withPrefix('he');
        $withB = $this->tree->withPrefix('b');
        $withBy = $this->tree->withPrefix('by');
        $all = $this->tree->withPrefix('');

        $this->assertSame(['hell', 'hello'], $withH);
        $this->assertSame(['bye', 'beyond'], $withB);
        $this->assertSame(['bye'], $withBy);
        $this->assertSame(['hell', 'hello', 'bye', 'beyond'], $all);
        $this->assertEquals(4, $this->tree->wordCount());
    }

    public function testDelete() {
        $this->tree->add('hellou');
        $this->tree->add('hell');
        $this->tree->add('yellow');
        $this->tree->delete('hellou');
        $this->assertEquals(2, $this->tree->wordCount());
        $this->assertFalse($this->tree->contains('hellou'));
        $this->assertTrue($this->tree->contains('hell'));
        $this->assertTrue($this->tree->contains('yellow'));
        $this->tree->delete('yellow');
        $this->assertEquals(4, $this->tree->size());
    }

    public function testClear() {
        $this->tree->add('hellou');
        $this->tree->add('hell');
        $this->tree->add('yellow');
        $this->assertEquals(3, $this->tree->wordCount());
        $this->tree->clear();
        $this->assertFalse($this->tree->contains('hellou'));
        $this->assertFalse($this->tree->contains('hell'));
        $this->assertFalse($this->tree->contains('yellow'));
        $this->assertEquals(0, $this->tree->size());
    }

    public function testGetWords() {
        $this->assertSame([], $this->tree->getWords());
        $this->tree->add('hello');
        $this->tree->add('hell');
        $this->tree->add('yellow');
        $this->tree->add('');
        $this->assertEquals(3, $this->tree->wordCount());
        $this->assertSame(['hell', 'hello', 'yellow'], $this->tree->getWords());
        $this->tree->delete('hello');
        $this->assertSame(['hell', 'yellow'], $this->tree->getWords());
        $this->tree->delete('hell');
        $this->assertSame(['yellow'], $this->tree->getWords());
        $this->tree->delete('yellow');
        $this->assertSame([], $this->tree->getWords());
    }
}