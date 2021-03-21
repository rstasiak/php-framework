<?php


use Dotenv\Dotenv;

define('ROOT_DIR', realpath(__DIR__));

require_once ROOT_DIR . "/vendor/autoload.php";

$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();

