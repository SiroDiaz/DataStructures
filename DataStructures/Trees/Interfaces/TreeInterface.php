<?php

namespace DataStructures\Trees\Interfaces;

use Countable;

interface TreeInterface extends Countable {
    public function size();
    public function put($key, $data);
    public function get($key);
    
}