<?php

namespace DataStructures\Trees\Interfaces;

use Countable;

/**
 * TreeInterface has the tree prototypes methods to be implemented.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
interface TreeInterface extends Countable {
    public function empty();
    public function size();
    public function put($key, $data);
    public function update($key, $data);
    public function get($key);
    public function getMin();
    public function getMax();
    public function deleteMin();
    public function deleteMax();
    public function delete($key);
}