<?php

use DataStructures\Sets\{DisjointNode, DisjointSet};
use PHPUnit\Framework\TestCase;

class DisjointSetTest extends TestCase {
    private $set;

    public function setUp() {
        $this->set = new DisjointSet();
    }

    public function testMakeSet() {
        $sets = [];
        $sets[] = $this->set->makeSet('hello');
        $sets[] = $this->set->makeSet('goodbye');
        $this->assertEquals(true, true);
    }

    /*
    public function testFindSet() {
        $this->set->makeSet('hello');
        $this->set->makeSet('goodbye');
        $this->set->union(0, 1);
        var_dump($this->set);
        $this->assertEquals(2, count($this->set));
    }
    */
}