<?php

namespace Clases;

class ArrayOfClaseTitulosUni implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var ClaseTitulosUni[] $ClaseTitulosUni
     */
    protected $ClaseTitulosUni = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return ClaseTitulosUni[]
     */
    public function getClaseTitulosUni()
    {
      return $this->ClaseTitulosUni;
    }

    /**
     * @param ClaseTitulosUni[] $ClaseTitulosUni
     * @return \Clases\ArrayOfClaseTitulosUni
     */
    public function setClaseTitulosUni(array $ClaseTitulosUni = null)
    {
      $this->ClaseTitulosUni = $ClaseTitulosUni;
      return $this;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset An offset to check for
     * @return boolean true on success or false on failure
     */
    public function offsetExists($offset)
    {
      return isset($this->ClaseTitulosUni[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return ClaseTitulosUni
     */
    public function offsetGet($offset)
    {
      return $this->ClaseTitulosUni[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param ClaseTitulosUni $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      if (!isset($offset)) {
        $this->ClaseTitulosUni[] = $value;
      } else {
        $this->ClaseTitulosUni[$offset] = $value;
      }
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->ClaseTitulosUni[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return ClaseTitulosUni Return the current element
     */
    public function current()
    {
      return current($this->ClaseTitulosUni);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->ClaseTitulosUni);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->ClaseTitulosUni);
    }

    /**
     * Iterator implementation
     *
     * @return boolean Return the validity of the current position
     */
    public function valid()
    {
      return $this->key() !== null;
    }

    /**
     * Iterator implementation
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind()
    {
      reset($this->ClaseTitulosUni);
    }

    /**
     * Countable implementation
     *
     * @return ClaseTitulosUni Return count of elements
     */
    public function count()
    {
      return count($this->ClaseTitulosUni);
    }

}
