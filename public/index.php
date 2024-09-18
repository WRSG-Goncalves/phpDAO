<?php

require_once("config.php");
require __DIR__ . '/../vendor/autoload.php';

use Wrsg\App\DatabaseFactory;
use Wrsg\App\UserRepository;


$databaseConnection = DatabaseFactory::create();

$userRepository = new UserRepository($databaseConnection);


// $strSql = $userRepository->select('SELECT * FROM usuarios WHERE id = :id', ['id' => 1]);


// var_dump($strSql);

$resultsWithoutParams = $userRepository->selectWithoutParams('SELECT * FROM usuarios');
var_dump( $resultsWithoutParams);


// $success = $userRepository->query('UPDATE usuarios SET name = :name WHERE id = :id', ['nome' => 'John', 'id' => 1]);


// echo $success ? 'Atualizado com sucesso!' : 'Falha na atualização';




