<?php

require_once("config.php");
require __DIR__ . '/../vendor/autoload.php';

use Wrsg\App\factory\DatabaseFactory;
use Wrsg\App\repository\DB;

$databaseConnection =  DatabaseFactory::create();
$db = new DB($databaseConnection);
$usuarios = $db->select("SELECT * FROM usuarios");

echo json_encode($usuarios);

