<?php
if ($_SESSION['privilegio_srcp'] == 1) {
    $datos = explode("/", $_GET['vistas']);
    ?>
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-primary text-center">
                        <?php
                        require_once("./controladores/clienteControlador.php");
                        $insCurso = new clienteControlador();
                        echo $insCurso->nombre_curso_certificado($datos[1]);
                        ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa fa-graduation-cap text-primary icon-lg"></i>Lista de alumnos</h4>        

                    
                 <hr>
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead class="bg bg-primary text-white">
                                    <tr>
                                        <th>Ver</th>
                                        <th>DNI</th>
                                        <th>Nombres Completo</th>
                                        <th>Nota<th>   
                                        <th>Alumn </th>
                                        <th>Certif </th>
                                        <th>Eliminar </th>                                                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--resgistro de un alumno-->
                                    <?php
                                    require_once("./controladores/clienteControlador.php");
                                    $insCurso = new clienteControlador();
                                    echo $insCurso->alumno_grupo_controlador($datos[1]);
                                    ?>

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>







    <?php } ?>