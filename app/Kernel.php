<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 4:06 PM
 */

use Entity\Collection;

class Kernel
{
    /** @var \Entity\Collection $collection */
    private $collection;

    public function __construct($xmlFile)
    {
        $collectionXml = new SimpleXMLElement(file_get_contents($xmlFile));

        $this->collection = Collection::loadFromXml($collectionXml);
    }

    public function start()
    {
        
    }
}
