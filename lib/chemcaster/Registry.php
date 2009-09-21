<?php

/**
 * Registry class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Registry extends Chemcaster_Item
{
    protected $_links = array(
        'service'           => '',
        'substances'        => '',
        'structures'        => '',
        'queries'           => '',
        'registrations'     => '',
        'index'             => '',
        'update'            => '',
        'destroy'           => ''
    );
}
