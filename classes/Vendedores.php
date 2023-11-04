<?php

    namespace App;

    class Vendedores extends ActiveRecord{
        protected static $tabla = 'vendedores';
        protected static $columnasDB = ['nombre', 'apellido', 'telefono'];

        //clase con los campos de la base de datos 
        public $id;
        public $nombre; 
        public $apellido; 
        public $telefono;
        
        /*********CONSTRUCTOR**************/
        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? NULL;
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? '';
            $this->telefono = $args['telefono'] ?? '';
        }

        public function validar(){
            if(!$this->nombre){ 
                self::$errores[] = "Inserte un nombre";
            }
            if(!$this->apellido){ 
                self::$errores[] = "Inserte un apellido";
            }
            if(!$this->telefono){ 
                self::$errores[] = "Inserte un telefono";
            }

            return self::$errores;
        }

    }