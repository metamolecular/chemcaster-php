<?php

/**
 * Base abstract Representation class
 * @abstract
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
abstract class Chemcaster_Representation
{
    /**
     * Stores the Link object for this representation
     * @var Chemcaster_Link $_link
     */
    protected $_link;

    /**
     * Holds the representation attribute names
     * @var array $_attributes
     */
    protected $_attributes = array();

    /**
     * Holds the representation resource names
     * @var array  $_resources
     */
    protected $_resources = array();

    /**
     * Stores the fetched json as stdClass object
     * @var stdClass $_fetched
     */
    protected $_fetched;

    /**
     * Class Constructor
     * @param Chemcaster_Link $Link
     */
    public function __construct( Chemcaster_Link $Link )
    {
        $this->_link = $Link;
    }

    /**
     * Magic get method
     * @param string $get
     * @return mixed Chemcaster_Representation or string
     */
    public function __get( $get )
    {
        $this->_fetch();

        if( TRUE === in_array($get, $this->_attributes) )
        {
            $class = get_class( $this );
            $class = str_replace('Chemcaster_', '', $class);
            $class = strtolower($class);
            
            $this->$get = $this->_fetched->$class->$get;

            return $this->$get;
        }
        else if( TRUE === in_array($get, $this->_resources) )
        {
            $this->$get = self::factory(new Chemcaster_Link(
                $this->_fetched->$get->name,
                $this->_fetched->$get->uri,
                $this->_fetched->$get->media_type
            ));
            return $this->$get;
        }
        else
        {
            $debug = debug_backtrace();
            $file = $debug[0]['file'];
            $line = $debug[0]['line'];
            $error = "Unknown property $get called from file: $file on line: $line "
                   . "in class " . get_class($this);
            trigger_error($error);
        }
    }

    /**
     * Fetches the _link if not already fetched and stores in _fetched
     */
    protected function _fetch()
    {
        if( ! $this->_fetched )
            $this->_fetched = Chemcaster_Json::decode( $this->_link->get() );
    }

    /**
     * Factory method creates appropriate Representation object based on Link
     * @param Chemcaster_Link $Link
     * @return mixed Chemcaster_Representation object
     */
    public static function factory( Chemcaster_Link $Link )
    {
        preg_match('/application\/vnd.com.chemcaster.(.*)\+json/', $Link->mediaType, $matches);
        
        $class = 'Chemcaster_' . $matches[1];

        return new $class( $Link );
    }
}

