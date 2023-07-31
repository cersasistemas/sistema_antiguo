<!--CONTENIDO DEL LA PAGINA-->
<div class="container">
        <div class="row card ">
       
                  
               
                <?php
                   date_default_timezone_set('America/Lima');
                   setlocale(LC_TIME, 'spanish');
                   $hoy=date("Y-m-d");               
                   $hora= date("H:i:s",time());
                   //echo $hoy." Hora :".$hora;
                   //echo  $_SESSION['us_nombre'] 

                   

                ?>
               
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-hover" class="table table-striped table-bordered">
                        <thead class="bg bg-warning text-white">
                            <tr>
                            <td>Hora</td>
                                <th>Codigo</th>  
                                                     
                                <th>Asistencia</th>  
                                <th>Reporte diario</th>                                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once("./controladores/administradorControlador.php");
                        $insCurso = new administradorControlador();
                        echo $insCurso->listar_usuarios_per( $_SESSION['us_nombre'] );
                        ?>
                        </tbody>
                    
                    </table>
                </div>
           </div>
              
             


<div class="card p-2">
    <div class="row">

        <div class="col-md-8">
        <p class="text-center text-dark"><i class="fa fa-bullhorn text-danger ">

</i> Debe presionar el boton actualizar antes de marcar su 
asistencia. El boton se activa cada 2 horas
<br> Horas: 8:00  / 10:00 / 12:30 / 15:00 / 17:00 / 19:00
</p>
         
        </div>

       
      
    </div>
    <!--
    <div class="col-md-12">
            <h5 class="text-center text-dark text-center">Cursos Activos</h5>
    </div>-->
</div>


<br>
<div class="row">
    
    <?php

   // require_once("./controladores/cursoControlador.php");

   // $insEspecialidad = new cursoControlador();

  //  echo $insEspecialidad->mostrar_cursos_controlador();

    ?>
</div>
