<?php


    require '../includes/app.php';
    incluirTemplate('header', $inicio = true);

    phpErrores();
    use App\Propiedad;
    use App\Vendedores;
    
    //importar coneccion
    $db = conectarDB();


    //metodo para obtener propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedores::all();

    $resultado = $_GET['resultado'] ?? null;


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);


        if($id){
            
            $tipo = $_POST['tipo'];
            if(validarTipoContenido($tipo)){
                if($tipo === 'vendedor') {
                    $vendedor = Vendedores::find($id);
                    $vendedor->eliminar();
                } else if($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }


        }
    }
?>


<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
    <?php
    $mensaje = mostrarAlerta(intval($resultado));
    if($mensaje):?>
        <p class="alerta exito"><?php echo s($mensaje);?></p>
    <?php endif;?>
    <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
    <a href="/bienesraices/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

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
                <?php foreach($propiedades as $row):?>
                  <tr>
                    
                    <td><?php echo $row->id;?></td>
                    <td><?php echo $row->titulo;?></td>
                    <td><img src="../imagenes\<?php echo $row->imagen;?>" alt="imagen tabla" class="imagen-tabla"></td>
                    <td>$<?php echo $row->precio;?></td>
                    <td>
                        <form method="POST"  class="w-100">
                            <input type="hidden" name="id" value="<?php echo $row->id;?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" value="Eliminar" href="/" class="margin-btn boton-rojo-block">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo$row->id;?>" class="margin-btn boton-amarillo-block">Actualizar</a>
                    </td>
                    
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            
        <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($vendedores as $row):?>
                  <tr>
                    
                    <td><?php echo $row->id;?></td>
                    <td><?php echo $row->nombre . " " . $row->apellido;?></td>
                    <td><?php echo $row->telefono;?></td>
                    <td>
                        <form method="POST"  class="w-100">
                            <input type="hidden" name="id" value="<?php echo $row->id;?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" value="Eliminar" href="/" class="margin-btn boton-rojo-block">
                        </form>
                        <a href="vendedores/actualizar.php?id=<?php echo$row->id;?>" class="margin-btn boton-amarillo-block">Actualizar</a>
                    </td>
                    
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
</main>

<?php

//cerrar conexion
mysqli_close($db);

include('../includes/templates/footer.php'); 

?>