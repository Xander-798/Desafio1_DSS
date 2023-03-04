<?php
    class Usuario{
        protected $codigo;
        protected $nombre;
        protected $apellido;
        protected $img;

        function __construct($cod, $nom, $ape, $imga){
            $this->codigo = $cod;
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->img = $imga;
        }

        public function getCodigo(){
            return $this->codigo;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getImg(){
            return $this->img;
        }

        
    }
?>