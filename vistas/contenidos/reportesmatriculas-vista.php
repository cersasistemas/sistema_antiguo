<div class="row card">
    <div class="col-md-12 p-2 text-center text-dark">
        Reporte de mis Matrículas - 
        <?php  
                setlocale(LC_TIME, "spanish");
                echo strftime("%B");
                ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2">
        <div class="card   mb-3" style="max-width: 18rem;">
            <div class="card-header  bg-white border border-primary text-center
            text-dark">
            <p class="card-text text-center">Hoy</p> 
            </div>
            <div class="card-body border border-primary text-dark">
                    <h1 class="card-text text-center">
                        <?php
                            require_once("./controladores/matriculaControlador.php");
                            $Matr = new matriculaControlador();
                            echo $Matr->matriculashoy("hoy");
                        ?>
                    </h1>
                <p class="card-text text-center">Matriculas</p> 
              </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card   mb-3" style="max-width: 18rem;">
            <div class="card-header  bg-white border border-primary text-center
            text-dark">
            <p class="card-text text-center">Semana</p> 
            </div>
           
            <div class="card-body border border-primary text-dark">
                <h1 class="card-text text-center"><?php
                            require_once("./controladores/matriculaControlador.php");
                            $Matr = new matriculaControlador();
                            echo $Matr->matriculashoy("semana");
                        ?></h1>
                <p class="card-text text-center">Matriculas</p> 
              </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card   mb-3" style="max-width: 18rem;">
            <div class="card-header  bg-white border border-primary text-center
            text-dark">
            <p class="card-text text-center">Mes</p> 
            </div>
            <div class="card-body border border-primary text-dark">
                <h1 class="card-text text-center"><?php
                            require_once("./controladores/matriculaControlador.php");
                            $Matr = new matriculaControlador();
                            echo $Matr->matriculashoy("mes");
                        ?></h1>
                <p class="card-text text-center">Matriculas</p> 
              </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Matrículas Pendientes <?php  
                setlocale(LC_TIME, "spanish");
                echo strftime("%B");
                ?> </h4>
               <hr />
              

                <div class="table-responsive">
                    <table class="table table-hover" class="table table-striped table-bordered">
                        <thead class="bg bg-light text-dark border border-primary">
                                <tr>
                                    <th class="border border-primary">Codigo</i></th>
                                    <th class="border border-primary">Estado</th>
                                    <th class="border border-primary">Nombre</th>
                                    <th class="border border-primary">Monto</th>
                                    <th class="border border-primary">Curso</th>
                                    <th class="border border-primary">Fecha Pago</th>
                                    <th class="border border-primary">Voucher</th>
                                
                                </tr>
                            </thead>
                        <tbody>
                            <!--resgistro de un alumno-->

                            <?php
                            require_once("./controladores/matriculaControlador.php");
                            $insCurso = new matriculaControlador();
                            echo $insCurso->estadomatriculas(0);
                            ?>

                        </tbody>
                        
                        

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

 <br>
 <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Matrículas Confirmadas <?php  
                setlocale(LC_TIME, "spanish");
                echo strftime("%B");
                ?> </h4>
               <hr />

                <div class="table-responsive">
                    <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead class="bg bg-light text-dark border border-primary">
                            <tr>
                                <th class="border border-primary">Codigo</i></th>
                                <th class="border border-primary">Estado</th>
                                <th class="border border-primary">Nombre</th>
                                <th class="border border-primary">Monto</th>
                                <th class="border border-primary">Curso</th>
                                <th class="border border-primary">Fecha Pago</th>
                                <th class="border border-primary">Voucher</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <!--resgistro de un alumno-->

                            <?php
                            require_once("./controladores/matriculaControlador.php");
                            $insCurso = new matriculaControlador();
                            echo $insCurso->estadomatriculas(1);
                            ?>

                        </tbody>
                        
                        

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>