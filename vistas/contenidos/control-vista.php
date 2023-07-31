<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

<?php
    $datos = explode("/", $_GET['vistas']);
    if(isset($datos[1]) && ($datos[1]!==null) && 
    (isset($datos[2])===false)){
?>


    <div class="container">
        <div class="row card mt-4">
            <div class="col-md-12 mt-4">
                <img  class="img-fluid mx-auto d-block" src="https://cersa.org.pe/capacitaciones/sites/default/files/nuevologo.png" alt="" >
            </div>

            <div class="col-md-12 mt-4">
              
                <br>               
                
                <a href="<?php echo SERVERURL;?>control" class="btn btn-dark">Regresar</a>
                   <?php
                    require_once("./controladores/clienteControlador.php");
                    $insCurso = new clienteControlador();
                    echo $insCurso->grupos_cursos_alumnos_control($datos[1]);
                ?>
            </div>
           
        </div>
    </div>

<?php
}
elseif(isset($datos[1]) && ($datos[1]!==null)  && isset($datos[2]) && ($datos[2]!==null)){

 
?>

     <div class="container">
     <div class="col-md-12 mt-4">
            <img  class="img-fluid mx-auto d-block" src="https://cersa.org.pe/capacitaciones/sites/default/files/nuevologo.png" alt="" >
        </div>
       
     
                        <!--resgistro de un alumno-->
                        <?php
                      
                        if(isset($datos[2]) && ($datos[2]!==null)){
                            require_once("./controladores/clienteControlador.php");
                            $insCurso = new clienteControlador();
                            echo $insCurso->alumnos_lista_control($datos[1],$datos[2]);
                         
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
           
        <div class="col-md-12 mt-4">
        <a href="<?php echo SERVERURL;?>control/<?php echo $datos[1]?>" class="btn btn-dark">Regresar</a>

        </div>
     
    </div>
<?php
}
else{
?>

<style>
@media screen and (max-width: 600px) {
.capa_a_ocultar{
display:none;
}
}</style>



<div class="container-fluid ">
    <div class="row mt-4">
        <div class="col-md-12 mt-4">
            <img  class="img-fluid mx-auto d-block" src="https://cersa.org.pe/capacitaciones/sites/default/files/nuevologo.png" alt="" >
        </div>
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead class="bg bg-primary text-white">
                        <tr>
                            <th>PS</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Incio</th>
                            <th>Fin</th>
                            <th>Grupos</th>
                            </tr>
                    </thead>
                    <tbody>
                        <!--resgistro de un alumno-->
                        <?php
                        require_once("./controladores/cursoControlador.php");

                        //INSTANCIOAMOS LA CLASE//
                        $insCurso = new cursoControlador();
                        echo $insCurso->lista_cursos_control();
                        ?>
                        <!--fin de registro de un alumno-->
                    </tbody>
                </table>
            </div>
        </div>
       
        <div class="col-md-12 mt-4">            
            <p class="footer-text text-center text-dark">copyright © 2020 Cersa- ÁREA DE SISTEMAS.<BR> Todos los derechos reservados.</p>
        </div>
    </div>
</div>



<?php
    }
?>

