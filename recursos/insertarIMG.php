<?php
    function insertarIMG($cod){
        $target_dir = "../img/"; //directorio en el que se subira
        $uploadOk = 1;//se añade un valor determinado en 1
        $imageFileType = strtolower(pathinfo(basename($_FILES["file1"]["name"]), PATHINFO_EXTENSION));
        $target_file = $target_dir . $cod . "." . $imageFileType;
        // Permitir ciertos formatos de archivo
        if($imageFileType != "jpg" && $imageFileType != "png") {
            echo "Perdon solo, JPG y PNG";
            $uploadOk = 0;
        }
        //Comprueba si $ uploadOk se establece en 0 por un error
        if ($uploadOk == 0) {
            echo "Perdon, pero el archivo no se subio";
        // si todo está bien, intenta subir el archivo
        } else {
            if (move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file)) {
                //echo "El archivo ". basename( $_FILES["file1"]["name"]). " Se subio correctamente";
                return true;
            } else {
                //echo "Error al cargar el archivo";
                return false;
            }
        }
    }
?>