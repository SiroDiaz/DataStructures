<?php

namespace DataStructures\Trees;

class TrieNode {
    public $char;
    public $isWord;
    public $children;
    public $size;

    public function __construct($char = '', $isWord = false) {
        $this->char = $char;
        $this->isWord = $isWord;
        $this->children = [];
        $this->size = 0;
    }
}