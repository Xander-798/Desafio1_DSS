<?php
    if(isset($producto)){
        if($producto->getCodigo() != null){
            ?>
                <div class="modal fade" id="detalle_<?php echo $producto->getCodigo(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <center><h4 class="modal-title" id="myModalLabel">Detalles del producto</h4></center>
                            </div>
                            <div>	
                                <section class="Cuerpo">
                                    <article>
                                        <h2><b>Código: </b><?=$producto->getCodigo();?></h2>
                                        <h2><b>Nombre: </b><?=$producto->getNombre();?></h2>
                                        <h2><b>Descripción: </b><?=$producto->getDescripcion();?></h2>
                                        <h2><b>Categoría: </b><?=$producto->getCategoria();?></h2>
                                        <h2><b>Precio: </b>$<?=$producto->getPrecio();?></h2>
                                        <h2><b>Existencias: </b><?=$producto->getExistencias();?></h2>
                                    </article>
                                    <article>
                                        <a href="img/<?=$producto->getImg();?>" ><img src="img/<?=$producto->getImg();?>" alt="Imágen del producto<?=$product->getImg();?>"></a>
                                    </article>
                                </section>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
                            </div>
                
                        </div>
                    </div>
                </div>
            <?php
        }
    }else{
        header('location: ../index.php');
    }
?>