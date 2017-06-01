<?php

use DataStructures\Trees\BinarySearchTree;
use PHPUnit\Framework\TestCase;

class BinarySearchTreeTest extends TestCase {
    private $tree;

    public function setUp() {
        $this->tree = new BinarySearchTree();
    }

    public function testEmpty() {
        $this->assertTrue(true);
    }
}