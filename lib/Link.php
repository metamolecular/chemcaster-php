<?php

class Chemcaster_Link
{
    public $name;
    public $uri;
    public $mediaType;

    //public $resource_type;

    public function __construct( $name, $uri, $media_type )
    {
        $this->name         = $name;
        $this->uri          = $uri;
        $this->mediaType    = $media_type;
    }

    public function get( )
    {
        return $this->_request( 'GET' );
    }

    public function post( $args )
    {
        $encode = json_encode($args);
        
        curl_setopt(Chemcaster_Service::$service_handle, CURLOPT_POSTFIELDS, $encode);
        return $this->_request( 'POST' );
    }

    private function _request( $method )
    {
        switch( $method )
        {
            case 'GET':
                $this->_setRequest( 'GET' );
                curl_setopt( Chemcaster_Service::$service_handle, CURLOPT_HTTPHEADER, array(
                    "Accept: {$this->mediaType}"
                ));
                break;
            
            case 'POST':
                $this->_setRequest( 'POST' );
                curl_setopt( Chemcaster_Service::$service_handle, CURLOPT_HTTPHEADER, array(
                    "Accept: {$this->mediaType}",
                    "Content-Type: {$this->mediaType}"
                ));
                break;
            
        }

        $this->_setUri();

        $fetched = curl_exec( Chemcaster_Service::$service_handle );
        
        //check http status... and handle errors
        
        return $fetched;
    }

    private function _setUri()
    {
        curl_setopt( Chemcaster_Service::$service_handle, CURLOPT_URL, $this->uri );
    }

    private function _setRequest( $method )
    {
        curl_setopt( Chemcaster_Service::$service_handle, CURLOPT_CUSTOMREQUEST, $method );
    }

}

?>
