<?php

namespace DataStructures\Lists\Interfaces;

use Iterator;

/**
 * ListInterface is the interface that implements all lists classes.
 * 
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
interface ListInterface extends Iterator {
    public function insert($index, $data);
    // public function addAll(array $data, $index = 0);
    // Removes all of the elements from this list (optional operation).
    // public function clear();
    // Returns true if this list contains the specified element.
    // public function contains($data);
    public function get($index);
    // Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not contain the element.
    // public function indexOf($data);
    // public function empty();
    // Returns the index of the last occurrence of the specified element in this list, or -1 if this list does not contain the element.
    // public function lastIndexOf(Object o)
    public function delete($index);
    // Removes the first occurrence of the specified element from this list, if it is present (optional operation).
    // public function delete($data);
    // Removes from this list all of its elements that are contained in the specified collection (optional operation).
    // public function deleteAll(ListInterface $list);
    // public function set($index, $newValue);
    // Replaces the element at the specified position in this list with the specified element (optional operation).
    public function size();
    // Returns a view of the portion of this list between the specified fromIndex, inclusive, and toIndex, exclusive.
    // List<E>	subList(int fromIndex, int toIndex)
    public function toArray();
}