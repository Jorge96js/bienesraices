<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>

<?php include('includes/templates/header.php')?>

    
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de casa destacada">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">
                $3,000,000
            </p>

            <ul class="iconos-caracteristicas">

                <li>
                    <img src="build/img/icono_wc.svg" loading="lazy" alt="icono wc">
                    <p>3</p>
                </li>

                <li>
                    <img src="build/img/icono_estacionamiento.svg" loading="lazy" alt="icono estacionamiento">
                    <p>3</p>
                </li>

                <li>
                    <img src="build/img/icono_dormitorio.svg" loading="lazy" alt="icono estacionamiento">
                    <p>4</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit reprehenderit asperiores excepturi harum, nihil eaque unde obcaecati expedita labore repellat eum soluta ut deserunt consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt sit id magni hic doloribus cumque consectetur maxime necessitatibus nisi ipsa aliquam vitae quae voluptatem suscipit ullam dignissimos, maiores nobis fuga? Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quae corrupti voluptatum, aperiam aut non quia sapiente pariatur, quo explicabo modi itaque et blanditiis possimus dolores veniam libero impedit magni quis ad adipisci assumenda vitae, placeat culpa! Necessitatibus cumque quia rem suscipit nostrum? Blanditiis tempora magni mollitia quia perferendis. Quam corporis tempore repudiandae quis quo sed ipsam reprehenderit cupiditate illo quia eius libero totam fugit ad sit, hic mollitia eaque.
            </p>

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt cum totam accusantium soluta dolor corporis error illo alias blanditiis, explicabo animi eum officiis quaerat reprehenderit magnam debitis fugiat est corrupti, perspiciatis consectetur nam accusamus a! Excepturi deleniti molestias eveniet doloribus tempora repellat, consequuntur quasi voluptatum pariatur ad reiciendis earum velit corporis mollitia exercitationem autem voluptates beatae debitis, nemo voluptatibus nisi perspiciatis 
            </p>
        </div>
    </main>

    <?php include('includes/templates/footer.php'); ?>