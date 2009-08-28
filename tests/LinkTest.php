<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');

class LinkTest extends PHPUnit_Framework_TestCase
{
    public function testNewLink()
    {
        $name = 'foos';
        $uri  = '/foo';
        $media_type = 'application/vnd.com.chemcaster.Foo+json';

        $link = new Chemcaster_Link($name, $uri, $media_type);
        $this->assertTrue( 'Chemcaster_Link' === get_class($link) );
        $this->assertSame($link->name, $name);
        $this->assertSame($link->uri, $uri);
        $this->assertSame($link->mediaType, $media_type);
    }

    public function testGetRepresentationName()
    {
        $name = 'foos';
        $uri  = '/foo';
        $media_type = 'application/vnd.com.chemcaster.Foorep+json';

        $link = new Chemcaster_Link($name, $uri, $media_type);

        $rep_name = $link->getRepresentationName();
        $this->assertSame('Foorep', $rep_name);
    }
}

?>
