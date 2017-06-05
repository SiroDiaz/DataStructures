<?php

namespace DataStructures\Trees\Interfaces;

/**
 * Comparable is the class that other classes must implement to be stored
 * in a tree. It is used to make possible to set an order in TreeSets and
 * make possible identify same objects.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
interface Comparable {
    public function compareTo($item);
}