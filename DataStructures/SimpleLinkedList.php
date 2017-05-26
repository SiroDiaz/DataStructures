<?php

namespace DataStructures;

class SimpleLinkedListNode {
    public $data = null;
    public $next = null;

    public function __construct($data) {
        $this->data = $data;
    }
}

class SimpleLinkedList {
    private $head;
    private $size;

    public function __construct() {
        $this->head = null;
        $this->size = 0;
    }

    public function size() : int {
        return $this->size;
    }

    public function empty() : bool {
        return $this->size == 0;
    }

    public function push($node) {
        $newNode = new SimpleLinkedListNode($node);
        if($this->size === 0) {
            $this->head = &$newNode;
        } else {
            $current = $this->head;
            while($current->next !== null) {
                $current = $current->next;
            }
            $current->next = &$newNode;
        }

        $this->size++;
    }

    public function get($index) {
        if($this->head === null || $index > $this->size - 1 || $index < 0) {
            return null;
        }
        

        $current = $this->head;
        $i = 0;
        while($i < $index && $current->next !== null) {
            $current = $current->next;
            $i++;
        }

        return $current->data;
    }

    public function getAll() {
        if($this->head === null) {
            return null;
        }

        $current = $this->head;
        while($current->next !== null) {
            yield $current->data;
            $current = $current->next;
        }
    }

    public function insertAt($node) {

    }

    public function unshift($node) {

    }
}