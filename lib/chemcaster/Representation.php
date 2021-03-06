<?php

/**
 * Representation class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Representation
{
    /**
     * The transporter object
     * @var Chemcaster_Transporter
     */
    protected $_transporter;

    /**
     * Holds array of links. Override in sub classes for specific Representations
     * @var array
     */
    protected $links = array();

    /**
     * Class constructor
     * @param Chemcaster_Transporter $transporter
     * @param mixed $link - Chemcaster_Link or raw json data
     * @access public
     */
    public function __construct( Chemcaster_Transporter $transporter, $link )
    {
        $this->_transporter = $transporter;

        $class = strtolower( str_replace('Chemcaster_', '', get_class($this)) );

        if( TRUE === is_object($link) )
        {
            $raw_data = $this->_transporter->get($link);
            if( FALSE === $raw_data )
            {
                $http_error = $this->_transporter->getLastStatusCode();
                trigger_error( "Problem getting data. Server http status: $http_error" );
                return;
            }
        }
        else
        {
            $raw_data = $link;
        }

        $decoded_obj = json_decode($raw_data);
        foreach( $decoded_obj as $name => $value )
        {
            if( $name === $class )
            {
                foreach( $value as $k => $v )
                {
                    if( TRUE === is_array($this->$k) )
                        foreach( $v as $vv )
                            array_push($this->$k, $vv);
                    else
                        $this->$k = $v;
                }
            }
            else if( TRUE === is_array($value) )
            {
                $this->$name = array();
                foreach( $value as $v )
                    $this->{$name}[] = new Chemcaster_Link($v->name, $v->uri, $v->media_type);
            }
            else
            {
                $this->links[$name] = new Chemcaster_Link($value->name, $value->uri, $value->media_type);
            }
        }
    }

    /**
     * Magic get method. Allows dynamic access to keys stored in _links
     * @param string $property
     * @return Chemcaster_Link
     * @access public
     */
    public function __get( $property )
    {
        if( TRUE === array_key_exists($property, $this->links) && '' !== $this->links[$property] )
        {
            $link = $this->links[$property];
            return $this->_factory( $link );
        }
        else
        {
            $debug = debug_backtrace();
            $file = $debug[0]['file'];
            $line = $debug[0]['line'];
            $error = "Unknown property $property called from file: $file on line: $line "
                   . "in class " . get_class($this);
            trigger_error($error);
        }
    }

    /**
     * Create a new Representation object based on supplied link
     * @param Chemcaster_Link $Link
     * @return mixed
     * @access protected
     */
    protected function _factory( Chemcaster_Link $Link )
    {
        preg_match('/application\/vnd.com.chemcaster.(.*)\+json/', $Link->mediaType, $matches);

        $class = 'Chemcaster_' . $matches[1];

        return new $class( $this->_transporter, $Link );
    }

    /**
     * Creates a new link from supplied json
     * @param string $json_string
     * @return Chemcaster_Link
     */
    protected function _makeLink( $json_string )
    {
        $obj = json_decode( $json_string );
        return new Chemcaster_Link($obj->name, $obj->uri, $obj->mediaType);
    }
}
