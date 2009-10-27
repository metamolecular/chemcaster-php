<?php

/**
 * Image class
 * @copyright   Copyright (c) 2009 Metamolecular, LLC
 * @license     MIT License (see 'LICENSE' file)
 * @link        http://metamolecular.com
 * @author      Rob Apodaca <rob.apodaca@gmail.com>
 */
class Chemcaster_Image extends Chemcaster_Item
{
    /**
     * Width of Image
     * @var number
     */
    public $width;

    /**
     * Height of Image
     * @var number
     */
    public $height;

    /**
     * Media type
     * @var string (image/png)
     */
    public $format;

    /**
     * Base64 encoding
     * @var string
     */
    public $data;

}

?>
