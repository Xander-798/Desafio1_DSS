<?php
        $codigo=$_GET['cod'];
        $productos=simplexml_load_file("../xml/productos.xml");
        $index=0;
        $i=0;
        foreach($productos->producto as $prod){
            if($prod->codigo == $codigo){
                $index = $i;
                break;
            }
            $i++;
        }
        
        unset($productos->producto[$index]);
        file_put_contents("../xml/productos.xml",$productos->asXML());
        header('location:../adminando.php');    
?>