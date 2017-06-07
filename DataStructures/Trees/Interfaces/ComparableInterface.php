<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
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