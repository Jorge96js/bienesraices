<?php
    use App\Vendedores;
    require '../../includes/app.php';
    estaAutenticado();

    //Validar id por id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location: ../index.php');
    }

    //consulta para obtener vendedores
    $vendedor = Vendedores::find($id);
    $errores = Vendedores::getErrores();

  //  debugear(CARPETA_IMAGENES);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $args = $_POST['vendedor'];

        $vendedor->sincronizar($args);

        $errores = Vendedores::getErrores();
        if(empty($errores)){

            $resultado = $vendedor->guardar();
            if($resultado){
                header('Location: /admin=resultado=2');
            }
        }
    }
    
    incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Actualizar vendeddor</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error  ): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST">
        <?php include("../../includes/templates/formulario_vendedores.php");?>
        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>