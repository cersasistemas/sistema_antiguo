<?php
if ($_SESSION['privilegio_srcp'] == 1) {
$datos = explode("/", $_GET['vistas']);
?>
<div class="row bg-primary ">
    <div class="col-md-9 text-center p-2">
        <h5 class="text-white text-center"> <?php
                        require_once("./controladores/clienteControlador.php");
                        $insCurso = new clienteControlador();
                        echo $insCurso->nombre_curso($datos[1]);
                        ?> 
           
            <button class="btn btn-danger"><a style=" text-decoration: none;color:white;" href="<?php echo SERVERURL; ?>alumnoslistas/<?php echo $datos[1];?>/<?php echo $datos[2];?>"> Lista de alumnos</a></button>
            <button class="btn btn-success"><a style=" text-decoration: none;color:white;" href="<?php echo SERVERURL; ?>listacursoalumnos"> Buscar curso</a></button>
        </h5>
    </div>
  
</div>
<div class="row mt-3">
    <div class="col-md-3 card bg-secondary p-4">
       
        <form action="<?php echo SERVERURL ?>ajax/matriculaAjax.php"   method="post">
            <div class="form-group">
                <input type="hidden" value="<?php echo $datos[1];?>" name="curso" id="curso">
                <input type="hidden" value="<?php echo $datos[2];?>" name="grupo" id="grupo">
                <label for="exampleInputPassword1">Fecha</label>
                <input type="date" class="form-control col-md-12 " name="fecha" id="fecha"> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hora de Inicio</label>
                <input type="time" class="form-control col-md-12 " name="hora_inicio" id="hora_inicio"> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hora de Fin</label>
                <input type="time" class="form-control col-md-12 " name="hora_fin" id="hora_fin"> 
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="nueva_sesion_actualizado" id="nueva_sesion_actualizado"> Agregar Sesion</button>
            </div>
        </form>
       
    </div>
    <div class="col-md-9 mt-2 card">   
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead class="bg bg-primary text-white">
                        <tr>                            
                            <th>id</th>    
                            <th>Fecha</th>
                            <th>Hora de Inicio</th>    
                            <th>Hora de Fin</th>    
                            <th>Editar</th>    
                            <th>Eliminar</th>
                            <th>Alumnos</th>                                                          
                        </tr>
                    </thead>
                    <tbody>
                        <!--resgistro de un alumno-->
                              
                        <?php
                        if(isset($datos[2]) && ($datos[2]!==null)){
                            require_once("./controladores/clienteControlador.php");
                            $insCurso = new clienteControlador();
                            echo $insCurso->sesiones_horario_actualizado($datos[1],$datos[2]);
                         
                        }
                        else{
                            echo '<tr>                            
                            <th>Selecione el grupo</th>
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
<div class="row">
 
   

</div>

                

<?php } ?>