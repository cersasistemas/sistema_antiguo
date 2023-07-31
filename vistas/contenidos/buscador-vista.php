<?php
$datos = explode("/", $_GET['vistas']);
if (empty($datos[1])) {
    ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
            <div class="content-wrapper d-flex align-items-center auth auth-bg-2 theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auto-form-wrapper">

                            <form action="<?php echo SERVERURL ?>ajax/clienteAjax.php" method="POST" class="forms-sample">

                                <h3 class="text-center">Consultas de Certificados</h3><br>
                                <div class="form-group">
                                    <label class="label text-center">Ingrese su número de DNI o Identificación</label>
                                    <div class="input-group">
                                        <input required="" type="text" size="20" maxlength="20" class="form-control" name="dni" id="dni" placeholder="DNI">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-check-circle-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary submit-btn btn-block" type="submit" name="buscardni">Buscar</button>
                                </div>


                            </form>
                        </div>
                        <ul class="auth-footer">

                        </ul>
                        <p class="footer-text text-center">copyright © <?php echo date("Y") ?> Cersa. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>



<?php
} else if($datos[1] && empty($datos[2])){

    ?>
    <div class="container">
        <div class="row">
                <div class="col-md-12 mt-4 text-center">
                    <img src="http://sistema.cersa.org.pe/vistas/images/logo.png"  class="img-fluid" width="200px" alt="Logo" />
                
                    <div class="bg-primary mt-4">
                        <h3 class="text-white p-2">CERTIFICADOS</h3>
                    </div>
                
                    <h4 class="text-dark mt-4">Alumno :</h4>
                    <?php
                    require_once("./controladores/clienteControlador.php");
                    //INSTANCIOAMOS LA CLASE//
                    $insCurso = new clienteControlador();
                    // $dni=mainModel::encryption($datos[1]);
                    echo $insCurso->DetalleDeCertificado($datos[1]);
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger btn-lg" href="https://cersa.org.pe/diplomas/?dni=<?php echo $datos[1];?>">Buscar Certificados CIP</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
        <br>
        <p class="mt-4 footer-text text-center">copyright © <?php echo date("Y") ?> Cersa. Todos los derechos reservados.</p>
    </div>

   
    <!-- page-body-wrapper ends -->
    </div>
<?php
}
else{
    ?>
     <nav class="navbar navbar-light " style="background-color: #0e4381;">
        <a class="navbar-brand" href="#"><img src="https://cersa.org.pe/assets_2/media/img/logo.webp"  class="img-fluid" width="100px" alt="Logo" /></a>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#" >Registro de Certificado</a>
            </li>
           
        </ul>
        </nav>
        <?php
            require_once("./controladores/clienteControlador.php");
            //INSTANCIOAMOS LA CLASE//
            $insCurso = new clienteControlador();
            // $dni=mainModel::encryption($datos[1]);
            echo $insCurso->DescargarCertificado($datos[1],$datos[2]);
            ?>   
       
        <p class="mt-4 footer-text text-center">copyright © <?php echo date("Y") ?> Cersa. Todos los derechos reservados.</p>
    </div>
<?php
}
