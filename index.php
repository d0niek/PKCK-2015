<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 2:57 PM
 */

require_once 'vendor/autoload.php';

use Entity\Collection;

define('ROOT_PATH', dirname(__FILE__));
define('XML_FILE', ROOT_PATH . '/kolekcja.xml');

if (file_exists(XML_FILE)) {
    $collectionXml = new SimpleXMLElement(file_get_contents(XML_FILE));

    $collection = Collection::loadFromXml($collectionXml);



    $root = '<?xml version="1.0" encoding="utf-8"?>' .
        '<?xml-stylesheet type="text/xsl" href="kolekcja-pomocnicza.xsl"?>' .
        '<!DOCTYPE kolekcja SYSTEM "kolekcja.dtd">' .
        '<kolekcja/>';

    $collection->saveToXml(new SimpleXMLElement($root));
} else {
    echo 'File <b>' . XML_FILE . '</b> dose not exists!';
}
