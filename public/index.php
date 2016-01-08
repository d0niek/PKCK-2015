<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 2:57 PM
 */

require_once '../vendor/autoload.php';

use Entity\Collection;

define('ROOT_PATH', dirname(__DIR__));
define('XML_FILE', ROOT_PATH . '/kolekcja.xml');

if (file_exists(XML_FILE)) {
    $collectionXml = new SimpleXMLElement(file_get_contents(XML_FILE));

    $collection = Collection::loadFromXml($collectionXml);
} else {
    echo 'File <b>' . XML_FILE . '</b> dose not exists!';
}
