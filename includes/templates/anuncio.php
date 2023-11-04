<?php
    use App\Propiedad;

    if($_SERVER['SCRIPT_NAME'] === "/bienesraices/anuncios.php"){
        $propiedades = Propiedad::all();
        
    }else{
        
        $propiedades = Propiedad::get(3);
    }


?>

<div class="contenedor-anuncios">

    <?php foreach($propiedades as $row): ?>

    <div class="anuncio">

                <picture>

                    <img src="imagenes/<?php echo $row->imagen;?>" loading="lazy" alt="">
                </picture>
                <div class="contenido-anuncio">
                    <h3><?php echo $row->titulo;?></h3>
                    <p><?php echo $row->descripcion?></p>
                    <p class="precio">$<?php echo number_format($row->precio);?></p>

                    <ul class="iconos-caracteristicas">

                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" loading="lazy" alt="icono wc">
                            <p><?php echo $row->wc;?></p>
                        </li>

                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" loading="lazy" alt="icono estacionamiento">
                            <p><?php echo $row->estacionamiento;?></p>
                        </li>

                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" loading="lazy" alt="icono estacionamiento">
                            <p><?php echo $row->habitaciones;?></p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $row->id;?>"  class="boton-amarillo-block">Ver propiedad</a>
                </div>
            </div>
            <?php endforeach;?>
            </div>


            <?php mysqli_close($db);?>