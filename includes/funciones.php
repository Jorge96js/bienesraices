<?php 

    define('TEMPLATES_URL', __DIR__ . '/templates');
    define('FUNCIONES_URL', __DIR__ .'funciones.php');
    define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

    function incluirTemplate(string $nombre, $inicio = false){
        include TEMPLATES_URL . "/{$nombre}.php";
    }

    function estaAutenticado() {
        session_start();
        if(!$_SESSION['login']){
            header('Location: /');
        }
    }

    function debugear($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        exit;
    }

    //sanitizar
    function s($html) : string{
        $s = htmlspecialchars($html);
        return $s;
    }

    //mostrar errores
    function phpErrores(){
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    }

    function validarTipoContenido($tipo){
        $tipos = ['vendedor', 'propiedad'];

        return in_array($tipo, $tipos);
    }

    function mostrarAlerta($arg){
        $mensaje = "";

        switch($arg){
            case 1:
                $mensaje = "Creado correctamente";
                break;
            case 2:
                $mensaje = "Actualizado correctamente";
                break;
            case 3:
                $mensaje = "Eliminado correctamente";
                break;
            default:
            $mensaje = null;
            break;
        }
    }