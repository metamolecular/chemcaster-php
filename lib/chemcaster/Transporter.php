<?php

/**
 * Transporter class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
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
     * Last http result string
     * @var string
     */
    private $_lastResult;

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
     * @return string|boolean FALSE if error
     * @access public
     */
    public function get( Chemcaster_Link $Link )
    {
        curl_setopt( $this->_conn, CURLOPT_URL, $Link->uri );
        curl_setopt( $this->_conn, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt( $this->_conn, CURLOPT_POSTFIELDS, array());
        curl_setopt( $this->_conn, CURLOPT_HTTPHEADER, array(
            "Accept: {$Link->mediaType}"
        ));
    
         $this->_lastResult = curl_exec( $this->_conn );

        $stat_code = (string) $this->getLastStatusCode();

        if( '2' == $stat_code[0] )
            return  $this->_lastResult;
        else
            return FALSE;
    }

    /**
     * POSTS data to the service
     * @param Chemcaster_Link $Link
     * @param string $data
     * @return string|boolean  FALSE if error
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

         $this->_lastResult = curl_exec( $this->_conn );

        $stat_code = (string) $this->getLastStatusCode();

        if( '2' == $stat_code[0] )
            return  $this->_lastResult;
        else
            return FALSE;
    }

    /**
     * PUTS the data to the service
     * @param Chemcaster_Link $Link
     * @param string $data
     * @return string|boolean  FALSE if error
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

         $this->_lastResult = curl_exec( $this->_conn );

        $stat_code = (string) $this->getLastStatusCode();

        if( '2' == $stat_code[0] )
            return  $this->_lastResult;
        else
            return FALSE;
    }

    /**
     * DELETES the Resource represented by the link
     * @param Chemcaster_Link $Link
     * @return string|boolean  FALSE if error
     * @access public
     */
    public function delete( Chemcaster_Link $Link )
    {
        curl_setopt( $this->_conn, CURLOPT_URL, $Link->uri );
        curl_setopt( $this->_conn, CURLOPT_CUSTOMREQUEST, 'DELETE' );
        curl_setopt( $this->_conn, CURLOPT_POSTFIELDS, array());
        curl_setopt( $this->_conn, CURLOPT_HTTPHEADER, array(
            "Accept: {$Link->mediaType}"
        ));

        $this->_lastResult = curl_exec( $this->_conn );

        $stat_code = (string) $this->getLastStatusCode();

        if( '2' == $stat_code[0] )
            return  $this->_lastResult;
        else
            return FALSE;
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

    /**
     * Gets the last http result as string
     * @return string
     */
    public function getLastResult()
    {
        return $this->_lastResult;
    }
}
