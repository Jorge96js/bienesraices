<?php
session_start(); // Iniciar la sesión antes de verificar $_SESSION

$auth = $_SESSION['login'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet"  href="/bienesraices/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="Logo de bienes raices">
                </a> 

                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="">
                </div>

                <div class="derecha">
                    <img src="/bienesraices/build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth): ?>
                        <a href="cerrar-sesion.php">Cerrar sesion</a>
                        <?php endif;?>
                    </nav>
                </div>
                
            </div>
            <?php if($inicio){?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php }?>
        </div>
    </header>