<?php

/**
 * Index class. Represents a listing of Chemcaster_Representations. Can access
 * as an array.
 * 
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 *
 * @property-read Chemcaster_Representation $parent
 */
class Chemcaster_Index extends Chemcaster_Representation implements Iterator, ArrayAccess
{
    protected $_attributes = array();

    protected $_resources = array( 'parent');

    private $_position = 0;
    
    public function create( array $args )
    {
        $this->_fetch();
        $create_link = new Chemcaster_Link(
            $this->_fetched->create->name,
            $this->_fetched->create->uri,
            $this->_fetched->create->media_type
        );
        return $create_link->post( $args );
    }

    /**
     * Gets the size (count) of the Index
     * @return int
     */
    public function size()
    {
        $this->_fetch();
        return count($this->_fetched->items);
    }

    /**
     * Implemented for the Iterator interface
     */
    public function rewind()
    {
        $this->_position = 0;
    }

    /**
     * Implemented for the Iterator interface
     */
    public function current()
    {
        $this->_fetch();
        return $this->_fetched->items[$this->_position];
    }

    /**
     * Implemented for the Iterator interface
     */
    public function key()
    {
        return $this->_position;
    }

    /**
     * Implemented for the Iterator interface
     */
    public function next()
    {
        ++$this->_position;
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function valid()
    {
        $this->_fetch();
        return isset($this->_fetched->items[$this->_position]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetSet($offset, $value)
    {
        $this->_fetch();
        $this->_fetched->items[$offset] = $value;
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetExists($offset)
    {
        $this->_fetch();
        return isset($this->_fetched->items[$offset]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetUnset($offset)
    {
        $this->_fetch();
        unset($this->_fetched->items[$offset]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetGet($offset)
    {
        $this->_fetch();
        return isset($this->_fetched->items[$offset]) ? $this->_fetched->items[$offset] : null;
    }
}

