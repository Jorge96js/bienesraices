<?php

    namespace App;

    class Propiedad{

        protected static $db;
        protected static $columntasBD = ['titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];
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
        

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? '';
            $this->titulo = $args['titulo'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->habitaciones = $args['habitaciones'] ?? '';
            $this->wc = $args['wc'] ?? '';
            $this->estacionamiento = $args['estacionamiento'] ?? '';
            $this->creado = date('Y/m/d');
            $this->vendedores_id = $args['vendedores_id'] ?? 1;

        }


        public function guardar(){
            if(isset($this->id)){
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
            $query = " INSERT INTO propiedades($columnas) VALUES ('$fila') ";

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
            $query = " UPDATE propiedades SET ";
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
            $query = "DELETE FROM propiedades WHERE id = ". self::$db->escape_string($this->id) . " LIMIT 1";
            $resultado = self::$db->query($query);
            if($resultado){
                $this->borrarImagen();
                header('Location: /bienesraices/admin/index.php?resultado=3');
            }
        }

        //identificar atributos
        public function atributos(){
            $atributos =[];
            foreach(self::$columntasBD as $columna){
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
            if(isset($this->id)){
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
            if(!$this->titulo){ 

                self::$errores[] = "Inserte un titulo";
            }
    
            if(!$this->precio){ 
    
                self::$errores[] = "Inserte un precio";
    
            }        
            if(!$this->descripcion){ 
    
                self::$errores[] = "Inserte una descripcion";
    
            }
            if(!$this->habitaciones){ 
    
                self::$errores[] = "Inserte el numero de habitaciones";
    
            }     
            if(!$this->wc){ 
    
                self::$errores[] = "Inserte el numero de baños";
    
            }        
            if(!$this->estacionamiento){ 
    
                self::$errores[] = "Inserte el numero de estacuibanuebtis";
    
            }  

            if(!$this->imagen){
                self::$errores[] = "Inserte una imagen";
            }
    
            return self::$errores;
        }


        //listar propiedades
        public static function all(){
            $query = "SELECT * FROM propiedades";
            $resultado = self::consultarSQL($query);

            return $resultado;
        }
        
        //busca registro por id

        public static function find($id){
            $query = "SELECT * FROM propiedades WHERE id = {$id}";

            $resultado = self::consultarSQL($query);

            return array_shift($resultado);
        }

        public static function consultarSQL($query){
            //consultar base de datos
            $resultado = self::$db->query($query);
            
            //iterar resultados

            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = self::crearObjeto($registro);
            }

            //liberar memoria
            $resultado->free();

            //retornar resultados
            return $array;
        }

        protected static function crearObjeto($registro){
            $objeto = new self;

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