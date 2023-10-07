<?php
        $db = conectarDB();

        //consulta
        $query = "SELECT * FROM propiedades LIMIT {$limit}";
        $resultado = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">

    <?php while($row = mysqli_fetch_assoc($resultado)): ?>

    <div class="anuncio">

                <picture>

                    <img src="imagenes/<?php echo $row['imagen'];?>" loading="lazy" alt="">
                </picture>
                <div class="contenido-anuncio">
                    <h3><?php echo $row['titulo'];?></h3>
                    <p><?php echo $row['descripcion'];?></p>
                    <p class="precio">$<?php echo number_format($row['precio']);?></p>

                    <ul class="iconos-caracteristicas">

                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" loading="lazy" alt="icono wc">
                            <p><?php echo $row['wc'];?></p>
                        </li>

                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" loading="lazy" alt="icono estacionamiento">
                            <p><?php echo $row['estacionamiento'];?></p>
                        </li>

                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" loading="lazy" alt="icono estacionamiento">
                            <p><?php echo $row['habitaciones'];?></p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $row['id'];?>"  class="boton-amarillo-block">Ver propiedad</a>
                </div>
            </div>
            <?php endwhile?>
            </div>


            <?php mysqli_close($db);?>