<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 2:57 PM
 */

require_once 'vendor/autoload.php';

use Entity\Collection;

$xmlFile = dirname(__FILE__) . '/kolekcja.xml';
$collection = new Collection();

if (file_exists($xmlFile)) {
    $collection->loadFromXml($xmlFile);
}
