<?php

/**
 * Service class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Service extends Chemcaster_Representation
{
    protected $_attributes = array( 'version' );

    protected $_resources = array( 'registries' );
    
    /**
     * Stores the curl resource handle
     * @var resource $service_handle
     * @static
     */
    public static $service_handle;

    /**
     * Static connection method
     * @param string $username
     * @param string $password
     * @param array $options options for php curl_setopt
     * @static
     * @return Chemcaster_Service
     */
    public static function connect( $username, $password, $options = array() )
    {

        self::$service_handle = curl_init();

        curl_setopt( self::$service_handle, CURLOPT_RETURNTRANSFER, TRUE );
        curl_setopt( self::$service_handle, CURLOPT_USERPWD, "{$username}:{$password}" );
        curl_setopt( self::$service_handle, CURLOPT_USERAGENT, 'chemcaster-php' );

        foreach( $options as $curl_option => $curl_value )
            curl_setopt( self::$service_handle, $curl_option, $curl_value );

        $base_uri = "https://chemcaster.com/rest";
        $base_media_type = 'application/vnd.com.chemcaster.Service+json';
        
        $link = new Chemcaster_Link('root', $base_uri, $base_media_type);

        $class = 'Chemcaster_Service';
        
        return new $class( $link );
    }
}

