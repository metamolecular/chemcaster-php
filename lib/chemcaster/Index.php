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
    protected $items = array();
    
    /**
     * Used by Iterator Interface
     * @var int
     */
    private $_position = 0;

    /**
     * Create method for give index
     * @param array $args [see api for appropriate keys]
     * @return mixed
     * @access public
     * @throws Chemcaster_CreationException
     */
    public function create( $args = NULL )
    {
        if( FALSE === isset($this->links['create']) )
        {
            throw new Chemcaster_MethodNotAllowed("Create not allowed here");
            return;
        }

        if( NULL === $args ) $args = new stdClass;

        $link = $this->links['create'];
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
        return count( $this->items );
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
        $link = $this->items[$this->_position];
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
        return isset( $this->items[$this->_position] );

    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * Implemented for the ArrayAcces interface
     */
    public function offsetGet($offset)
    {
        if( TRUE === isset($this->items[$offset]) )
        {
            $link = $this->items[$offset];
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