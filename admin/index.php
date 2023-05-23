<?php
    
    //importar coneccion
    require('../includes/config/db.php');
    $db = conectarDB();

    //escribir query
    $query = "SELECT * FROM propiedades";

    //consulta a la db

    $consulta = mysqli_query($db,$query);

    $resultado = $_GET['resultado'] ?? null;

    require '../includes/funciones.php';
    incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
    <?php if(intval($resultado) === 1):?>
        <p class="alerta exito">Post Agregado Correctamente</p>
        <?php elseif(intval($resultado) === 2):?>
            <p class="alerta exito">Post Actualizado Correctamente</p>

    <?php endif; ?>    
    <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($consulta)):?>
                  <tr>
                    
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['titulo'];?></td>
                    <td><img src="../imagenes\<?php echo $row['imagen'];?>" alt="imagen tabla" class="imagen-tabla"></td>
                    <td>$<?php echo $row['precio'];?></td>
                    <td>
                        <a href="/" class="margin-btn boton-rojo-block">Eliminar</a>
                        <a href="propiedades/actualizar.php?id=<?php echo$row['id'];?>" class="margin-btn boton-amarillo-block">Actualizar</a>
                    </td>
                    
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>

</main>

<?php

//cerrar conexion
mysqli_close($db);

include('../includes/templates/footer.php'); 

?>