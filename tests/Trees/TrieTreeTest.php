<?php

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

    //TODO
    public function testWithPrefix() {
        $this->tree->add('hello');
        $this->tree->add('hell');
        $this->tree->add('bye');
        $this->tree->withPrefix('he');
        $this->assertEquals(3, $this->tree->wordCount());
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
}