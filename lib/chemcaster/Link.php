<?php

/**
 * Link class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Link
{
    /**
     * The name of the Link
     * @var string $name
     */
    public $name;

    /**
     * The uri of the Link
     * @var string $uri
     */
    public $uri;

    /**
     * The media type of the Link
     * @var string $uri
     */
    public $mediaType;

    /**
     * Class constructor
     * @param sring $name
     * @param string $uri
     * @param string $media_type
     */
    public function __construct( $name, $uri, $media_type )
    {
        $this->name         = $name;
        $this->uri          = $uri;
        $this->mediaType    = $media_type;
    }

    /**
     * Performs a "GET" on the link
     * @return string the json returned string
     * @access public
     */
    public function get( )
    {
        return $this->_request( 'GET' );
    }

    /**
     * Performs a "POST" on the link
     * @param array $args
     * @return string the json returned string
     * @access public
     */
    public function post( $args )
    {
        $encode = json_encode($args);
        
        curl_setopt(Chemcaster_Service::$service_handle, CURLOPT_POSTFIELDS, $encode);
        $post = $this->_request( 'POST' );
        return $post;
    }

    /**
     * Performs a "PUT" on the link
     * @param array $args
     * @return string the json returned string
     * @access public
     */
    public function put( $args )
    {
        $encode = json_encode($args);

        curl_setopt(Chemcaster_Service::$service_handle, CURLOPT_POSTFIELDS, $encode);
        return $this->_request( 'PUT' );
    }

    /**
     * Performs a "DELETE" on the link
     * @return string the json returned string
     * @access public
     */
    public function delete()
    {
        return $this->_request( 'DELETE' );
    }

    /**
     * Internal method request
     * @param string $method
     * @return string the json returned string
     */
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
            case 'PUT':
                $this->_setRequest( 'PUT' );
                curl_setopt( Chemcaster_Service::$service_handle, CURLOPT_HTTPHEADER, array(
                    "Accept: {$this->mediaType}",
                    "Content-Type: {$this->mediaType}"
                ));
                break;
            case 'DELETE':
                $this->_setRequest( 'DELETE' );
                curl_setopt( Chemcaster_Service::$service_handle, CURLOPT_HTTPHEADER, array(
                    "Accept: {$this->mediaType}"
                ));
                break;
        }

        $this->_setUri();

        $fetched = curl_exec( Chemcaster_Service::$service_handle );
        
        // todo:  handle errors
        
        return $fetched;
    }

    /**
     * sets the uri to request
     * @access private
     */
    private function _setUri()
    {
        curl_setopt( Chemcaster_Service::$service_handle, CURLOPT_URL, $this->uri );
    }

    /**
     * Sets the request method
     * @param string $method
     * @access private
     */
    private function _setRequest( $method )
    {
        curl_setopt( Chemcaster_Service::$service_handle, CURLOPT_CUSTOMREQUEST, $method );
    }

}

