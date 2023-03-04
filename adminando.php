<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="css/menu.css">
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/footerM.css">
    <link rel="stylesheet" href="css/index3.css">
</head>
<body>
    <?php
        require_once('recursos/menu.php');
    ?>

    <section class="indiceal">
        <article>
        <?php
        if(isset($_POST['cerrar'])){
            session_destroy();
            header('location: index.php');
        }else{
            
            if(!isset($_SESSION['cod'])){
                echo "<h1>No puedes acceder aquí sin iniciar sesión: ";
                echo "<a href=\"iniciar.php\">Iniciar sesión</a></h1>";
                echo "</article>";
            }else{
        ?>
                <div class="perfil">
                    <img src="img/<?=$_SESSION['img']?>" alt="">
                    <div>
                        <h3><b>Codigo: </b><?=$_SESSION['cod'];?></h3>
                        <h3><b>Nombre: </b><?=$_SESSION['nom'] . " " . $_SESSION['ape'];?></h3>
                        <h3><b>Rol: </b><?=$_SESSION['rol'];?></h3>
                        <h3><b>Correo: </b><?=$_SESSION['correo'];?></h3>
                    </div>
                    
                </div>
                <form action="adminando.php" method="POST">
                    <input type="submit" name="cerrar" value="Cerrar Sesión">
                </form>
        </article>
        <?php
            require('recursos/adminListProductos.php');
            }
        }
        ?>
        
    </section>
    <section class="footer">
        <?php
            require_once('recursos/footer.php');
        ?>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>