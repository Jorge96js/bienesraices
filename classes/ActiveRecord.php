<?php
    
    namespace App;

    class ActiveRecord{
        protected static $db;
        protected static $columnasDB = [];
        protected static $tabla = '';
        
        protected static $errores = [];

        //clase con los campos de la base de datos 
        public $id;
        public $titulo; 
        public $precio; 
        public $imagen;
        public $descripcion; 
        public $habitaciones; 
        public $wc;
        public $estacionamiento;
        public $creado;
        public $vendedores_id;
        

        //definir conexion 
        public static function setDB($database){
        self::$db = $database;
        }
        
        public function guardar(){
            if(!is_null($this->id)){
                $this->actualizar();
            }else{
                $this->crear();
            }
        }
        public function crear()
        {
            // Sanitizar datos
            $atributos = $this->sanitizarAtributos();

            $columnas = join(', ',array_keys($atributos));
            $fila = join("', '",array_values($atributos));
            $query = " INSERT INTO " . static::$tabla . " ($columnas) VALUES ('$fila') ";

            $resultado = self::$db->query($query);
            return $resultado;
        }

        public function actualizar(){
            // Sanitizar datos
            $atributos = $this->sanitizarAtributos();        
            $valores = [];
            foreach($atributos as $key => $value){
                $valores[] = "{$key}='{$value}'";
            }
            $query = " UPDATE " . static::$tabla . " SET ";
            $query .= join(', ', $valores );
            $query .= "WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1";

            $resultado = self::$db->query($query);
            return $resultado;
            if($resultado){

                header('Location: ../index.php?resultado=1');
            }
            
        }   

        /****************eliminar********************************/

        public function eliminar(){
            
            //eliminar propiedad
            $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

            $resultado = self::$db->query($query);
            if($resultado){
                $this->borrarImagen();
                header('Location: /bienesraices/admin/index.php?resultado=3');
            }
        }

        //identificar atributos
        public function atributos(){
            $atributos =[];
            foreach(static::$columnasDB as $columna){
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }

        
        public function sanitizarAtributos(){
            $atributos = $this->atributos();
            $sanitizado = [];

            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }

        //subida de archivos


        public function setImagen($imagen){
            //Eliminar imagen previa
            if(!is_null($this->id)){
                $this->borrarImagen();
            }

            //asignar al atributo de la img el nombre de la img
            if($imagen){
                $this->imagen = $imagen;
            }
        }

        public function borrarImagen(){
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
                
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }

        
        public static function getErrores(){
            return self::$errores;
        }
        
        public function validar(){

            static::$errores = [];
            return static::$errores;
        }


        //listar propiedades
        public static function all(){
            $query = "SELECT * FROM " . static::$tabla;
            $resultado = self::consultarSQL($query);

            return $resultado;
        }
        public static function get($arg){
            $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $arg;
            $resultado = self::consultarSQL($query);

            return $resultado;
        }
        
        //busca registro por id

        public static function find($id){
            $query = "SELECT * FROM ". static::$tabla ." WHERE id = {$id}";

            $resultado = self::consultarSQL($query);

            return array_shift($resultado);
        }

        public static function consultarSQL($query){
            //consultar base de datos
            $resultado = self::$db->query($query);
            
            //iterar resultados

            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }

            //liberar memoria
            $resultado->free();

            //retornar resultados
            return $array;
        }

        protected static function crearObjeto($registro){
            $objeto = new static;

            foreach($registro as $key => $value){
                if(property_exists(   $objeto, $key  )){
                    $objeto->$key = $value;
                }
            }
            return $objeto;
        }

        //sincroniza el objeto en memoria con los datos que cambio el usuarios
        public function sincronizar($args = []){

            foreach($args as $key => $value){

                if(property_exists($this, $key) && !is_null($value)){
                    
                    $this->$key = $value;
                }
            }

        }

        
    
    }