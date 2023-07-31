<?php
$datosinteres = explode("/", $_GET['vistas']);
?>
<div class="row ">

    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <?php

                require_once("./controladores/cursoControlador.php");
                $insCurso = new cursoControlador();
                // $variable=1;
                echo $insCurso->sesion_curso_exitoso_controlador();

                ?>

            </div>

        </div>

    </div>

</div>





<!--lista de participantes o interesado sen el curso-->

<div class="row">

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">Lista de interesados</h4>

                <!--fin fformulario de bisqueda-->
                <hr />



                <div class="table-responsive">

                    <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">

                        <thead class="bg bg-primary text-white">
                            <tr>
                                <th>Cod - <i class="fa fa-envelope-o icon-sm"></i></th>
                                <th>Nombre</th>
                                <th>Acción -Estado</th>
                                <th>Descripción</th>
                                <th>Fecha programada</th>
                                <th>Fecha Cambio Estado</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!--resgistro de un alumno-->

                            <?php
                            require_once("./controladores/cursoControlador.php");
                            $insCurso = new cursoControlador();
                            //echo $insCurso->tabla_interesados_estado_controlador();
                            echo $insCurso->enviando_parametro_atencion_estado($datosinteres[1]);
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>



<!--NoDALES-->







<!--nodal agregar nuevo clieten-->

<?php

require_once("./controladores/cursoControlador.php");

$insCursoagregar = new cursoControlador();

echo $insCursoagregar->agregar_interesados_corto_controlador();



?>