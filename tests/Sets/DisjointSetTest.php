<?php

namespace DataStructures\Tests\Sets;

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
        
        $this->set->makeSet('hello');
        $this->set->makeSet('goodbye');
        $this->set->makeSet([true, 3.14]);

        $this->set->union(0, 1);        
        $this->set->union(0, 0);

        $this->assertEquals(0, $this->set->find(0));
        $this->set->union(0, 1);
        $this->assertEquals(2, $this->set->find(2));
        $this->set->union(1, 2);
        var_dump($this->set->subsets);
        exit();
    }
}