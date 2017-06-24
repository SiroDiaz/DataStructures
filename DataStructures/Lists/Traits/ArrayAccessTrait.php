<?php
/**
 * DataStructures for PHP
 *
 * @link      https://github.com/SiroDiaz/DataStructures
 * @copyright Copyright (c) 2017 Siro Díaz Palazón
 * @license   https://github.com/SiroDiaz/DataStructures/blob/master/README.md (MIT License)
 */
namespace DataStructures\Lists\Traits;

use OutOfBoundsException;

/**
 * ArrayAccessTrait
 *
 * ArrayAccessTrait is a trait that implements the ArrayAccess methods
 * to avoid repeating code in the List hierarchy classes.
 *
 * @author Siro Diaz Palazon <siro_diaz@yahoo.com>
 */
trait ArrayAccessTrait {
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $offset = $this->size;
            if($this->size === 0) {
                $offset = 0;
            }
            $this->insert($offset, $value);
        } else {
            $this->insert($offset, $value);
        }
    }
    
    public function offsetExists($offset) {
        try {
            return $this->get($offset);
        } catch(OutOfBoundsException $e) {
            return false;
        }
    }

    public function offsetUnset($offset) {
        $this->delete($offset);
    }

    public function offsetGet($offset) {
        return $this->get($offset);
    }
}