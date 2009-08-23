<?php

abstract class Chemcaster_Representation
{
    protected $_link;

    private $_fetched;
    
    public function __construct( Chemcaster_Link $Link )
    {
        $this->_link = $Link;
    }

    public function __get( $get )
    {
        if( ! $this->_fetched )
            $this->_fetched = Chemcaster_Json::decode( $this->_link->get() );


        //check to see if $get is in the fetch object
        if( TRUE === isset( $this->_fetched->$get) )
        {
            //Link or string?
            if( TRUE === isset( $this->_fetched->$get->uri) )
            {
                //Link
                return self::factory(new Chemcaster_Link(
                    $this->_fetched->$get->name,
                    $this->_fetched->$get->uri,
                    $this->_fetched->$get->media_type
                ));
            }
            else
            {
                return $this->_fetched->$get;
            }
        }
        else
        {
            //handle error
            trigger_error("Property not found");
        }
        
    }

    public static function factory( Chemcaster_Link $Link )
    {
        preg_match('/application\/vnd.com.chemcaster.(.*)\+json/', $Link->mediaType, $matches);
        
        $class = 'Chemcaster_' . $matches[1];

        return new $class( $Link );
    }
}

?>
