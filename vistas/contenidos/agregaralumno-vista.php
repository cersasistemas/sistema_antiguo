<?php

if ($_SESSION['privilegio_srcp'] == 1) {
    $datos = explode("/", $_GET['vistas']);
    $id = mainModel::decryption($datos[1]);
 ?>

    <div class="row ">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                     <h4 class="text-primary text-center">
                        <i class="fa fa-plus-circle text-primary icon-lg"></i>
                        &nbsp; Agregar Alumno
                        <a href="javascript:history.back(-1);" class="btn btn-primary">Regresar</a>
                    </h4>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">

                <div class="card-body">

                    <form action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" method="POST" class="forms-sample" autocomplete="off">

                        <div class="row">
                             <div class="col-md-12">
                                <!--nombre/apellidos/correo-->
                                <div class="row">
                                <div class="col-md-4">


                                    <div class="col-md-12 form-group">
                                        <h4 class="card-title text-success">DATOS DEL ALUMNO (*)</h4>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="exampleInputEmail1">DNI</label>
                                        <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="<?php echo $id;  ?>">
                                        <input type="text" size="20" maxlength="20" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"  class="form-control" name="dni" id="dni" placeholder="DNI" required>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="exampleInputEmail1">Siglas</label>
                                        <input type="text" class="form-control" name="siglas" id="siglas" placeholder="Siglas"
                                        onkeyup="javascript:this.value=this.value.toLowerCase();">
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="exampleInputEmail1">Nombres</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" 
                                        onkeyup="javascript:this.value=this.value.toLowerCase();">
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="exampleInputPassword1">Apellidos</label>
                                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos"
                                        onkeyup="javascript:this.value=this.value.toLowerCase();" >
                                    </div>
                                 

                                </div>
                                <div class=" col-md-4">
                                    <div class="col-md-12 form-group">
                                        <h4 class="card-title text-success">DATOS DE CERTIFICADO (*)</h4>
                                    </div>
                                    
                                    <?php
                                        require_once("./controladores/clienteControlador.php");
                                        $insEstado = new clienteControlador();
                                        echo $insEstado->cargar_certificado_nuevoalumno($datos[1]);
                                    ?> 
                                </div>
                                <div class=" col-md-4">
                                <div class="col-md-12 form-group">
                                        <h4 class="card-title text-success">INFORMACION COMPLEMENTARIA</h4>
                                        
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="exampleInputEmail1">Fecha Nacimiento</label>
                                        <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento">
                                    </div>

                                  

                                    <div class=" col-md-12 form-group">
                                        <label for="exampleInputEmail1">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="exampleInputPassword1">Profesión</label>
                                        <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesion">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="exampleInputEmail1">Tipo Alumno</label>
                                        <select class="form-control form-control-lg" name="alumno" id="alumno">
                                            <option value="Nuevo">Nuevo</option>
                                            <option value="ExAlumno">ExAlumno</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <!--Agregar-->
                            <div class=" col-md-6 form-group">
                                <button type="submit" name="agregar_alumno" class="col-md-12 btn btn-success">Agregar</button>
                            </div>
                            <!--Cancelar-->
                            <div class="col-md-6 form-group">
                                <a href="javascript:history.back(-1);" class=" col-md-12 btn btn-danger">Cancel</a>
                            </div>
                        </div>

                    </form>



                </div>





            </div>

        </div>

    </div>

<?php } ?>