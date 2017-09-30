<?php

namespace DataStructures\Hash;

class HashEntry {
    private $key;
    private $value;

    public function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey() {
        return $this->key;
    }

    public function getValue() {
        return $this->value;
    }

    public function setKey($newKey) {
        $this->key = $newKey;
    }

    public function setValue($newValue) {
        $this->value = $newValue;
    }
}