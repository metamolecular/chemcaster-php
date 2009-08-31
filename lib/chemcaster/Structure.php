<?php

/**
 * Structure class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Structure extends Chemcaster_Representation
{
    protected $_links = array(
        'index'         => '',
        'update'        => '',
        'registry'      => '',
        'images'        => '',
        'destroy'       => ''
    );

    /**
     * Updates a Structure
     * @param array $args
     * @return Chemcaster_Structure
     * @access public
     */
    public function update( $args )
    {
        $link = $this->_links['update'];
        $rep_name = strtolower( $link->getRepresentationName() );
        $json_args = json_encode( array( $rep_name => $args) );

        $ret_json = $this->_transporter->put( $link, $json_args );

        $http_code = (string) $this->_transporter->getLastStatusCode();
        if( '2' == $http_code[0] )
        {
            $new_class = 'Chemcaster_' . $link->getRepresentationName();

            return new $new_class( $this->_transporter, $ret_json );
        }
        else
        {
            $excep = new Chemcaster_UpdateException();
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
     * Destroys a Structure
     * @return Chemcaster_Structure
     * @access public
     */
    public function destroy( )
    {
        $link = $this->_links['destroy'];
        $rep_name = strtolower( $link->getRepresentationName() );

        $ret_json = $this->_transporter->delete( $link );

        $http_code = (string) $this->_transporter->getLastStatusCode();
        if( '2' == $http_code[0] )
        {
            $new_class = 'Chemcaster_' . $link->getRepresentationName();

            return new $new_class( $this->_transporter, $ret_json );
        }
        else
        {
            $excep = new Chemcaster_DestroyException();
            $excep->http_error_code = $http_code;
            $errors = json_decode($ret_json);
            foreach( $errors as $error )
            {
                $excep->http_errors[] = "{$error->field} {$error->text}";
            }

            throw $excep;
        }
    }
}
