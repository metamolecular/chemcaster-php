<?php

/**
 * Item class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Item extends Chemcaster_Representation
{
    /**
     * Updates an Item
     * @param array $args
     * @return Chemcaster_Item
     * @access public
     */
    public function update( $args )
    {
        if( FALSE === isset($this->_links['update']) )
        {
            throw new Chemcaster_MethodNotAllowed("Update not allowed here");
            return;
        }

        $link = $this->_links['update'];
        $rep_name = strtolower( $link->getRepresentationName() );
        $json_args = json_encode( array( $rep_name => $args) );

        $ret_json = $this->_transporter->put( $link, $json_args );

        if( FALSE === $ret_json )
        {
            $http_code = (string) $this->_transporter->getLastStatusCode();
            $excep = new Chemcaster_UpdateException();
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
     * Destroys an Item
     * @return Chemcaster_Item
     * @access public
     */
    public function destroy( )
    {
        if( FALSE === isset($this->_links['destroy']) )
        {
            throw new Chemcaster_MethodNotAllowed("Destroy not allowed here");
            return;
        }

        $link = $this->_links['destroy'];
        $rep_name = strtolower( $link->getRepresentationName() );

        $ret_json = $this->_transporter->delete( $link );

        if( FALSE === $ret_json )
        {
            $http_code = (string) $this->_transporter->getLastStatusCode();
            $excep = new Chemcaster_DestroyException();
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
}

class Chemcaster_UpdateException extends Exception
{
    public $http_error_code;
    public $http_errors = array();

    function __construct()
    {
        parent::__construct("Error trying to update resource ");
    }
}

class Chemcaster_DestroyException extends Exception
{
    public $http_error_code;
    public $http_errors = array();

    function __construct()
    {
        parent::__construct("Error trying to destroy resource ");
    }
}

class Chemcaster_MethodNotAllowed extends Exception{}