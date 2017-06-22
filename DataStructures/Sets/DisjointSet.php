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

    /**
     * Creates a new set/tree with zero children and parents.
     * Its parent points to itself and the rank is 0 when new
     * set is created.
     *
     * @param mixed $data the data to store.
     * @return DataStructures\Trees\Nodes\DisjointNode the node created.
     */
    public function makeSet($data) : DisjointNode {
        $newSet = new DisjointNode(0, $data);
        $newSet->parent = &$newSet;

        return $newSet;
    }

    /**
     * Returns the representative node (the root of $node in the tree).
     *
     * @param DataStructures\Trees\Nodes\DisjointNode $node the node from
     *  where start to search the root.
     * @return DataStructures\Trees\Nodes\DisjointNode the parent node.
     */
    public function find(DisjointNode $node) : DisjointNode {
        if($node->parent !== $node) {
            $node->parent = $this->find($node->parent);
        }

        return $node->parent;
    }

    /**
     * Performs the union of two sets (or trees). First looks for
     * the root of $x and $y set. Then, if both are in the same tree
     * finalize the method. Else, depending of the rank, will join a
     * set to other set (The set with lower rank will be append to higher
     * one). If both have the same rank it doesn't matter what tree
     * is joined to the other tree but the rank will increase.
     *
     * @param DataStructures\Trees\Nodes\DisjointNode $x The set.
     * @param DataStructures\Trees\Nodes\DisjointNode $y The other set.
     */
    public function union(DisjointNode $x, DisjointNode $y) {
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