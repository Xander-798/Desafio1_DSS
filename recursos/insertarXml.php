<?php
    if(isset($producto)){
        function insertarProducto($producto){
            $productos = simplexml_load_file("../xml/productos.xml");
    
        $prod = $productos->addChild('producto');
    
        $prod->addChild('codigo',$producto->getCodigo());
        $prod->addChild('nombre',$producto->getNombre());
        $prod->addChild('descripcion',$producto->getDescripcion());
        $prod->addChild('img',$producto->getImg());
        $prod->addChild('categoria',$producto->getCategoria());
        $prod->addChild('precio', $producto->getPrecio());
        $prod->addChild('existencias', $producto->getExistencias());
    
        file_put_contents("../xml/productos.xml", $productos->asXML());
        header('location: ../index.php');
        }
    }else{
        header('location: ../index.php');
    }
?>