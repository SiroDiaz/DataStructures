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
    public $subsets;

    public function __construct() {
        $this->subsets = [];
    }

    /**
     * Creates a new set/tree with zero children and parents.
     * Its parent points to itself and the rank is 0 when new
     * set is created.
     *
     * @param mixed $data the data to store.
     * @return DataStructures\Trees\Nodes\DisjointNode the node created.
     */
    public function makeSet($data) : DisjointNode {
        $newSet = new DisjointNode($data);
        $this->subsets[] = $newSet;

        return $newSet;
    }

    /**
     * Returns the representative node (the root of $node in the tree) and
     * also applies path compression.
     *
     * @param DataStructures\Trees\Nodes\DisjointNode $node the node from
     *  where start to search the root.
     * @return DataStructures\Trees\Nodes\DisjointNode the parent node.
     */
    public function find($vertex) {
        if($this->subsets[$vertex]->parent === null || $this->subsets[$vertex]->parent < 0) {
            return $vertex;
        }

        $this->subsets[$vertex]->parent = $this->find($this->subsets[$vertex]->parent);
        return $this->subsets[$vertex]->parent;
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
    public function union($vertex1, $vertex2) {
        if($this->subsets[$vertex2]->parent < $this->subsets[$vertex1]->parent) {
            $this->subsets[$vertex1]->parent = $vertex2;
        } else {
            if($this->subsets[$vertex1]->parent === $this->subsets[$vertex2]->parent) {
                if($this->subsets[$vertex1]->parent === null) {
                    $this->subsets[$vertex1]->parent = -1;
                } else {
                    $this->subsets[$vertex1]->parent--;
                }
            }

            $this->subsets[$vertex2]->parent = $vertex1;
        }
    }
}
