<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>


<div class="container">
        <div class="row card mt-4">
        <div class="col-md-12 mt-4">
            <img  class="img-fluid mx-auto d-block" src="https://cersa.org.pe/capacitaciones/sites/default/files/nuevologo.png" alt="" >
        </div>
        <p> <strong>Reporte de asistencia de personal. </strong>
            <br>El trabajador puede reportarse a las siguientes horas<br>
        Horas: 8:00 / 10:00 / 12:30 / 15:00 / 17:00 / 19:00 <br>
        El Trabajador puede reportarse hasta 10 veces en un día

    </p>
    
            <div class="col-md-12 ">
            
                <?php
                   date_default_timezone_set('America/Lima');
                   setlocale(LC_TIME, 'spanish');
                   $hoy=date("Y-m-d");               
                   $hora= date("H:i:s",time());
                  // echo $hoy." Hora :".$hora;

                   

                ?></p>
               
            <div class="table-responsive mt-4">
                <div class="table-responsive">
                    <table class="table table-hover " class="table table-striped table-bordered">
                        <thead class="bg bg-primary text-white">
                            <tr>
                                <th>Fecha</th>  
                                                 
                                <th>Anghie</th> 
                                <th>Andrea</th>   
                                <th>Karla</th>   
                                <th>Sandra</th>  
                                <th>Jeampier</th>  

                                <th>Katia</th>                               
                                <th>Jose</th>  
                                <th>Julio</th>  

                                <th>Jhosting </th> 
                                <th>Luis </th> 

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once("./controladores/administradorControlador.php");
                        $insCurso = new administradorControlador();
                        echo $insCurso->listar_fechas_asistencia();
                        ?>
                        </tbody>
                    
                    </table>
                </div>
           </div>
               </div>
            
        </div>
    </div>
