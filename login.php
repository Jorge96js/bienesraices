<?php 
    require 'includes/config/db.php';
    $db = conectarDB();

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);


        if(!$email){
            $errores[] = "Email no valido";
        }   
        if(!$password){
            $errores[] = "Password no valido";
        }

        if(empty($errores)){
            //revisar la bd
            $query = "SELECT * FROM usuarios WHERE email = '${email}';";
            $resultado = mysqli_query($db, $query);

            //verificar si el pass es correcto
            if($resultado->num_rows){
                $usuario = mysqli_fetch_assoc($resultado);

                //var_dump($usuario);
                $auth = password_verify($password, $usuario['password']);
                if($auth){
                    //verificar si esta autenticado
                    session_start();
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: admin/index.php');

                }else{
                    $errores[] = "Usuario incorrecto";
                }
            }

        }else{
            $errores[] = "El usuario no existe";
        }

    }


    require 'includes/funciones.php';
    incluirTemplate('header');
?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesion</h1>
        <?php foreach($errores as $error  ): ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
        <?php endforeach; ?>

        <form method="post" class="formulario">

            <fieldset>
                    <legend>Ingrese su usuario</legend>
        
                    <label for="email">E-mail: </label>
                    <input id="email" name="email" type="text" required placeholder="Escriba su correo">
        
                    <label for="password">Constraseña: </label>
                    <input id="password" name="password" type="password" required placeholder="Escriba su contraseña">
                </fieldset> <br>
                <input type="submit" class="boton boton-verde" value="Entrar">
        </form>

    </main>

<?php

     include('includes/templates/footer.php');
?>