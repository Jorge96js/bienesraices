<?php 
        require '../../includes/funciones.php';
        $auth = estaAutenticado();
        if(!$auth){
            Header('Location: /');
        }

    //Validar id por id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location: ../index.php');
    }

    require '../../includes/config/db.php';
    $db = conectarDB();
    //consulta para actualizar la propiedad

    $consultaUpdate = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultadoUpdate = mysqli_query($db, $consultaUpdate);
    $propiedad = mysqli_fetch_assoc($resultadoUpdate);

    //consulta para obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);
    
    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc =$propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedores_id = $propiedad['vendedores_id'];
    $imagenPropiedad = $propiedad['imagen'];


    $imagen = $_FILES['imagen'];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      /*  echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";*/
        
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id']);
        $creado = mysqli_real_escape_string($db, date('Y/m/d'));


        if(!$titulo){ 

            $errores[] = "Inserte un titulo";
        }

        if(!$precio){ 

            $errores[] = "Inserte un precio";

        }        
        if(!$descripcion){ 

            $errores[] = "Inserte una descripcion";

        }
        if(!$habitaciones){ 

            $errores[] = "Inserte el numero de habitaciones";

        }     
        if(!$wc){ 

            $errores[] = "Inserte el numero de baños";

        }        
        if(!$estacionamiento){ 

            $errores[] = "Inserte el numero de estacuibanuebtis";

        }  
        if(!$vendedores_id){
            $errores[] = "Inserte un vendedor";
        }


        #validar por tamaño (1mb max)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida){ 

            $errores[] = "Imagen demasiado pesada";

        }


        if(empty($errores)){


            #crear carpeta
            $carpetaImagenes = '../../imagenes/';
            
            
            if(!is_dir($carpetaImagenes)){
                #crea la carpeta si no esta
                mkdir($carpetaImagenes);
            }
            $nombreImagen ='';
            /** SUBIDA DE ARCHIVOS **/

            if($imagen['name']){
                unlink($carpetaImagenes . $propiedad['imagen']);

                #generar nombre unico
                $nombreImagen = md5( uniqid(rand(), true)) . ".jpg";
                #subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }else{
                $nombreImagen = $propiedad['imagen'];
            }

            


            //insertar en la BD 
            $query = "UPDATE propiedades SET titulo = '${titulo}',precio = '${precio}',imagen = '${nombreImagen}' '',descripcion = '${descripcion}',habitaciones = ${habitaciones},wc = ${wc},estacionamiento = ${estacionamiento},estacionamiento = ${estacionamiento}, vendedores_id = ${vendedores_id} WHERE id = ${id};";
            
            
            //echo $query;

            
            $resultado = mysqli_query($db, $query);
    
            if($resultado){

                header('Location: ../index.php?resultado=2');
            }
        }      
    }
    
    incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Actualizar propiedad</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error  ): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $titulo;?>">

            <label for="precio">Precio:</label>
            <input type="number"  id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio;?>">

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="imagen/jpeg, image/png">
                <img src="../../imagenes/<?php echo $imagenPropiedad?>" class="imagen-small" alt="">
            <label for="descripcion">Descripcion:</label>
            <textarea  id="descipcion" name="descripcion" value="" ><?php echo $descripcion;?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" value="<?php echo $habitaciones;?>" placeholder="Ej: 3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" value="<?php echo $wc;?>" placeholder="Ej: 3" min="1" max="9">

            <label for="estacionamiento">Estacionamientos:</label>
            <input type="number" id="estacionamiento" name="estacionamiento"  value="<?php echo $estacionamiento;?>" placeholder="Ej: 3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id">
                <option disabled selected>-- Seleccione --</option>
                <?php while($row = mysqli_fetch_assoc($resultado) ): ?>
                    <option <?php echo $vendedores_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id'];?>"> <?php echo $row['nombre'] . " " . $row['apellido'];?>
                 </option>
                <?php endwhile;?>
            </select>
        </fieldset> 
        <br>
        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>