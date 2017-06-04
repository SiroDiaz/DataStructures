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
    public function putOrUpdate($key, $data);
    public function get($key);
    public function getRoot();
    public function exists($key);
    public function floor($key);
    public function ceil($key);
    public function min();
    public function max();
    public function deleteMin();
    public function deleteMax();
    public function delete($key);
    public function search($key);
}