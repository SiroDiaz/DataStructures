<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Hash\Interfaces;

interface HashTableInterface {
    public function search($key);
    public function insert($key, $val);
    public function delete($key);
    public function clear();
}