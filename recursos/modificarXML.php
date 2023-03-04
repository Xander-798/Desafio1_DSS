<?php
    if(isset($producto)){
        function modificarProducto($codigo, $producto){
            $productos = simplexml_load_file("../xml/productos.xml");
        
            $index = 0;
            $i= 0;
            foreach($productos->producto as $prod){
                if($prod->codigo == $codigo){
                    $index = $i;
                    break;
                }
                $i++;
            }
            
            unset($productos->producto[$index]);

            $prod = $productos->addChild('producto');
            
            $prod->addChild('codigo',$producto->getCodigo());
            $prod->addChild('nombre',$producto->getNombre());
            $prod->addChild('descripcion',$producto->getDescripcion());
            $prod->addChild('img',$producto->getImg());
            $prod->addChild('categoria',$producto->getCategoria());
            $prod->addChild('precio', $producto->getPrecio());
            $prod->addChild('existencias', $producto->getExistencias());

            file_put_contents("../xml/productos.xml", $productos->asXML());
            header('location: ../adminando.php');
        }
    }else{
        header('location: ../index.php');
    }
?>