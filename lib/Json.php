<?php

class Chemcaster_Json
{
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

?>
