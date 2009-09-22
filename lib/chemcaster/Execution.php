<?php

/**
 * Execution class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Execution extends Chemcaster_Item implements Iterator, ArrayAccess
{
    protected $_results = array();

    /**
     * Used by Iterator Interface
     * @var int
     */
    private $_position = 0;
    
    protected $_links = array(
        'index'         => '',
        'executable'    => ''
    );

    /**
     * Gets the count of items in this index
     * @return int
     */
    public function size()
    {
        return count( $this->_results );
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
        $link = $this->_results[$this->_position];
        return $this->_factory($link);
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
        return isset( $this->_results[$this->_position] );

    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetSet($offset, $value)
    {
        $this->_results[$offset] = $value;
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetExists($offset)
    {
        return isset($this->_results[$offset]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetUnset($offset)
    {
        unset($this->_results[$offset]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetGet($offset)
    {
        if( TRUE === isset($this->_results[$offset]) )
        {
            $link = $this->_results[$offset];
            return $this->_factory($link);
        }
        else
        {
            return null;
        }
    }
}
