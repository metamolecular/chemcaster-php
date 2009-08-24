<?php

/**
 * Json class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Json
{
    /**
     * Similar to cor json_decode but creates Chemcaster_Representation objects
     * for second level objects instead of stdClass objects
     * @param string $json_string
     * @return Chemcaster_Representation
     * @static
     * @access public
     */
    public static function decode( $json_string )
    {
        $decode = json_decode( $json_string );

        $new_obj = new stdClass;
        foreach( $decode as $key => $value )
        {
            if( TRUE === is_array($value) )
            {
                $tmp_array = array();
                foreach( $value as $k => $v )
                {
                    $tmp_array[] = Chemcaster_Service::factory( new Chemcaster_Link(
                        $v->name,
                        $v->uri,
                        $v->media_type
                    ));

                }
                $new_obj->$key = $tmp_array;
            }
            else
            {
                $new_obj->$key = $value;
            }
        }

        return $new_obj;
    }
}
