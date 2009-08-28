<?php

/**
 * Transporter class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Transporter
{
    /**
     * Curl resource ID
     * @var string
     */
    private $_conn;

    /**
     * Class constructor
     * @param string $username
     * @param string $password
     * @access public
     */
    public function __construct( $username, $password )
    {
        $this->_conn = curl_init();

        curl_setopt( $this->_conn, CURLOPT_RETURNTRANSFER, TRUE );
        curl_setopt( $this->_conn, CURLOPT_USERPWD, "{$username}:{$password}" );
        curl_setopt( $this->_conn, CURLOPT_USERAGENT, 'chemcaster-php' );
    }

    /**
     * Class destructor 
     */
    public function __destruct()
    {
        curl_close( $this->_conn );
    }

    /**
     * GETS the representation data from the service
     * @param Chemcaster_Link $Link
     * @return string
     * @access public
     */
    public function get( Chemcaster_Link $Link )
    {
        curl_setopt( $this->_conn, CURLOPT_URL, $Link->uri );
        curl_setopt( $this->_conn, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt( $this->_conn, CURLOPT_HTTPHEADER, array(
            "Accept: {$Link->mediaType}"
        ));
    
        return curl_exec( $this->_conn );
    }

    /**
     * POSTS data to the service
     * @param Chemcaster_Link $Link
     * @param string $data
     * @return string
     * @access public
     */
    public function post( Chemcaster_Link $Link, $data )
    {
        curl_setopt( $this->_conn, CURLOPT_URL, $Link->uri );
        curl_setopt( $this->_conn, CURLOPT_CUSTOMREQUEST, 'POST' );
        curl_setopt( $this->_conn, CURLOPT_HTTPHEADER, array(
            "Accept: {$Link->mediaType}",
            "Content-Type: {$Link->mediaType}"
        ));
        curl_setopt( $this->_conn, CURLOPT_POSTFIELDS, $data);
        return curl_exec( $this->_conn );
    }

    /**
     * PUTS the data to the service
     * @param Chemcaster_Link $Link
     * @param string $data
     * @return string
     * @access public
     */
    public function put( Chemcaster_Link $Link, $data )
    {
        curl_setopt( $this->_conn, CURLOPT_URL, $Link->uri );
        curl_setopt( $this->_conn, CURLOPT_CUSTOMREQUEST, 'PUT' );
        curl_setopt( $this->_conn, CURLOPT_HTTPHEADER, array(
            "Accept: {$Link->mediaType}",
            "Content-Type: {$Link->mediaType}"
        ));
        curl_setopt( $this->_conn, CURLOPT_POSTFIELDS, $data);
        return curl_exec( $this->_conn );
    }

    /**
     * Gets the last http status code from a get, post, put, or delete
     * @return int
     * @access public
     */
    public function getLastStatusCode()
    {
        return curl_getinfo( $this->_conn, CURLINFO_HTTP_CODE );
    }
}
