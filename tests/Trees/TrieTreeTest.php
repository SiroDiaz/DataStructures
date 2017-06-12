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
}