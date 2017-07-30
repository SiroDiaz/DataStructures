<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Lists\Nodes;

use DataStructures\Lists\Nodes\SinglyLinkedListNode;
/**
 * DoublyLinkedList represents the node structure that points to 
 * the next and previous node.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class DoublyLinkedListNode extends SinglyLinkedListNode {
    public $prev = null;
}