<?php

/**
 * Index class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Index extends Chemcaster_Representation implements Iterator, ArrayAccess
{
    /**
     *
     * @var int
     */
    private $_position = 0;

    /**
     *
     * @var array
     */
    protected $_links = array( 'parent' => '', 'create' => '' );

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

        $http_code = (string) $this->_transporter->getLastStatusCode();
        if( '2' == $http_code[0] )
        {
            $new_class = 'Chemcaster_' . $this->_links['create']->getRepresentationName();
            
            return new $new_class( $this->_transporter, $ret_json );
        }
        else
        {
            $excep = new Chemcaster_CreationException();
            $excep->http_error_code = $http_code;
            $errors = json_decode($ret_json);
            foreach( $errors as $error )
            {
                $excep->http_errors[] = "{$error->field} {$error->text}";
            }

            throw $excep;
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