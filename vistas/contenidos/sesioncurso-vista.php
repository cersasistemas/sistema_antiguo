
<div class="row card  p-4 ">

    <?php
    require_once("./controladores/cursoControlador.php");
    $insCurso = new cursoControlador();
    echo $insCurso->sesion_curso_exitoso_controlador();
    ?>

    <div class="col-md-12 table-responsive">
        <table class="table table-md" id="bootstrap-data-table" >
            <thead class="bg bg-primary text-white">
                <tr>
                    <th>Cod -  <i class="fa fa-envelope-o icon-sm"></i></th>
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
                echo $insCurso->enviando_parametro_atencion();
                ?>

            </tbody>

        </table>

    </div>


</div>

<!--nodal agregar nuevo clieten-->

<?php
require_once("./controladores/cursoControlador.php");
$insCursoagregar = new cursoControlador();
echo $insCursoagregar->agregar_interesados_corto_controlador();

?>