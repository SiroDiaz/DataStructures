<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Hash\Interfaces;

/**
 * HashTableInterface
 *
 * This interface is used to apply the strategy design pattern.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
interface HashTableInterface {
    
    /**
     * Looks for the element stored in the hash table.
     * 
     * @param string $key. 
     */
    public function search($key);
    
    /**
     * Checks if is contained an element by key and returns a boolean.
     *
     * @param string $key The key to look for.
     * @param bool true if is found, else false.
     */
    public function contains($key) : bool;

    /**
     * Inserts a new pair key-value in the hash table.
     *
     * @param string $key.
     * @param mixed $val.
     */
    public function insert($key, $val);
    
    /**
     * Deletes an entry by key.
     *
     * @param string $key the key to delete.
     */
    public function delete($key);
    
    /**
     * Deletes all the content in the hash table and resets the size of it.
     */
    public function clear();
}