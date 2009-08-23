<?php

require_once dirname( __FILE__ ) . '/Representation.php';

class Chemcaster_Service extends Chemcaster_Representation
{
    /**
     * Stores a Chemcaster_Link object
     * @var Chemcaster_Link $registries
     */
    //private $_registries;

    /**
     * Stores the service version
     * @var stdClass $service
     */
    //private $_service;

    /**
     * Stores the curl resource handle
     * @var resource $service_handle
     * @static
     */
    public static $service_handle;
/*
    public function __construct( Chemcaster_Link $Link )
    {
        $index = json_decode( $Link->get() );

        $this->_registries = new Chemcaster_Link(
            $index->registries->name,
            $index->registries->uri,
            $index->registries->media_type
        );

        $this->_service = $index->service;
    }
*/
    /**
     * Static connection method
     * @param string $username
     * @param string $password
     * @param array $options
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

    public static function enableFileAutoInclude()
    {
        spl_autoload_register('Chemcaster_Service::fileAutoLoad');
    }

    public static function fileAutoLoad( $name )
    {
        $name = str_replace('Chemcaster_', '', $name, $replaced_count);
        if( 1 === $replaced_count )
            require_once dirname(__FILE__) . '/' . $name . '.php';
    }
/*
    public function getRegistries()
    {
        return Chemcaster_Representation::factory( $this->_registries );
    }
    
    public function getService()
    {
        return $this->_service;
    }
    *
 */
}
?>
