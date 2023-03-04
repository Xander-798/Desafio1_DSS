<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextilExport</title>
    
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/foms.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/footerM.css">
</head>
<body>
    <?php
        require_once('recursos/menu.php');
        $xml = simplexml_load_file("xml/productos.xml");
        require('recursos/class/producto.class.php');
        $productos = array();
        $buscados= array();
        foreach($xml->producto as $productinfo){
            $product = new Producto($productinfo->codigo, $productinfo->nombre, $productinfo->descripcion,
            $productinfo->img, $productinfo->categoria, $productinfo->precio, $productinfo->existencias);
            array_push($productos, $product);
        }
    ?>
    <section class="indiceal">
            <article class="fomidos">
                <section class="formulario">
                    <h4>Filtros:</h4>
                    <article>
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <div class="data">
                                <label for="clave">Ingrese una palabra clave a buscar:</label>
                                <input type="text" name="clave" placeholder="Clave">
                            </div>
                            <div>
                                <input name="chec" type="checkbox" id="chec" value="probar" onChange="comprobar(this);"/>
                                <label for="chec">Categoría</label>
            
                                <div id="boton" readonly style="display:none">
                                    <label><input type="checkbox" id="cbox1" name="textil" value="Textil">Textil</label>
                                    <label><input type="checkbox" id="cbox2" name="promocional" value="Promocional">Promocional</label>
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="enviar" name="buscar" value="Buscar">
                            </div>
                        </form>
                    </article>
                    <article>
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <div>
                            <input type="<?=(isset($_POST['buscar']))?"submit":"hidden"?>" class="borra" name="clear" value="Descartar filtrado">
                            
                            </div>
                        </form>
                    </article>
                </section>
            </article>
            <article>
                <h1 class="titulo">Mira nuestros productos</h1>
                
                <?php

                    if(isset($_POST['buscar'])){
                        $buscados = $product->encontrarCoincidencias($productos, $_POST['clave']);
                        if(isset($_POST['clave'])){
                            if(isset($_POST["chec"])){
                                $cat1 =  (isset($_POST['textil']))?$_POST['textil']: "";
                                $cat2 =  (isset($_POST['promocional']))?$_POST['promocional']: "";  
                                if($cat1 != "" && $cat2 != ""){
                                    $buscados = $product->encontrarCoincidenciasEspecifica($buscados, 2, $cat1, $cat2);
                                }else{
                                    $buscados = $product->encontrarCoincidenciasEspecifica($buscados, 1, $cat1, $cat2);
                                }
                            }
                            
                            if(count($buscados)>0){
                                $productos = $buscados;
                            }else{
                                echo "<h3 class=\"error\">No hubieron coincidencias, aquí te dejamos el listado completo:</h3>";
                            }
                        }
                    }

                    foreach($productos as $producto){
                        echo $producto;
                        include('recursos/detalle_modal.php');   
                    }
                    
                    
                ?>
            </article>
    </section>
    <section class="footer">
    <?php
        require_once('recursos/footer.php')
    ?>
    </section>
    
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/boton.js"></script>
</html>