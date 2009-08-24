<?php

/**
 * Registry class
 * @copyright   Copyright (c) 2009, Metamolecular, LLC
 * @license     http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 * @property-read string $name
 */
class Chemcaster_Registry extends Chemcaster_Representation
{
    protected $_attributes = array( 'name' );

    protected $_resources = array( 'queries', 'structures');
}

