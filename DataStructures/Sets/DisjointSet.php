<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Sets;

use DataStructures\Trees\Nodes\DisjointNode;

/**
 * DisjointSet.
 *
 * The DisjointSet class represents a disjoint set.
 * Operations take in worse case a O(n) except makeSet that takes
 * constant time, O(1).
 * Basic operations are makeSet, find and union.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
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