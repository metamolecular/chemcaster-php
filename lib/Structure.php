<?php

/**
 * Registry class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 * @property-read string $name
 * @property-read string $molfile
 */
class Chemcaster_Structure extends Chemcaster_Representation
{
    protected $_attributes = array( 'name', 'molfile', 'inchi');

    protected $_resources = array( 'images', 'registry');

    public function update( $params )
    {
        $this->_fetch();

        $update_link = new Chemcaster_Link(
            $this->_fetched->update->name,
            $this->_fetched->update->uri,
            $this->_fetched->update->media_type
        );
        $update_link->put( $params );
    }

    public function destroy()
    {
        $this->_fetch();

        $link = new Chemcaster_Link(
            $this->_fetched->update->name,
            $this->_fetched->update->uri,
            $this->_fetched->update->media_type
        );
        $link->delete();
    }
}

