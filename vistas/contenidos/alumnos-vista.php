<?php

if ($_SESSION['privilegio_srcp'] == 1) { 

    ?>
    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title text-center">
                        <i class="fa fa-graduation-cap text-primary icon-lg">
                        </i>Lista de Alumnos Certificados
                    </h4>   
                        <hr>
                    <div >

                        <div class="table-responsive">

                            <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">

                                <thead class="bg bg-primary text-white">

                                    <tr>

                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Nuevo</th>
                                        <th>Certificados</th>
                                        <th>Descripcion</th>
                                   

                                    </tr> 

                                </thead>

                                <tbody>

                                    <!--resgistro de un alumno-->

                                    <?php
                                    require_once("./controladores/cursoControlador.php");
                                    $insCurso = new cursoControlador();
                                    echo $insCurso->curso_alumnos_cursos_controlador();
                                    ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>





















    <?php } ?>