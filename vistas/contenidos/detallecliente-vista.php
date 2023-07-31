<!--informacion de el cliente-->
<?php

if($_SESSION['privilegio_srcp']==1){

    $datos=explode("/",$_GET['vistas']);
 
?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    

                        <?php
                            require_once("./controladores/clienteControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insEstado = new clienteControlador();
                            echo $insEstado->detalle_cliente_prematri($datos[1]);
                        ?>  
                    

               
                <!--fin informacion del contacto-->

            </div>

        </div>
    </div>
</div>


<?php }?>