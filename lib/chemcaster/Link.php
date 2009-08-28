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
     * Name of the link
     * @var string
     */
    public $name;

    /**
     * The uri of the link
     * @var string
     */
    public $uri;

    /**
     * Media Type of the link
     * @var string
     */
    public $mediaType;

    /**
     * Class Constructor
     * @param string $name
     * @param string $uri
     * @param string $media_type
     * @access public
     */
    public function __construct( $name, $uri, $media_type )
    {
        $this->name         = $name;
        $this->uri          = $uri;
        $this->mediaType    = $media_type;
    }

    /**
     * Extracts the Representation name from the link
     * @return string
     * @access public
     */
    public function getRepresentationName()
    {
        preg_match('/application\/vnd.com.chemcaster.(.*)\+json/', $this->mediaType, $matches);

        return $matches[1];
    }
}