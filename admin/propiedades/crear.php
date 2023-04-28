<?php 

    require '../../includes/funciones.php';
    
    require '../../includes/config/db.php';
    incluirTemplate('header');

    
    echo "aa";

    $db = conectarDB();
   
    
   
   
    echo "<pre>";
    var_dump($resultado);
    echo "</pre>";
    
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedores_id = $_POST['vendedores_id'];
    
    //insertar en la BD
    $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) VALUES ('$titulo', '$precio', '$descripcion','$habitaciones','$wc','$estacionamiento','$vendedores_id')";
    
    $resultado = mysqli_query($db, $query);
    
    

?>


<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <form class="formulario" method="POST" action="/bienesraices/admin/propiedades/crear.php">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad">

            <label for="precio">Precio:</label>
            <input type="number"  id="precio" name="precio" placeholder="Precio de la propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="imagen/jpeg, image/png">

            <label for="descripcion">Descripcion:</label>
            <textarea  id="descipcion" name="descripcion"></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9">

            <label for="estacionamiento">Estacionamientos:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="1">Jorge</option>
                <option value="2">Juan</option>
            </select>
        </fieldset> 
        <br>
        <input type="submit" value="Crear propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>