<?php 
function conectarDB() : mysqli {
    
    $servidor = 'localhost';
    $usuario = 'root';
    $password = '';
    $basededatos = 'crud_bienesraices';
   
    $db = mysqli_connect($servidor, $usuario, $password, $basededatos);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit();
    } else{
        return $db;
    }

}


