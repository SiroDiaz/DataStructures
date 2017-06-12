<?php

use PHPUnit\Framework\TestCase;
use DataStructures\Trees\TrieTree;


class TrieTreeTest extends TestCase {
    private $tree;

    public function setUp() {
        $this->tree = new TrieTree();
    }

    public function testAdd() {
        $this->assertTrue(true);
    }
}