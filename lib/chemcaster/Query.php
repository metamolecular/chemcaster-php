<?php

/**
 * Query class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Query extends Chemcaster_Representation
{
    protected $_links = array(
        'images'       => '',
        'index'        => '',
        'destroy'      => ''
    );

    /**
     * Destroys a Query
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

?>
