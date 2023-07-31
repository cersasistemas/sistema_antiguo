<!--titulo del curso-->
<?php

if($_SESSION['privilegio_srcp']==1){
 
?>
<div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h3 class="text-primary text-center">  Clientes Prematriculados
              
              </h3>
            </div>
          </div>
        </div>
</div>
      
 

<!--tabla de liosta de clientes-->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                 <hr>
                  <div class="table-responsive">
                    <table class="table table-hover" id="bootstrap-data-table"
                       class="table table-striped table-bordered">
                          <thead class="bg bg-primary text-white">
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Curso</th>     
                                <th>Detalle</th>
                                <th>Matricular</th>
                            </tr>
                          </thead>
                      <tbody> 
                     
                
                           <?php
                            require_once("./controladores/clienteControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insEstado = new clienteControlador();
                            echo $insEstado->mostrar_clientes_prematriculados();
                            ?>                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
