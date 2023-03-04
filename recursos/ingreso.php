<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextilExport: Registrando</title>
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
            if(isset($_POST['ingreso'])){
                //var_dump($_POST);
                //var_dump($_FILES);
                extract($_POST);
                $producto = new Producto($cod, $nom, $des, $_FILES['file1']["name"], $cat, $pre, $cant);
                $errores = $producto->validacionProduto();
            }
            $i= 0;
        ?>
        <section class="indiceal">
            <article>
                <h1>Ingrese un nuevo producto</h1>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="cod">Código</label>
                        <input type="text" name="cod" value="<?=(isset($_POST['cod']))?$_POST['cod']:"";?>" required>
                        <?php
                            if(isset($errores)){
                                echo $errores[$i];
                                $i++;
                            }
                        ?>
                    </div>
                    <div>
                        <label for="nom">Nombre</label>
                        <input type="text" name="nom" value="<?=(isset($_POST['nom']))?$_POST['nom']:"";?>" required>
                        <?php
                            if(isset($errores)){
                                echo $errores[$i];
                                $i++;
                            }
                        ?>
                    </div>
                    <div>
                        <label for="des">Descripcion:</label>
                        <textarea name="des" id="" required></textarea>
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
                        
                        <div>
                        <label for="huey"><input type="radio" class="cata" id="cat" name="cat" value="Textil" checked>Textil</label>
                        <label for="huey"><input type="radio" class="cata" id="cat" name="cat" value="Promocional">Promocional</label>
                        </div>
                    </label>
                    </div>
                    <div>
                        <label for="pre">Precio: </label>
                        <input type="text" name="pre" value="<?=(isset($_POST['pre']))?$_POST['pre']:"";?>" required>
                        <?php
                            if(isset($errores)){
                                echo $errores[$i];
                                $i++;
                            }
                        ?>
                    </div>
                    <div>
                        <label for="cant">Existencias: </label>
                        <input type="number" name="cant" id="cant" value="<?=(isset($_POST['cant']))?$_POST['cant']:"";?>" required>
                        <?php
                            if(isset($errores)){
                                echo $errores[$i];
                                $i++;
                            }
                        ?>
                    </div>
                    <input type="submit" name="ingreso" value="Registrar Producto">
            </form>

            <?php  
            if(isset($producto)){
                require('insertarXml.php');
                if($producto->seguroInsertar()){
                    //var_dump($producto);
                    $cont = $producto->encontrarCoincidencias($productos, $producto->getCodigo());
                    if(count($producto->encontrarCoincidencias($productos, $producto->getCodigo()))==0){
                        if(insertarIMG($producto->getCodigo())){
                            //var_dump($producto);
                            insertarProducto($producto);
                        }
                    }else{
                        echo "<h3 class=\"error\">Ya existe ese código de producto, elija otro.</h3>";
                    }
                }
            }
        }else{
            echo " <section class=\"indiceal\">";
            echo "<article>";
            echo "<h1>No puedes acceder aquí sin iniciar sesión: ";
            echo "<a href=\"../iniciar.php\">Iniciar sesión</a></h1>";
            echo "</article>";
            echo " </section>";
        }
    ?>
            </article>
        </section>
        
    <section class="footer">
    <?php 
    require('footer.php');
    ?>
    </section>
</body>
</html>