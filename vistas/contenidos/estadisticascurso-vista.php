<?php

if($_SESSION['privilegio_srcp']==1){
 
?>
<div class="row">
                    <?php
                            require_once("./controladores/estadisticascursoControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insGenerales = new estadisticascursoControlador();
                        echo $insGenerales->estadisticas_generales_controlador();
                        ?>


</div>                  
<div class="row">

            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Lista de cursos  Activos con el porcentaje de interesados</h4>
                  <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                     
                        <tr>
                         
                          <th>
                            Fecha de Inicio
                          </th>
                          
                          <th>
                            Nombre
                          </th>
                          <th>
                            Interesados
                          </th>            
                          <th>
                            % de Interes
                          </th>
                        
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            require_once("./controladores/estadisticascursoControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                           
                            $insInteres = new estadisticascursoControlador();
                        echo $insInteres->total_clientes_interes_controlador();
                        ?>
                        
                     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
         
</div>

<div class="row">

            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Lista de cursos con el porcentaje de interesados</h4>
                  <div class="table-responsive">
                  <table class="table table-hover dataTable no-footer" id="bootstrap-data-table" role="grid" aria-describedby="bootstrap-data-table_info">
                      <thead>
                     
                        <tr>
                         
                        
                          
                          <th>
                            Nombre
                          </th>
                          <th>
                            Interesados
                          </th>            
                          <th>
                            % de Interes
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            require_once("./controladores/estadisticascursoControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $mes=4;
                            $insInteres = new estadisticascursoControlador();
                        echo $insInteres->tota_interesados($mes);
                        ?>
                        
                     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
         
</div>


<?php }?>

