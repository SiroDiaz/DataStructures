<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Exceptions;

use Exception;

/**
 * FullException
 *
 * FullException is thrown when a stack or a queue with limited size
 * is full.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class FullException extends Exception {}