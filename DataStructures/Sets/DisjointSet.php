<?php

namespace DataStructures\Sets;

class DisjointNode {
    public $parent;
    public $rank;
    public $data;

    public function __construct($rank, $data) {
        $this->parent = null;
        $this->rank = $rank;
        $this->data = $data;
    }
}

class DisjointSet {
    public function __construct() {}

    public function makeSet($data) {
        $newSet = new DisjointNode(0, $data);
        $newSet->parent = &$newSet;

        return $newSet;
    }

    public function find(DisjointNode $node) : DisjointNode {
        if($node->parent !== $node) {
            $node->parent = $this->find($node->parent);
        }

        return $node->parent;
    }

    public function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if($rootX === $rootY) {
            return;
        }

        if($rootX->rank < $rootY->rank) {
            $rootX->parent = &$rootY;
        } else if($rootX->rank > $rootY->rank) {
            $rootY->parent = &$rootX;
        } else {
            $rootX->parent = &$rootY;
            $rootY->rank++;
        }
    }
}