<?php

/**
 * Registry class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Registry extends Chemcaster_Representation
{
    protected $_links = array(
        'index' => '',
        'update' => '',
        'structures' => '',
        'queries' => ''
    );

    /**
     * Updates a Registry
     * @param array $args
     * @return Chemcaster_Registry
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
}