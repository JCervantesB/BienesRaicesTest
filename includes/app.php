<?php

require __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require "funciones.php";
require "databases.php";


//Conectar a la DB
use Model\activeRecord;
activeRecord::setDB($db);

