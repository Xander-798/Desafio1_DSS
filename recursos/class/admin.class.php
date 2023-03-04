<?php
    require('usuario.class.php');
    
    class Administrador extends Usuario{
        
        private $rol;
        private $correo;
        private $contraseña;

        function __construct($cod, $nom, $ape, $imga, $rol, $core, $contra){
            parent::__construct($cod, $nom, $ape, $imga);
            $this->rol = $rol;
            $this->correo = $core;
            $this->contraseña = $contra;
        }

        public function getRol(){
            return $this->rol;
        }
        public function getCorreo(){
            return $this->correo;
        }
        public function getContraseña(){
            return $this->contraseña;
        }

        public function __toString(){
            $admin = "<h3>Administrador: " . $this->codigo . " - " . $this->nombre . " ". $this->apellido . "</h3>";
            $admin .= "<img src=\"img/".$this->img."\" alt=\"Imágen del producto ". $this->img ."\">";
            $admin .= "<h3>Rol: " . $this->rol . "</h3>";
            $admin .= "<h3>Correo: " . $this->correo. "</h3>";
            $admin .= "</div>";
            return $admin;
        }
        
    }
?>