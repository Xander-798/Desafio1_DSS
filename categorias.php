<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/index2.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php
        require_once('recursos/menu.php');
    ?>
    <section class="indeceal">
       
        <article>
        <?php
            if(isset($_GET['id'])){
                $xml = simplexml_load_file("xml/productos.xml");
                require('recursos/class/producto.class.php');
                $productos = array();
                $buscados= array();
                foreach($xml->producto as $productinfo){
                    $product = new Producto($productinfo->codigo, $productinfo->nombre, $productinfo->descripcion,
                    $productinfo->img, $productinfo->categoria, $productinfo->precio, $productinfo->existencias);
                    array_push($productos, $product);
                }

                switch($_GET['id']){
                    case 1:
                        $cat = "Textil";
                        break;
                    case 2:
                        $cat = "Promocional";
                        break;
                    default:
                        header('location:' . $_SERVER['PHP_SELF']);
                }

                $buscados = $product->encontrarCoincidencias($productos, $cat);
                        
                        if(count($buscados)>0){
                            $productos = $buscados;
                        }
                echo "<div class=\"heder\">";
                echo "\t<div><h1 >Categoría actual: <b>$cat</b></h1></div>";
                echo "\t<div><a href=\"".$_SERVER['PHP_SELF']."\"><h1>Ver otra categoría</h1></a></div>";
                echo "</div>";
                foreach($productos as $producto){
                    echo $producto;
                    include('recursos/detalle_modal.php');   
                }
            }else{               
                echo "<h1 class=\"titul\">CATEGORIAS</h1>";
                echo "<a href=\"" . $_SERVER['PHP_SELF'] ."?id=1\">";
                echo "<div class=\"cat\">";
                echo "<img src=\"img/textil.jpeg\" alt=\"Imágen de Categoría: Textil\">";
                echo "<h2>Textil</h2>";
                echo "</div></a>";
                echo "<a href=\"" . $_SERVER['PHP_SELF'] ."?id=2\">";
                echo "<div class=\"cat\">";
                echo "<img src=\"img/promocional.jpg\" alt=\"Imágen de Categoría: Promocional\">";
                echo "<h2>Promocional</h2>";
                echo "</div></a>";
            }
        ?>
    
        </article>
    </section>
    <section class="footer">
        <?php
            require_once('recursos/footer.php');
        ?>
    </section>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>