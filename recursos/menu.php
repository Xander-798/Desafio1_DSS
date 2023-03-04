<?php
    if (session_id() === "") { session_start(); }
    if(isset($_SESSION['cod'])){
        $log = $_SESSION['rol'] . " - " .  $_SESSION['nom'];
        $link = "../../Desafio1_DSS/adminando.php";

    }else{
        $log = "Administrador";
        $link = "../../Desafio1_DSS/iniciar.php";
    }
        function probarAdmin(){
            $xml = simplexml_load_file("xml/admin.xml");
            require('recursos/class/admin.class.php');
        
            $admins = array();
        
            foreach($xml->admin as $adminInfo){
                $admin = new Administrador($adminInfo->codigo, $adminInfo->nombre, $adminInfo->apellido,
                $adminInfo->img, $adminInfo->rol, $adminInfo->correo, $adminInfo->contraseña);
                array_push($admins, $admin);
            }
            return $admins;
        }
?>
<header>
    <section class="menu">
        <a href="../../Desafio1_DSS/index.php" id="logo">TextilExport</a>

        <label for="toggle-1" class="toggle-menu"><ul><li></li> <li></li> <li></li></ul></label>
        <input type="checkbox" id="toggle-1">

        <nav>
            <ul>
                <li><a href="../../Desafio1_DSS/index.php"><i class="icon-home"></i>Inicio</a></li>
                <li><a href="../../Desafio1_DSS/categorias.php"><i class="icon-user"></i>Categorías</a></li>
                <li><a href="<?=$link?>"><i class="icon-thumbs-up-alt"></i><?=$log?></a></li>
            </ul>
        </nav>
    </section>
</header>