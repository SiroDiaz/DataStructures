<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Trees\Nodes;

/**
 * DisjointNode.
 *
 * The DisjointNode class represents the disjoint set node. It uses a pointer to the
 * next parent node and a rank attribute used to add the little tree to the bigger.
 * The trees with just one element have a rank of 0.
 * Using rank the execution time for operations makeSet, union, and find is of O(log n).
 * Rank is used instead of depth.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class DisjointNode {
    public $parent;
    public $data;

    public function __construct($data) {
        $this->parent = null;
        $this->data = $data;
    }
}