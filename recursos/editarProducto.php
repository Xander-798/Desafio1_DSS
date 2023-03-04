<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextilExport: Editando</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/ingresoForm.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/footerM.css">
</head>
<body>
<?php
        //require('recursos/class/producto.class.php');
        require('menu.php');
        require('class/producto.class.php');
        require('insertarIMG.php');
        $xml = simplexml_load_file("../xml/productos.xml"); 
        $productos = array();
        foreach($xml->producto as $productinfo){
            $product = new Producto($productinfo->codigo, $productinfo->nombre, $productinfo->descripcion,
            $productinfo->img, $productinfo->categoria, $productinfo->precio, $productinfo->existencias);
            array_push($productos, $product);
        }
        
        if(isset($_SESSION['cod'])){
           if(isset($_GET['id'])){
                $buscados = $product->encontrarCoincidencias($productos, $_GET['id']);
                if(count($buscados) == 1){
                    $producto = $buscados[0];
                    if(isset($_POST['ingreso'])){
                        //var_dump($_POST);
                        //var_dump($_FILES);
                        extract($_POST);
                        $producto = new Producto($cod, $nom, $des, $_FILES['file1']["name"], $cat, $pre, $cant);
                        $errores = $producto->validacionProduto();
                    }
                    //echo $producto->getCodigo();
                    $i= 0;
            ?>
            <section class="indiceal">
                <article>
                    <h1>Modificando Producto: <?=(isset($producto))?$producto->getCodigo():"";?></h1>
                    <form action="<?=$_SERVER['PHP_SELF']."?id=".$_GET['id'];?>" method="POST" enctype="multipart/form-data">
                        <div>
                            <input type="hidden" name="cod" value="<?=(isset($producto))?$producto->getCodigo():"";?>" required>
                            <?php
                                if(isset($errores)){
                                    //echo $errores[$i];
                                    $i++;
                                }
                            ?>
                        </div>
                        <div>
                            <label for="nom">Nombre</label>
                            <input type="text" name="nom" value="<?=(isset($producto))?$producto->getNombre():"";?>" required>
                            <?php
                                if(isset($errores)){
                                    echo $errores[$i];
                                    $i++;
                                }
                            ?>
                        </div>
                        <div>
                            <label for="des">Descripcion:</label>
                            <textarea name="des" id="" required><?=(isset($producto))?$producto->getDescripcion():"";?></textarea>
                            <?php
                                if(isset($errores)){
                                    echo $errores[$i];
                                    $i++;
                                }
                            ?>
                        </div>
                        <div>
                            <label for="file1">Imágen: </label>
                            <input name="file1" id="file1" type="file" required/>
                            <?php
                                if(isset($errores)){
                                    echo $errores[$i];
                                    $i++;
                                }
                            ?>
                        </div>
                        <div class="categoria">
                            <label for="car">Categoría:</label> 
                            <?php
                                if(isset($producto)){
                                    $cat= $producto->getCategoria();
                                    if($cat == "Textil"){
                                        $chec = "checked";
                                        $chec2 = "";
                                    }else{
                                        $chec2 = "checked";
                                        $chec = "";
                                    }
                                }
                            ?>
                            <div>
                            <label for="huey"><input type="radio" class="cata" id="cat" name="cat" value="Textil" <?=$chec?>>Textil</label>
                            <label for="huey"><input type="radio" class="cata" id="cat" name="cat" value="Promocional" <?=$chec2?>>Promocional</label>
                            </div>
                        </label>
                        </div>
                        <div>
                            <label for="pre">Precio: </label>
                            <input type="text" name="pre" value="<?=(isset($producto))?$producto->getPrecio():"";?>" required>
                            <?php
                                if(isset($errores)){
                                    echo $errores[$i];
                                    $i++;
                                }
                            ?>
                        </div>
                        <div>
                            <label for="cant">Existencias: </label>
                            <input type="number" name="cant" id="cant" value="<?=(isset($producto))?$producto->getExistencias():"";?>" required>
                            <?php
                                if(isset($errores)){
                                    echo $errores[$i];
                                    $i++;
                                }
                            ?>
                        </div>
                        <input type="submit" name="ingreso" value="Modificar">
                </form>
                </article>
            </section>
            <?php  
                if(isset($producto)){
                    require('modificarXml.php');
                    if($producto->seguroInsertar()){
                        //var_dump($producto);
                       
                        if(insertarIMG($producto->getCodigo())){
                            //var_dump($producto);
                            modificarProducto($producto->getCodigo(), $producto);
                        }
                    }
                }
                }else{
                    echo "<section class=\"indiceal\"></article>";
                    echo "<h1 class=\"alte\">Debe pasarse un código de válido: ";
                    echo "<a href=\"../adminando.php\">Ir Administración</a></h1>";
                    echo "</article></section>";
                }
           }else{
            echo "<section class=\"indiceal\"></article>";
            echo "<h1 class=\"alte\">Debe pasarse un código de producto: ";
                echo "<a href=\"../adminando.php\">Ir Administración</a></h1>";
                echo "</article></section>";
            }
        }else{
            echo "<section class=\"indiceal\"></article>";
            echo "<h1 class=\"alte\">No puedes acceder aquí sin iniciar sesión: ";
                echo "<a href=\"../iniciar.php\">Iniciar sesión</a></h1>";
                echo "</article></section>";
        }
        
    ?>
            
    <section class="footer">
    <?php 
    require('footer.php');
    ?>
    </section>
</body>
</html>