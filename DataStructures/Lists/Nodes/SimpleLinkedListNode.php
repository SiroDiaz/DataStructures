<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Lists\Nodes;

/**
 * SimpleLinkedListNode is the node atomic structure of lists.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
class SimpleLinkedListNode {
    public $data = null;
    public $next = null;

    public function __construct($data) {
        $this->data = $data;
    }
}