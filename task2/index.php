<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'CustomXMLReader.php';

try {
    echo (new CustomXMLReader())
        ->referenceFirstElement('task2.xml');
} catch (Exception $e) {
    echo $e->getMessage();
}
