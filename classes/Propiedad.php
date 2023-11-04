<?php

    namespace App;

    class Propiedad extends ActiveRecord{

        protected static $tabla = 'propiedades';
        protected static $columnasDB = ['titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

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

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? NULL;
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

    }