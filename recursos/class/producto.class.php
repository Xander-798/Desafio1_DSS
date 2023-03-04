<?php
    class Producto{
        private $codigo;
        private $nombre;
        private $descripcion;
        private $img;
        private $categoria;
        private $precio;
        private $existencias;

        function __construct($cod, $nom, $des, $imag, $cat, $prec, $exist){
            $this->codigo = $cod;
            $this->nombre = $nom;
            $this->descripcion = $des;
            $this->img = $imag;
            $this->categoria = $cat;
            $this->precio = $prec;
            $this->existencias = $exist;
        }

        public function getCodigo(){
            return $this->codigo;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function getImg(){
            return $this->img;
        }
        public function getCategoria(){
            return $this->categoria;
        }
        public function getExistencias(){
            return $this->existencias;
        }

        public function getPrecio(){
            return $this->precio;
        }

        public function __toString(){
            $prod = "<div class=\"prod\">";
            $prod .= "<h4>" . $this->nombre ."</h4>";
            $prod .= "<img src=\"img/".$this->img."\" alt=\"Imágen del producto ". $this->img ."\">";
            $prod .= "<h4 class=\"precio\">$" . $this->precio ."</h4>";
            $prod .= "<h4>";
            $prod .= ($this->existencias > 0)? "Disponible</h4>": "Producto no disponible</h4>";
            $prod .= "<a href=\"#detalle_" . $this->codigo ."\" data-toggle=\"modal\" class=\"btn btn-default\">Detalles</a>";
            $prod .= "</div>";
            return $prod;
        }

        public function encontrarCoincidencias($productos,  $clave){
            $buscados = array();

            foreach($productos as $productinfo){
                $bandera = false;
                foreach ($productinfo as $productdetail){
                    if(preg_match("/".$clave."/", $productdetail)!= 0){
                        $bandera = true;
                    }
                }
                if($bandera == true){
                    array_push($buscados, $productinfo);

                }
            }
            return $buscados;
        }


        public function encontrarCoincidenciasEspecifica($productos, $cant, $cat, $cat2){
            $buscados = array();

            foreach($productos as $productinfo){
                $banderaCat = false;
                foreach ($productinfo as $productdetail){
                    switch($cant){
                        case 1:
                            if($cat != ""){
                                if($productdetail == $cat){
                                    $banderaCat = true;
                                }
                            }elseif($cat2 != ""){
                                if($productdetail == $cat2){
                                    $banderaCat = true;
                                }
                            }
                            break;
                        case 2:
                            if($productdetail == $cat || $productdetail == $cat2){
                                $banderaCat =  true;
                            }
                            break;
                    }
                }
                if($banderaCat == true){
                    array_push($buscados, $productinfo);

                }
            }
            return $buscados;
        }

        public function setPrecio($prec){
            $this->precio = $prec;
        }


        public function setIMG($img_path){
            $this->img = $img_path;
        }

        public function valCod(){
            if(preg_match("/^PROD[0-9]{5}$/",$this->codigo) == 1){
                return true;
            }else{
                return false;
            }
        }

        public function valNombre(){
            if(preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $this->nombre) != 0){
                return true;
            }else{
                return false;
            }
        }

        public function valDescripción(){
            if(preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\d\.\,]+$/", $this->descripcion) != 0){
                return true;
            }else{
                return false;
            }
        }

        public function valIMG(){
            $imagen = explode(".", $this->img);
            if(count($imagen)>=2){
                $nombre = $imagen[0];
                $extension = $imagen[1];
                if(preg_match("/(jpg|png)/", $extension) != 0){
                    $this->setIMG($this->codigo . "." . $extension);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function valPrecio(){
            if(is_numeric($this->precio)){
                $valPrecio = $this->precio;
                $this->setPrecio(number_format($valPrecio, 2,'.', ''));
                return true;
            }else{
                return false;
            }
        }

        public function valExistencias(){
            $exist = intval($this->existencias);
            $this->existencias = $exist;
            if(is_int($this->existencias) && $this->existencias>=0){
                return true;
            }else{
                return false;
            }
        }
        public function validacionProduto(){
            $errores = array();
            if($this->valCod() == false){
                array_push($errores, "<h4>Digite un código con el formato <b>PRODXXXXX</b></h4>");
            }else{
                array_push($errores, "");
            }
            if($this->valNombre() == false){
                array_push($errores, "<h4>Solo se aceptan palabras que representen el título</h4>");
            }else{
                array_push($errores, "");
            }
            
            if($this->valDescripción() == false){
                array_push($errores, "<h4>Sólo se aceptan descripciones directas.</h4>");
            }else{
                array_push($errores, "");
            }
            if($this->valIMG() == false){
                array_push($errores, "<h4>Solo se aceptan imágenes: archivos <b>.png</b> o <b>.jpg</b></h4>");
            }else{
                array_push($errores, "");
            }
            if($this->valPrecio()== false){
                array_push($errores, "<h4>Sólo se aceptan números.</h4>");
            }else{
                array_push($errores, "");
            }
            if($this->valExistencias()== false){
                array_push($errores, "<h4>Sólo se aceptan números enteros no negativos.</h4>");
            }else{
                array_push($errores, "");
            }
            return $errores;
        }
        
        public function seguroInsertar(){
            if($this->valCod() == true && $this->valNombre() == true && $this->valDescripción() == true && 
                $this->valIMG() == true && $this->valPrecio()== true && $this->valExistencias() == true){
                return true;
            }else{
                return false;
            }
        }
    }

    
?>