<?php 

    require "funciones.php";
    require "config/db.php";
    require __DIR__ . "/../vendor/autoload.php";

    $db = conectarDB();

    use App\ActiveRecord;
    


    ActiveRecord::setDB($db);

