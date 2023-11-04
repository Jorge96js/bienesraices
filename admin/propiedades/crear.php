<?php 
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedores;
    use Intervention\Image\ImageManagerStatic as Image;




     $db = conectarDB();
     $propiedad = new Propiedad();

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    $errores = Propiedad::getErrores();

    $errores = [];
    $vendedores = Vendedores::all();



   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //crea nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);
        
        /** SUBIDA DE ARCHIVOS **/
        
        //generar nombre unico
        $nombreImagen = md5( uniqid(rand(), true)) . ".jpg";


         //Realiza un resize a la imagen
         if($_FILES['propiedad']['tmp_name']['imagen']){
             $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
             $propiedad->setImagen($nombreImagen);
         }

        
        $errores = $propiedad->validar();

        if(empty($errores)){
            

            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //guardar img en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
            //$resultado = mysqli_query($db, $query);
            $propiedad->crear();


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
        <?php include '../../includes/templates/form_propiedades.php';?>
        <input type="submit" value="Crear propiedad" class="boton boton-verde">
        
    </form>
</main>

<?php incluirTemplate('footer'); ?>