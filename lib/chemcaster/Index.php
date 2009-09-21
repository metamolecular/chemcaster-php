<?php

/**
 * Index class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Index extends Chemcaster_Representation implements Iterator, ArrayAccess
{
    /**
     * Stores the itemized resource links (if any)
     * @var array
     */
    protected $_items = array();
    
    /**
     * Used by Iterator Interface
     * @var int
     */
    private $_position = 0;

    protected $_links = array( 'parent' => '', 'create' => '', 'previous_page' => '', 'next_page' => '' );

    /**
     * Create method for give index
     * @param array $args [see api for appropriate keys]
     * @return mixed
     * @access public
     * @throws Chemcaster_CreationException
     */
    public function create( $args )
    {
        $link = $this->_links['create'];
        $rep_name = strtolower( $link->getRepresentationName() );
        $json_args = json_encode( array( $rep_name => $args) );

        $ret_json = $this->_transporter->post( $link, $json_args );

        if( FALSE === $ret_json )
        {
            $http_code = (string) $this->_transporter->getLastStatusCode();
            $excep = new Chemcaster_CreationException();
            $excep->http_error_code = $http_code;

            $excep->http_errors = json_decode($this->_transporter->getLastResult());

            throw $excep;
        }
        else
        {
            $new_class = 'Chemcaster_' . $link->getRepresentationName();

            return new $new_class( $this->_transporter, $ret_json );
        }
    }

    /**
     * Gets the count of items in this index
     * @return int
     */
    public function size()
    {
        return count( $this->_items );
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
        $link = $this->_items[$this->_position];
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
        return isset( $this->_items[$this->_position] );

    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetSet($offset, $value)
    {
        $this->_items[$offset] = $value;
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetExists($offset)
    {
        return isset($this->_items[$offset]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetUnset($offset)
    {
        unset($this->_items[$offset]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetGet($offset)
    {
        if( TRUE === isset($this->_items[$offset]) )
        {
            $link = $this->_items[$offset];
            return $this->_factory($link);
        }
        else
        {
            return null;
        }
    }
}

class Chemcaster_CreationException extends Exception
{
    public $http_error_code;
    public $http_errors = array();

    function __construct()
    {
        parent::__construct("Error trying to create new resource ");
    }
}