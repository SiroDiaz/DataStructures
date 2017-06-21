<?php

namespace DataStructures\Sets;

class DisjointNode {
    public $parent;
    public $rank;
    public $data;

    public function __construct(DisjointNode $parent = null, $rank, $data) {
        $this->parent = $parent;
        $this->rank = $rank;
        $this->data = $data;
    }
}

class DisjointSet {
    public function __construct() {}

    public function makeSet($data) {
        $newSet = new DisjointNode(null, 0, $data);
        $newSet->parent = &$newSet;

        return $newSet;
    }

    public function find(DisjointNode $node) {
        if($node->parent !== $node) {
            $node->parent = $this->find($node->parent);
        }

        return $node->parent;
    }

    public function union($x, $y) {
        
    }
}