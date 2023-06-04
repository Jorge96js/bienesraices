<?php 
    require '../../includes/funciones.php';
    $auth = estaAutenticado();
    if(!$auth){
        Header('Location: ../index.php');
    }
    require '../../includes/config/db.php';
    $db = conectarDB();

    
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);
    
    $errores = [];

    $titulo ='' ;
    $precio = '';
    $descripcion ='' ;
    $habitaciones ='' ;
    $wc ='' ;
    $estacionamiento ='' ;
    $vendedores_id ='' ;
   
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
        $imagen = $_FILES['imagen'];


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
        if(!$imagen){
            $errores[] = "Inserte una imagen";
        }

        #validar por tamaño (1mb max)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida){ 

            $errores[] = "Imagen demasiado pesada";

        }


        if(empty($errores)){


            /** SUBIDA DE ARCHIVOS **/

            #crear carpeta
            $carpetaImagenes = '../../imagenes/';
            
            
            if(!is_dir($carpetaImagenes)){
                #crea la carpeta si no esta
                mkdir($carpetaImagenes);
            }
            
            #generar nombre unico
            $nombreImagen = md5( uniqid(rand(), true)) . ".jpg";
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);


            //insertar en la BD 
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$titulo', '$precio', '$nombreImagen','$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedores_id');";
            
            
            #echo $query;
            
            $resultado = mysqli_query($db, $query);
    
            if($resultado){

                header('Location: ../index.php?resultado=1');
            }
        }      
    }
    
    incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error  ): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST" action="/bienesraices/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $titulo;?>">

            <label for="precio">Precio:</label>
            <input type="number"  id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio;?>">

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="imagen/jpeg, image/png">

            <label for="descripcion">Descripcion:</label>
            <textarea  id="descipcion" name="descripcion" value="<?php echo $descripcion;?>" ></textarea>
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
        <input type="submit" value="Crear propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>