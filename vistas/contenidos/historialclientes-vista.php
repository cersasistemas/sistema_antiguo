

<!--titulo del curso-->
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="text-primary text-center">Base General de Cursos / Diplomados                     
                </h3>
            </div>
        </div>
    </div>
</div>



<!--descripcion del curso y de los estados -->






<!--tabla de liosta de clientes-->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               

                <!--fin fformulario de bisqueda-->
                <hr>

                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead class="bg bg-primary text-white">
                                <tr>
                                    <th>Codigo</th>                                   
                                    <th>Nombre</th>
                                    <th>Clientes</th>
                                 

                                </tr>
                            </thead>
                            <tbody>
                                <!--resgistro de un alumno-->
                                <?php
                                require_once("./controladores/cursoControlador.php");

                                //INSTANCIOAMOS LA CLASE//
                                $insCurso = new cursoControlador();
                                echo $insCurso->historialdecursos();
                                ?>
                                <!--fin de registro de un alumno-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


