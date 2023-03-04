<div class="container">
    <h1 class="page-header text-center">PRODUCTOS</h1>
    <div class="row">
        <div class="col-sm-12 ">
            <a href="recursos/ingreso.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Añadir producto</a>
            
            <table class="table table-bordered table-striped" style="margin-top:5px;margin-bottom:140px;">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                </thead>
                <tbody>
                    <?php
                        $productos = simplexml_load_file("xml/productos.xml");
                        foreach($productos->producto as $prod){

                    ?>

                    <tr>
                        <td><?= $prod->codigo ?></td>
                        <td><?= $prod->nombre ?></td>
                        <td><?= $prod->descripcion ?></td>
                        <td><img src="img/<?=$prod->img?>" alt="<?= $prod->img?>" height=160; width=160></td>
                        <td><?= $prod->categoria ?></td>
                        <td><?= $prod->precio ?></td>
                        <td><?= $prod->existencias ?></td>

                        <td>
                            <a href="recursos/editarProducto.php?id=<?=$prod->codigo?>" class="btn btn-primary"> Editar</a>
                            <a href="#delete_<?=$prod->codigo?>" data-toggle="modal" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                    <?php
                    include('recursos/borrar_modal.php');
                        }
                    ?>
                    

                </tbody>
            </table>
        </div>
    </div>
</div>