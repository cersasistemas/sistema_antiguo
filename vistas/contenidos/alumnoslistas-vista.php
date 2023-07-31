<?php
if ($_SESSION['privilegio_srcp'] == 1) {
$datos = explode("/", $_GET['vistas']);
?>
<div class="row bg-primary ">
    <div class="col-md-12 text-center p-2">
        <h5 class="text-white text-center"> <?php
                        require_once("./controladores/clienteControlador.php");
                        $insCurso = new clienteControlador();
                        echo $insCurso->nombre_curso($datos[1]);
                        ?> 
            <button class="btn btn-success"><a style=" text-decoration: none;color:white;" href="<?php echo SERVERURL; ?>listacursoalumnos"> Buscar curso</a></button>
        </h5>
    </div>
  
</div>
<div class="row">
    
    <div class="col-md-2 card mt-2">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table table-hover" class="table table-striped table-bordered">
                    <thead class="bg bg-primary text-white">
                        <tr>
                            <th>Grupos</th>                                                
                        </tr>
                    </thead>
                    <tbody>
                        <!--resgistro de un alumno-->
                        <?php
                        require_once("./controladores/clienteControlador.php");
                        $insCurso = new clienteControlador();
                        echo $insCurso->grupos_cursos_alumnos($datos[1]);
                        ?>
                    </tbody>
                   
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-10 mt-2 card">
    <?php
        if(isset($datos[2]) && ($datos[2]!==null)){
       ?>
        <div class="row" >
            <div class="col-md-12 bg-secondary p-2">
                <h5>Grupo <?php echo $datos[2];?></h5>
            </div>
            <div class="col-md-3 mt-2">
                <button type="button" class="btn btn-success col-md-12"
                data-toggle="modal" data-target="#exampleModalScrollable">
                Nueva Matricula
                </button>
            </div>   
            <div class="col-md-3 mt-2">
                <a href="<?php echo SERVERURL."horario/".$datos[1]."/".$datos[2].""; ?>">
                    <button type="button" class="btn btn-dark col-md-12"
               >
             horario
                </button>
                </a>
            </div>    
            <div class="col-md-3 mt-2">
                <a href="<?php echo SERVERURL."horariocontrol/".$datos[1]."/".$datos[2].""; ?>">
                    <button type="button" class="btn btn-danger col-md-12">
                        Horario Control
                    </button>
                </a>
            </div>      
        </div>

       
                
     
        <?php }
         else{}?>
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead class="bg bg-primary text-white">
                        <tr>
                            <th>Ver</th>    
                            <th>DNI - Codigo</th>
                                                 
                            <th>Nombres Completo</th>    
                            <th>Asistencia</th>  
                          
                                                                  
                                                                       
                        </tr>
                    </thead>
                    <tbody>
                        <!--resgistro de un alumno-->
                        <?php
                        if(isset($datos[2]) && ($datos[2]!==null)){
                            require_once("./controladores/clienteControlador.php");
                            $insCurso = new clienteControlador();
                            echo $insCurso->alumnos_lista($datos[1],$datos[2]);
                         
                        }
                        else{
                            echo '<tr>                            
                            <th>Selecione el grupo</th>
                            <th></th>
                            
                            <th></th>    
                            <th></th>   
                            <th></th>   
                            </tr>';
                      
                    }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



<script>
    // script para vailidaion de variables 
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>


     <!--Enviar matricula-->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white text-center">
                <h5 class="modal-title" id="exampleModalScrollableTitle" class="text-center text-white">Formulario de Matrícula</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("form").keypress(function(e) {
                            if (e.which == 13) {
                                return false;
                            }
                        });
                    });
                </script>

                <div class="card p-4">
                    <?php
                    require_once("./controladores/clienteControlador.php");
                    $insMatri = new clienteControlador();
                    echo $insMatri->nueva_matricula($datos[1],$datos[2]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>