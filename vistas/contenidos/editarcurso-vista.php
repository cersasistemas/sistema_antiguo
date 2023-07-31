<?php

if($_SESSION['privilegio_srcp']==1){

    $datos=explode("/",$_GET['vistas']);
   
?>
<!--titulo-->
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="text-primary text-center">
                <i class="fa fa-plus-circle text-primary icon-lg"></i>
           
                   
                         <?php
                            require_once("./controladores/cursoControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insEstado = new cursoControlador();
                            echo $insEstado->formulario_editar_curso($datos[1]);
                        ?>  

               
            </div>


        </div>
    </div>
</div> 
<?php }?>
