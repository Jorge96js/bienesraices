<?php
    //importar conexion
    require 'includes/config/db.php';
    $db = conectarDB();

    //usuario
    $email = "agustin@correo.com";
    $password = "123456";

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    echo $passwordHash;
    //qry para crear el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";
    //agregar a la bd
    mysqli_query($db,$query);

