
<?php
if ($_SESSION['privilegio_srcp'] == 1) {
?>

<div class="row">
    <div class="col-lg-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-center">Curso: <?php 
          
          
          require_once("./controladores/cursoControlador.php");
         //INSTANCIOAMOS LA CLASE//
          $insCurso = new cursoControlador();
          echo $insCurso->mostrar_nombre_curso_grupo();
         ?></h4>
          <div class="row">
         
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--tabla de cursos-->
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-graduation-cap text-primary icon-lg"></i>Ingrese a un curso para ver los alumnos</h4>

                <!--fin fformulario de bisqueda-->
                <hr>

                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead class="bg bg-primary text-white">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Categoria</th>
                                    <th>Nombre</th>
                                    <th>Ver</th>
                                    
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <!--resgistro de un alumno-->
                                <?php
                                require_once("./controladores/cursoControlador.php");
                               //INSTANCIOAMOS LA CLASE//
                                $insCurso = new cursoControlador();
                                echo $insCurso->grupos_de_un_curso_controlador();
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php } ?>