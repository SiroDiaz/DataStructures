<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Lists\Interfaces;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * ListInterface
 *
 * ListInterface is the interface that implements all lists classes.
 * 
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
interface ListInterface extends ArrayAccess, Iterator, Countable {
    public function insert($index, $data);
    // public function addAll(array $data, $index = 0);
    // Removes all of the elements from this list (optional operation).
    public function clear();
    // Returns true if this list contains the specified element.
    public function contains($data) : bool;
    public function get($index);
    public function getAll();
    // Returns the index of the first occurrence of the specified element in this list, or false if this list does not contain the element.
    public function indexOf($data);
    public function empty() : bool;
    // Returns the index of the last occurrence of the specified element in this list, or false if this list does not contain the element.
    public function lastIndexOf($data);
    public function delete($index);
    // Removes the first occurrence of the specified element from this list, if it is present (optional operation).
    public function remove($data);
    // Removes from this list all of its elements that are contained in the specified collection (optional operation).
    // public function deleteAll(ListInterface $list);
    // public function set($index, $newValue);
    // Replaces the element at the specified position in this list with the specified element (optional operation).
    public function size() : int;
    // Returns a view of the portion of this list between the specified fromIndex, inclusive, and toIndex, exclusive.
    // List<E>	subList(int fromIndex, int toIndex)
    public function toArray() : array;
}