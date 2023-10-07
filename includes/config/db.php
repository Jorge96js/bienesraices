<?php 
function conectarDB() : mysqli {
    
    $servidor = 'localhost';
    $usuario = 'root';
    $password = 'root';
    $basededatos = 'crud_bienesraices';
   
    $db = new mysqli($servidor, $usuario, $password, $basededatos);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit();
    }
      return $db;
    

}


