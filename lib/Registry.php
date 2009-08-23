<?php

class Chemcaster_Registry extends Chemcaster_Representation
{
    /*
    public $queries;
    
    public $index;
    
    public $update;
    
    public $registry;
    
    public $structures;

    public function __construct( Chemcaster_Link $Link )
    {
        $index = json_decode( $Link->get() );

        $this->queries = new Chemcaster_Link(
            $index->queries->name,
            $index->queries->uri,
            $index->queries->media_type
        );

        $this->index = new Chemcaster_Link(
            $index->index->name,
            $index->index->uri,
            $index->index->media_type
        );

        $this->update = new Chemcaster_Link(
            $index->update->name,
            $index->update->uri,
            $index->update->media_type
        );

        $this->structures = new Chemcaster_Link(
            $index->structures->name,
            $index->structures->uri,
            $index->structures->media_type
        );

        $this->registry = $index->registry;
    }

    public function getStructures()
    {
        return Chemcaster_Representation::factory( $this->structures );
    }

    public function getQueries()
    {
        return Chemcaster_Representation::factory( $this->queries );
    }

    public function getIndex()
    {
        return Chemcaster_Representation::factory( $this->index );
    }
    *
     */
}

?>
