<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

<?php
    $datos = explode("/", $_GET['vistas']);
    if(isset($datos[1]) && ($datos[1]!==null) && 
    (isset($datos[2])===false) && 
    (isset($datos[3])===false)){
?>

    <div class="container">
        <div class="row card mt-4">
            <div class="col-md-12 mt-4">
                <img  class="img-fluid mx-auto d-block" src="https://cersa.org.pe/capacitaciones/sites/default/files/nuevologo.png" alt="" >
            </div>

            <div class="col-md-12 mt-4">
                <h4 class="text-center"> Alumno(a) :
                    <?php
                        require_once("./controladores/matriculaControlador.php");
                        $insCurso = new matriculaControlador();
                        echo $insCurso->alumno_asistencia($datos[1]);
                    ?>
                </h4>
                <br>
                <h5>Lista de cursos matriculados</h5>
                <p class="text-dark"> *Selecione el curso el cual desea marcar su asistencia</p>
                
                <a href="<?php echo SERVERURL;?>asistencia" class="btn btn-dark">Regresar</a>
                
                <div class="table-responsive mt-4">
                <div class="table-responsive">
                    <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead class="bg bg-primary text-white">
                            <tr>
                                <th>N°</th> 
                                <th>Asistencia</th>       
                                <th>Curso</th>  
                                                                        
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("./controladores/matriculaControlador.php");
                            $insCurso = new matriculaControlador();
                            echo $insCurso->listadeasistencia($datos[1]);
                            ?>
                        </tbody>
                
                    </table>
                </div>
            </div>
            </div>
           
        </div>
    </div>

<?php
}
elseif(isset($datos[2]) && ($datos[2]!==null)  && isset($datos[3]) && ($datos[3]!==null)){
?>
     <div class="container">
        <div class="row card mt-4">
        <div class="col-md-12 mt-4">
            <img  class="img-fluid mx-auto d-block" src="https://cersa.org.pe/capacitaciones/sites/default/files/nuevologo.png" alt="" >
        </div>
        <div class="col-md-12 mt-4">
          
        </div>
            <div class="col-md-12 mt-4">
                <h5 class="text-center"> 
                <?php
                        require_once("./controladores/matriculaControlador.php");
                        $insCurso = new matriculaControlador();
                        echo $insCurso->Nombre_Curso(mainModel::decryption($datos[2]));
                        ?>
                    
                </h5>
                <p class="text-center"> Alumno(a) :
                    <?php
                        require_once("./controladores/matriculaControlador.php");
                        $insCurso = new matriculaControlador();
                        echo $insCurso->alumno_asistencia($datos[1]);
                    ?>
                </p>
                <p class="text-dark">Nota: Usted solo puede marcar asistencia dentro del horario que se realice la clase, si tiene algún problema contáctenos al correo: administracion@cersa.org.pe o al celular : +51 942 030 030</p>
            
               
            <div class="table-responsive mt-4">
                <div class="table-responsive">
                    <table class="table table-hover" class="table table-striped table-bordered">
                        <thead class="bg bg-primary text-white">
                            <tr>
                            <th>Asistencia</th>    
                                <th>Fecha</th>  
                                <th>Hora de inicio</th> 
                                <th>Hora de fin</th> 
                                                                         
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("./controladores/matriculaControlador.php");
                            $insCurso = new matriculaControlador();
                            echo $insCurso->asistencia_marcar($datos[1],$datos[2],$datos[3]);
                            ?>
                        </tbody>
                    
                    </table>
                </div>
           </div>
               </div>
               <div class="col-md-12 mt-4">
               <a href="<?php echo SERVERURL;?>asistencia/<?php echo $datos[1]?>" class="btn btn-dark">Regresar</a>
        
               </div>
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

<div class="container ">
    <div class="row mt-4">
        <div class="col-md-12 mt-4">
            <img  class="img-fluid mx-auto d-block" src="https://cersa.org.pe/capacitaciones/sites/default/files/nuevologo.png" alt="" >
        </div>
        <div class="col-md-5 mt-4 ">
            <div class="row mt-4 capa_a_ocultar">
                <div class="col-md-12 mt-4">
                </div>
                <div class="col-md-12 mt-4">
                </div>
                <div class="col-md-12 mt-4">
                </div>
                <div class="col-md-12 mt-4">
                </div>
                <div class="col-md-12 mt-4">
                </div>
            </div>
            <form  action="<?php echo SERVERURL;?>ajax/matriculaAjax.php" method="POST" >            
                <h3  class="text-center mt-4 text-dark">Registro de Asistencia</h3><br>
                <div class="form-group ">
                    <label class="label">Ingrese N° de DNI</label>
                    <div class="input-group">
                        <input type="text" method="post" name="dni" id="dni" 
                       class="form-control col-md-12"  style=" border: 2px solid #1a92c6;" required="">
                        <button  type="submit" class="btn btn-success" name="matricula_dni" id="matricula_dni">Buscar</button>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6 mt-4">
            <img src="https://cersa.org.pe/images/asistencia.png" width="600px" class="img-fluid mt-4" alt="">
        </div>
        <div class="col-md-12 mt-4"></div>
        <div class="col-md-12 mt-4">            
            <p class="footer-text text-center text-dark">copyright © 2020 Cersa- ÁREA DE SISTEMAS.<BR> Todos los derechos reservados.</p>
        </div>
    </div>
</div>

<?php
    }
?>
