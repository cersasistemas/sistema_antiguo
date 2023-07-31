<?php
$datosinteres = explode("/", $_GET['vistas']);
?>

<div class=" row card">
    <div class="card-body">
        <?php
        require_once("./controladores/cursoControlador.php");
        $insCurso = new cursoControlador();
        //echo $insCurso->datoscurso_controlador();
        echo $insCurso->infocurso_controlador($datosinteres[1]);
        ?>
    </div>
</div>


<hr>


<!--titulo del curso-->

<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <?php
                require_once("./controladores/clienteControlador.php");
                $insCurso = new clienteControlador();
                // echo $insCurso->cliente_actualizacion_estado();
                echo $insCurso->actualizacion_estado_cliente($datosinteres[1], $datosinteres[2]);
                ?>

            </div>
        </div>
    </div>
</div>

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
                    echo $insMatri->enviar_matricula($datosinteres[1]);
                    ?>
                </div>
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