<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);



    require('includes/app.php');
    $db = conectarDB();

    //consulta
    $query = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $query);

    $propiedad = mysqli_fetch_assoc($resultado);

    if(!$resultado->num_rows){
        header('Location: /');
    }

    incluirTemplate('header');
?>

    
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']?></h1>
            <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen'];?>" alt="Imagen de casa destacada">
        <div class="resumen-propiedad">
            <p class="precio">
                $<?php echo number_format($propiedad['precio'])?>
            </p>

            <ul class="iconos-caracteristicas">

                <li>
                    <img src="build/img/icono_wc.svg" loading="lazy" alt="icono wc">
                    <p><?php echo $propiedad['wc']?></p>
                </li>

                <li>
                    <img src="build/img/icono_estacionamiento.svg" loading="lazy" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']?></p>
                </li>

                <li>
                    <img src="build/img/icono_dormitorio.svg" loading="lazy" alt="icono estacionamiento">
                    <p><?php echo $propiedad['habitaciones']?></p>
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

    <?php
        mysqli_close($db);
        include('includes/templates/footer.php');
    ?>