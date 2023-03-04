<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/formi.css">
    <link rel="stylesheet" href="css/foms.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/footerM.css">
</head>
<body>
    <?php
        require_once('recursos/menu.php');
        $admins = probarAdmin();
        echo "<section class=\"indiceal\">";
               
        echo "<article>";

        if(!isset($_SESSION['cod'])){
            ?>
            
                <form action="iniciar.php" method="POST">
                    <legend>Inicia sesión</legend>
                        <div>
                            <label for="correo">Ingrese su correo</label>
                            <input type="email" name="correo" id="correo">
                        </div>
                        <div>
                            <label for="contra">Ingrese su contraseña</label>
                            <input type="text" name="contra" id="contra">
                        </div>
                        <input type="submit" name="registro" value="Ingresar">
                        
                </form>
                <?php
                    if(isset($_POST['registro'])){
                        if(isset($_POST['correo']) && isset($_POST['contra'])) {
                            
                            $correo = $_POST['correo'];
                            $contra = $_POST['contra'];
                            $error = "";
                            if(preg_match('/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/',$correo)!= 0){
                                $banderaCorreo = false;
                                $banderaContra = false;
                                
                                //vemos si el correo esta registrado a un usuario
                                foreach($admins as $admin){
                                    if($admin->getCorreo() == $correo) {
                                        $banderaCorreo = true;
        
                                        //comprobamos la contraseña
                                        if($admin->getContraseña() == $contra) {
                                            $banderaContra = true;
                                            $adminAct = $admin;
                                        
                                        }
                                    }
                                }
        
                                if($banderaCorreo == true && $banderaContra == true){
                                    //pondriamso lo que va a hacer cuando inicie sesion
                                    $_SESSION['cod'] = strval($adminAct->getCodigo());
                                    $_SESSION['nom'] = strval($adminAct->getNombre());
                                    $_SESSION['ape'] = strval($adminAct->getApellido());
                                    $_SESSION['img'] = strval($adminAct->getImg());
                                    $_SESSION['rol'] = strval($adminAct->getRol());
                                    $_SESSION['correo'] = strval($adminAct->getCorreo());
                                    $_SESSION['contra'] = strval($adminAct->getContraseña());
                                    header('location: adminando.php');
                                }elseif($banderaCorreo == false && $banderaContra == false){
                                    $error = "No existe este usuario";
                                }else{
                                    $error = "Esa no es la contraseña de este usuario";
                                }
                            }else{
                                $error = "Digite un correo válido.";
                            }
                            if($error != "") echo "<h2 class=\"error\">$error</h2>";
                            
                        }
                        
                    }
        }else{
            echo "<h2 class=\"error\">Ya has iniciado sesión</h2>";
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