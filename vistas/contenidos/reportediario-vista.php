
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
<h2 class="text-center">Reporte Diario</h2></div></div></div></div>
<div class="row">
   
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class=" text-primary">Nuevos Clientes </h3>
                <div class="table-responsive">
                   <table class="table table-hover dataTable no-footer" id="bootstrap-data-table" role="grid" aria-describedby="bootstrap-data-table_info">
                        <thead class="bg bg-success text-white">
                            <tr>
                                <th>
                                    Clientes
                                </th>
                                <th>
                                   Fecha Programada
                                </th>
                                <th>
                                   Hora
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                  Curso
                                </th>
                                <th>
                                  Atendido por
                                </th>
                              
                              

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            require_once("./controladores/estadisticasControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insCat = new estadisticasControlador();
                            echo $insCat->reportediarionuevos();
                            ?>
                                                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
   
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class=" text-primary">Clientes a llamar </h3>
                <div class="table-responsive">
                   <table class="table table-hover dataTable no-footer" id="bootstrap-data-table" role="grid" aria-describedby="bootstrap-data-table_info">
                        <thead class="bg bg-success text-white">
                            <tr>
                                <th>
                                    Clientes
                                </th>
                                <th>
                                   Fecha Programada
                                </th>
                                <th>
                                   Hora
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                  Curso
                                </th>
                                <th>
                                  Atendido por
                                </th>
                              

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            require_once("./controladores/estadisticasControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insCat = new estadisticasControlador();
                            echo $insCat->reportediario();
                            ?>
                                                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class=" text-primary">Reservas</h3>
                <div class="table-responsive">
                   <table class="table table-hover dataTable no-footer" id="bootstrap-data-table" role="grid" aria-describedby="bootstrap-data-table_info">
                        <thead class="bg bg-success text-white">
                            <tr>
                                <th>
                                    Clientes
                                </th>
                                <th>
                                   Fecha Programada
                                </th>
                                <th>
                                   Hora
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                  Curso
                                </th>
                                <th>
                                  Atendido por
                                </th>
                              

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            require_once("./controladores/estadisticasControlador.php");
                            //INSTANCIOAMOS LA CLASE//
                            $insCats = new estadisticasControlador();
                            echo $insCats->reportediarioreservas();
                            ?>
                                                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  

</div>

