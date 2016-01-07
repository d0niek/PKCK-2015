<?php

/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/7/16
 * Time: 6:58 PM
 */

namespace UtilInterface;

use SimpleXMLElement;

interface XmlEntity
{
    /**
     * Read xml tags and return entity object
     *
     * @param \SimpleXMLElement $data
     *
     * @return mixed
     */
    public static function loadFromXml(SimpleXMLElement $data);

    /**
     * Save entity object to xml
     *
     * @param \SimpleXMLElement $data
     */
    public function saveToXml(SimpleXMLElement $data);
}
