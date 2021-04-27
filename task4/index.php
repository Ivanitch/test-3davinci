<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use App\{DB, Category};

try {
    $connection = new DB();
    $categoryModel = new Category($connection);
    $data = $categoryModel->getCategories();
    $tree = $categoryModel->createTree($data);
    $categoryModel->renderTemplate($tree);
} catch (Exception $e) {
    echo $e->getMessage();
}
