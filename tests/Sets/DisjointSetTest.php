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
        $this->assertEquals($sets[0], $this->set->makeSet('hello'));
        $this->assertEquals($sets[1], $this->set->makeSet('goodbye'));
    }

    public function testUnion() {
        $sets = [];
        $sets[] = $this->set->makeSet('hello');
        $sets[] = $this->set->makeSet('goodbye');
        $sets[] = $this->set->makeSet([true, 3.14]);

        $this->set->union($sets[0], $sets[1]);
        $this->set->union($sets[0], $sets[0]);
        $this->assertEquals($sets[1], $this->set->find($sets[0]));
        $this->set->union($sets[0], $sets[2]);
        $this->assertEquals($sets[1], $this->set->find($sets[2]));
    }
}