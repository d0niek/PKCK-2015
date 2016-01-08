<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 2:57 PM
 */

require_once '../vendor/autoload.php';

define('ROOT_PATH', dirname(__DIR__));
define('XML_FILE', ROOT_PATH . '/kolekcja.xml');

if (file_exists(XML_FILE)) {
    $kernel = new Kernel(XML_FILE);

    $kernel->start();
} else {
    echo 'File <b>' . XML_FILE . '</b> dose not exists!';
}
