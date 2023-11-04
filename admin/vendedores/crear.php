<?php 

    require '../../includes/app.php';
    phpErrores();
    use App\Vendedores;

    estaAutenticado();
    $vendedor = new Vendedores();
    $errores = Vendedores::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        /** Crea una nueva instancia */
        $vendedor = new Vendedores($_POST['vendedor']);


        // Validar
        $errores = $vendedor->validar();

        if(empty($errores)) {
            $vendedor->guardar();
        }
    }

    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

    
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/bienesraices/admin/vendedores/crear.php">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <br>
            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
        
    </main>

<?php 
    incluirTemplate('footer');
?> 