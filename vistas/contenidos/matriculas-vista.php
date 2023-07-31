<?php
if ($_SESSION['privilegio_srcp'] == 1) {
    $datos = explode("/", $_GET['vistas']);
    ?>

<div class="row card">
    <div class="col-md-12 grid-margin">  
       <h3 class="text-primary text-center">
            <?php
            require_once("./controladores/clienteControlador.php");
            $insCurso = new clienteControlador();
            echo $insCurso->nombre_curso_certificado($datos[1]);
            ?>
        </h3>          
    </div>
    <div class="col-md-12 grid-margin">
     
                <form action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" method="POST"  autocomplete="off">
                    <div class="row">
                        <div class="col-md-4">
                        <h4>Datos del Alumno<hr></h4>
                            <div class="form-group">
                                <label for="exampleInputEmail1">DNI</label>
                                <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="<?php echo $datos[1];  ?>">
                                <input type="text" size="20" maxlength="20" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"  class="form-control" name="dni" id="dni" placeholder="DNI" required>
                            </div>
                            <div class=" form-group">
                                <label for="exampleInputEmail1">Siglas</label>
                                <input type="text" class="form-control" name="siglas" id="siglas" placeholder="Siglas"
                                onkeyup="javascript:this.value=this.value.toLowerCase();">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombres</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" 
                                onkeyup="javascript:this.value=this.value.toLowerCase();">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos"
                                onkeyup="javascript:this.value=this.value.toLowerCase();" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>Datos Certificado<hr></h4>
                            <?php
                                require_once("./controladores/clienteControlador.php");
                                $insEstado = new clienteControlador();
                                echo $insEstado->cargar_datos_certificado($datos[1]);
                            ?> 
                        </div>
                        <div class="col-md-4">
                            <h4>Datos Adicionales<hr></h4>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha Nacimiento</label>
                                <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento">
                            </div>

                            

                            <div class=" form-group">
                                <label for="exampleInputEmail1">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Profesión</label>
                                <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesion">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo Alumno</label>
                                <select class="form-control form-control-lg" name="alumno" id="alumno">
                                    <option value="Nuevo">Nuevo</option>
                                    <option value="ExAlumno">ExAlumno</option>
                                </select>
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de Certificado</label>
                                <select class="form-control form-control-lg" name="tipocertificado" id="tipocertificado">
                                    <option value="3">Curso o Diploma</option>
                                    <option value="4">Taller</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" name="agregar_alumno" class="col-md-12 btn btn-success">Agregar</button>
                            </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                           
                                <a class="btn btn-primary col-md-6" 
                                href="<?php echo SERVERURL; ?>alumnosporcurso/<?php echo $datos[1]; ?>"><i class="fa fa-folder-open"></i>Lista de certificados</a>
                           
                            </div> 
                        </div>
                    </div>
                </form>        
    </div>
</div>
    
    <?php } ?>