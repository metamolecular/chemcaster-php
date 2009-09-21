<?php

/**
 * Service class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Service extends Chemcaster_Representation
{
    /**
     * The links for this rep.
     * @var array
     */
    protected $_links = array( 'registries' => '' );

    /**
     * Sets up initial connection and returns the Chemcaster_Service object
     * @param string $username
     * @param string $password
     * @return Chemcaster_Service
     * @access public
     * @static
     */
    public static function connect( $username, $password )
    {
        $conn = new Chemcaster_Transporter( $username, $password );

        $base_uri = "https://chemcaster.com/rest";
        $base_media_type = 'application/vnd.com.chemcaster.Service+json';

        $link = new Chemcaster_Link('service', $base_uri, $base_media_type);

        return new Chemcaster_Service( $conn, $link );
    }

    
}
