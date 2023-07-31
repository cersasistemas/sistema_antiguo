<!--informacion de el cliente-->
<?php
if ($_SESSION['privilegio_srcp'] == 1) {

$datosdeAlumno=explode("/",$_GET['vistas']);

?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               

                <!--Mostrando informacion del alumno-->
                <?php
                            require_once("./controladores/clienteControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insEstado = new clienteControlador();
                            echo $insEstado->informacion_alumnos_paraeditar($datosdeAlumno[1]);
                ?>  
                 </div>
        </div>
    </div>
</div>
<!--fin informaicon de los clientes-->


<!--formulario de configuracion para el cliente-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <p class="card-description">
                    Verifique todos los datos ingresados antes de confirmar
                </p>
                <hr>
                <?php
                            require_once("./controladores/clienteControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insEstado = new clienteControlador();
                            echo $insEstado->editar_alumno_controlador($datosdeAlumno[1]);
                ?>  
                

            </div>
        </div>
    </div>
</div>
<!--fin del formulario para configuracion del cliente-->



<?php }?>