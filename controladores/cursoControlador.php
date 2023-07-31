<?php


if ($peticionAjax) {
    require_once('../modelos/cursoModelo.php');
} else {
    require_once('./modelos/cursoModelo.php');
}

class cursoControlador extends cursoModelo
{

    public function agregar_curso_controlador()
    {
        $categoria = mainModel::limpiar_cadena($_POST['categoria']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $abreviatura = mainModel::limpiar_cadena($_POST['abreviatura']);
        $duracion = mainModel::limpiar_cadena($_POST['duracion']);
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion']);
        $fechainicio = mainModel::limpiar_cadena($_POST['fechainicio']);
        $fechafin = mainModel::limpiar_cadena($_POST['fechafin']);
        $horario = mainModel::limpiar_cadena($_POST['horario']);
        $costomatricula = mainModel::limpiar_cadena($_POST['costomatricula']);
        $costocertificado = mainModel::limpiar_cadena($_POST['costocertificado']);
        $costoalternativo = mainModel::limpiar_cadena($_POST['costoalternativo']);
        $horascertificado = mainModel::limpiar_cadena($_POST['horascertificado']);
        $modalidad = mainModel::limpiar_cadena($_POST['modalidad']);
        $docente = mainModel::limpiar_cadena($_POST['docente']);
        $sesion="disponible";
        $estadodeatencion=mainModel::limpiar_cadena($_POST['estado_atencion']);;

        $codigopack=mainModel::limpiar_cadena($_POST['codigo_pack']);
        if($categoria==3){

            $consulta3=mainModel::ejecutar_consulta_simple("SELECT 
            MAX(idespecialidad) FROM especialidad ");
            $numero=($consulta3->fetchColumn())+1;
            $codigopack=mainModel::generar_codigo_aleatorio("PACK", 0, $numero);
    
        }else{
            if($codigopack=="SINCODIGO" || $codigopack==""){
                    $codigopack="";
            } else{
                $codigopack=mainModel::limpiar_cadena($_POST['codigo_pack']);
            }
      

        }
        
            if($categoria==1){
            $consulta4=mainModel::ejecutar_consulta_simple("SELECT 
            MAX(idespecialidad) FROM especialidad ");
            $numero4=($consulta4->fetchColumn())+1;
            $codigocurso=mainModel::generar_codigo_aleatorio("CUR",0, $numero4);
            }elseif($categoria==2){
                $consulta4=mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idespecialidad) FROM especialidad ");
                $numero4=($consulta4->fetchColumn())+1;
                $codigocurso=mainModel::generar_codigo_aleatorio("DIP",0, $numero4);
                }else if($categoria==3){
                    $consulta4=mainModel::ejecutar_consulta_simple("SELECT 
                    MAX(idespecialidad) FROM especialidad ");
                    $numero4=($consulta4->fetchColumn())+1;
                    $codigocurso=mainModel::generar_codigo_aleatorio("PK",0, $numero4);
                    }
        
    

        
            $estado_matricula = mainModel::limpiar_cadena($_POST['estado_matricula']);
     

        $datosCurso = [
            "Categoria" => $categoria,
            "Codigocurso" => $codigocurso,
            "Nombre" => $nombre,
            "Abreviatura" => $abreviatura,
            "Descripcion" => $descripcion,
            "Duracion" => $duracion,
            "FechaI" => $fechainicio,
            "FechaF" => $fechafin,
            "Horario" => $horario,
            "Costomatricula" => $costomatricula,
            "Costocerti" => $costocertificado,
            "Costoalternativo" => $costoalternativo,
            "Horascerti" => $horascertificado,
            "Modalidad" => $modalidad,
            "Docente" => $docente,
            "Sesion"=>$sesion,
            "EstadoAtencion"=>$estadodeatencion,
            "CodigoPack"=>$codigopack,
            "EstadoMatricula"=>$estado_matricula

        ];
        $guardarCurso = cursoModelo::agregar_curso_modelo($datosCurso);
       
       /* if($guardarCurso->rowCount()>=1){
            $alerta=[
                "Alerta"=>"limpiar",
                "Titulo"=>"Usuario Registrado",
                "Texto"=>"El usuario se ha registrado con exito en el sistema",
                "Tipo"=>"success"
            ];
        }else{
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"No hemos podido insertar el usuario en el sistema",
                "Tipo"=>"error"
            ];
        }
       */
       
      if($guardarCurso->rowCount()>=1){
           $direccion=SERVERURL."listacurso";
          header('location:'.$direccion);

          
      }

          //  return mainModel::sweet_alert($alerta);

    }


    public function actualizar_curso_controlador()
    {   
        $idespecialidad = mainModel::limpiar_cadena($_POST['idespecialidad']);
        $categoria = mainModel::limpiar_cadena($_POST['categoria']);

        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $abrev = mainModel::limpiar_cadena($_POST['abrev']);
        $duracion = mainModel::limpiar_cadena($_POST['duracion']);
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion']);
        $fechainicio = mainModel::limpiar_cadena($_POST['fechainicio']);
        $fechafin = mainModel::limpiar_cadena($_POST['fechafin']);
        $horario = mainModel::limpiar_cadena($_POST['horario']);
        $costomatricula = mainModel::limpiar_cadena($_POST['costomatricula']);
        $costocertificado = mainModel::limpiar_cadena($_POST['costocertificado']);
        $costoalternativo = mainModel::limpiar_cadena($_POST['costoalternativo']);
        $horascertificado = mainModel::limpiar_cadena($_POST['horascertificado']);
        $modalidad = mainModel::limpiar_cadena($_POST['modalidad']);
        $docente = mainModel::limpiar_cadena($_POST['docente']);

        $codigopack= mainModel::limpiar_cadena($_POST['codigopack']);
        $estado_atencion = mainModel::limpiar_cadena($_POST['estado_atencion']);
        $estado_matricula = mainModel::limpiar_cadena($_POST['estado_matricula']);
        $sesion="disponible";
        $datosCurso = [
            "Idespecialidad" => $idespecialidad,
            "CodigoPack" => $codigopack,
            "Categoria" => $categoria,
            "Nombre" => $nombre,
            "Descripcion" => $descripcion,
            "Duracion" => $duracion,
            "FechaI" => $fechainicio,
            "FechaF" => $fechafin,
            "Horario" => $horario,
            "Costomatricula" => $costomatricula,
            "Costocerti" => $costocertificado,
            "Costoalternativo" => $costoalternativo,
            "Horascerti" => $horascertificado,
            "Modalidad" => $modalidad,
            "Docente" => $docente, 
            "Sesion" => $sesion,
            "EstadoAtencion" => $estado_atencion,
            "EstadoMatricula" => $estado_matricula

        ];

     
        $ActualizarCurso = cursoModelo::actualizar_curso_modelo($datosCurso);
           $direccion=SERVERURL."listacurso";
          header('location:'.$direccion);
    }

    public function crear_grupo__curso_controlador()
    {   
        $codigocurso= mainModel::limpiar_cadena($_POST['codigocurso']);
        $codigopack= mainModel::limpiar_cadena($_POST['codigopack']);
        $categoria = mainModel::limpiar_cadena($_POST['categoria']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $abrev = mainModel::limpiar_cadena($_POST['abrev']);
        $duracion = mainModel::limpiar_cadena($_POST['duracion']);
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion']);
        $fechainicio = mainModel::limpiar_cadena($_POST['fechainicio']);
        $fechafin = mainModel::limpiar_cadena($_POST['fechafin']);
        $horario = mainModel::limpiar_cadena($_POST['horario']);
        $costomatricula = mainModel::limpiar_cadena($_POST['costomatricula']);
        $costocertificado = mainModel::limpiar_cadena($_POST['costocertificado']);
        $costoalternativo = mainModel::limpiar_cadena($_POST['costoalternativo']);
        $horascertificado = mainModel::limpiar_cadena($_POST['horascertificado']);
        $modalidad = mainModel::limpiar_cadena($_POST['modalidad']);
        $docente = mainModel::limpiar_cadena($_POST['docente']);
        $estado_atencion = mainModel::limpiar_cadena($_POST['estado_atencion']);
        $estado_matricula = mainModel::limpiar_cadena($_POST['estado_matricula']);
        $sesion="disponible";

        $consulta8=mainModel::ejecutar_consulta_simple("SELECT 
            COUNT(*) FROM especialidad where codigo_curso='$codigocurso' ");
            $numerogrupo=($consulta8->rowCount());

            $nombre=$nombre."-G".$numerogrupo;
            
    
      
        $datosCurso = [
            "Codigocurso" => $codigocurso,
            "CodigoPack" => $codigopack,
            "Sesion" => $sesion,
            "Categoria" => $categoria,
            "Nombre" => $nombre,
            "Abreviatura" => $abrev,
            "Descripcion" => $descripcion,
            "Duracion" => $duracion,
            "FechaI" => $fechainicio,
            "FechaF" => $fechafin,
            "Horario" => $horario,
            "Costomatricula" => $costomatricula,
            "Costocerti" => $costocertificado,
            "Costoalternativo" => $costoalternativo,
            "Horascerti" => $horascertificado,
            "Modalidad" => $modalidad,
            "Docente" => $docente,
            "EstadoAtencion" => $estado_atencion,
            "EstadoMatricula" => $estado_matricula

        ];
        $ActualizarCurso = cursoModelo::agregar_grupo_curso_modelo($datosCurso);
           $direccion=SERVERURL."listacurso";
          header('location:'.$direccion);
    }


    
    public function eliminar_curso_controlador()
    {
        $idespecialidad = mainModel::limpiar_cadena($_POST['idespecialidad']);
        $estadoactual = 1;
       

        $datosCurso = [
            "Idespecialidad" => $idespecialidad,
            "Estadoactual" => $estadoactual
          

        ];
        $ActualizarCurso = cursoModelo::eliminar_curso_modelo($datosCurso);
           $direccion=SERVERURL."listacurso";
          header('location:'.$direccion);




    }

    public function activar_atencion_curso_controlador()
    {
        $idespecialidad = mainModel::limpiar_cadena($_POST['idespecialidad']);
        $estadodeactivacion= 1;
       

        $datosCurso = [
            "Idespecialidad" => $idespecialidad,
            "Estadoactual" => $estadodeactivacion
          

        ];
        $ActualizarCurso = cursoModelo::activar_atencion_modelo($datosCurso);
           $direccion=SERVERURL."listacurso";
          header('location:'.$direccion);




    }

    public function desactivar_atencion_curso_controlador()
    {
        $idespecialidad = mainModel::limpiar_cadena($_POST['idespecialidad']);
        $estadodeactivacion = 0;
       

        $datosCurso = [
            "Idespecialidad" => $idespecialidad,
            "Estadoactual" => $estadodeactivacion
          

        ];
        $ActualizarCurso = cursoModelo::desactivar_atencion_modelo($datosCurso);
           $direccion=SERVERURL."listacurso";
          header('location:'.$direccion);




    }

    public function cambiar_correos_sino()
    {
       // $arrayidinteres =$_POST['array'];
        $idespecialidad = mainModel::limpiar_cadena($_POST['especialidad']);
     
        $ActualizarArray = cursoModelo::cambiar_estado_correos($idespecialidad);
           $direccion=SERVERURL."enviarcorreos";
          header('location:'.$direccion);
    }


     public function curso_alumnos_cursos_controlador()
     {
         $table = "";
         $conexion = mainModel::conectar();
         $datos = $conexion->query("
         SELECT * FROM especialidad WHERE estado_actual=0  AND estado_matricula=1  ORDER BY codigo_curso ASC ");
 
         $datos = $datos->fetchAll();
         foreach ($datos as $rows) {           
 
             $table .= '
                 <tr>
                             <td>'.$rows['codigo_curso'].'</td>
                             <td>'.$rows['nombre_es'].'</td>                                 
                             <td>
                             <a class="btn btn-success" href="'.SERVERURL.'matriculas/'.$rows['idespecialidad'].'"><i class="fa fa-plus"></i></a>
                         </td>
                             <td>
                                <a class="btn btn-primary" href="'.SERVERURL.'alumnosporcurso/'.$rows['idespecialidad'].'"><i class="fa fa-folder-open"></i>Alumnos</a>
                            </td>
                            <td>'.$rows['descripcion_es'].'</td> 
                           
                         
                 </tr>
 
               ';  
         
        }
         return $table;
     }


      //GRUPOS de un curso definido
      public function grupos_de_un_curso_controlador()
      {
          
          $table = "";
          $codigocurso=$_SESSION['codigocursogeneral'];
          $conexion = mainModel::conectar();
          $datos = $conexion->query("
          SELECT * FROM especialidad WHERE estado_actual=0  AND estado_matricula=1 AND 	codigo_curso='$codigocurso' ORDER BY codigo_curso ASC ");
  
          $datos = $datos->fetchAll();
          foreach ($datos as $rows) {
 
          
  
              //nombre de la categoia
              $idcat = $rows['idcategoria'];
              $datos2 = $conexion->query("
              SELECT nombre_cat FROM categoria WHERE idcategoria='$idcat'");
              foreach ($datos2 as $rows2) {
                  $categoria = $rows2['nombre_cat'];
              }
              $table .= '
                  <tr>
                              <td>'.$rows['codigo_curso'].'</td>
                              <td>'.$categoria.'</td>
                              <td>'.$rows['nombre_es'].' /'.$rows['idespecialidad'].'</td>   ';  
  
  
  
              $table .= ' 
                              <td>
                                 <a class="btn btn-primary" href="'.SERVERURL.'alumnosporcurso/'.$rows['idespecialidad'].'"><i class="fa fa-folder-open"></i>Alumnos</a>
                              </td>
                          
                  </tr>
  
                ';  
          }
         
          return $table;
      }
 
     

    //mostrar tabla estados
    public function leer_cursos_controlador()
    {
        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
        SELECT * FROM especialidad WHERE estado_actual=0 AND estado_atencion=0 ORDER BY `especialidad`.`fecha_inicio` DESC ");

        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {

            //nombre de la categoia
            $idcat = $rows['idcategoria'];
            $datos2 = $conexion->query("
            SELECT nombre_cat FROM categoria WHERE idcategoria='$idcat'");
            foreach ($datos2 as $rows2) {
                $categoria = $rows2['nombre_cat'];
            }


            $table .= '
                <tr>
                        <td>' . $rows['codigo_curso'] . '</td>   
                      
                          
                            <td>' . $rows['nombre_es'] . '</td> 
                            <td>' . $rows['codigo_pack'] . '</td>     ';  


                            //SI ESTA EN ESTADO DESACTIVOAD
                            if($rows['estado_atencion']==0)     {       
            $table .= '     <td>

                            <form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$rows['idespecialidad'].'" readonly="readonly">
                                <button type="submit" name="activar_atencion" id="activar_atencion" class="btn btn-primary"><i class="fa fa-bolt"></i>Activar</button>
                            </form>

                            </td>';
                            }
                          //  SI ESTA EN ESTADO ACTIVO 
                            if($rows['estado_atencion']==1)     {       
                                $table .= '<td>
                                    <form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                                    <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$rows['idespecialidad'].'" readonly="readonly">
                                                    <button type="submit" name="desactivar_atencion" id="desactivar_atencion" class="btn btn-danger"><i class="fa fa-times"></i>Parar</button>
                                    </form>
                                    </td>';
                               }

            $table .= '      <td>
                                <a class="btn btn-warning btn-sm" href="'.SERVERURL.'editarcurso/'.mainModel::encryption($rows['idespecialidad']).'">
                                    <i class="fa fa-pencil"></i> 
                                </a>   
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#'.$rows['idespecialidad'].'1">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                </tr>

              ';

            


                //ELIMINAR
                $table.='
                <div class="modal fade" id="'.$rows['idespecialidad'].'1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header bg-danger text-center">
                            <h4 class="text-light text-center">
                                <button class="btn btn-icons btn-rounded btn-light"><i class="fa fa-exclamation text-danger"></i></button>

                                ¿Esta seguro de eliminar este Curso</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-white">×</span>
                            </button>
                        </div>

                        <!--Body-->
                        <div class="modal-body bg-center">
                            <div class="row">
                              <form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                                         
                                <div class="col-md-2">
                                    <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$rows['idespecialidad'].'" readonly="readonly">
                                </div>
                                <div class="col-md-8 form-group">
                                <button type="submit" name="eliminar_curso" id="eliminar_curso" class="btn btn-danger"><i class="fa fa-check"></i>Eliminar</button>

                                <button type="button" class=" btn btn-info" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class=""><i class="fa fa-meh-o"></i> Cancel</a></span>
                                    </button>
                                </div>
                                <div class="col-md-2"></div>
                            </form>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
                ';


              
        }
        return $table;
    }

    public function cursos_alumno()
    {
        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
        SELECT * FROM especialidad WHERE estado_actual=0  ");

        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {

            //nombre de la categoia
            $idcat = $rows['idcategoria'];
            $datos2 = $conexion->query("
            SELECT nombre_cat FROM categoria WHERE idcategoria='$idcat'");
            foreach ($datos2 as $rows2) {
                $categoria = $rows2['nombre_cat'];
            }


            $table .= '
                <tr>
                        <td>' . $rows['codigo_curso'] . '</td>   
                      
                          
                            <td>' . $rows['nombre_es'] . '</td> 
                           ';  



            $table .= '      <td>
                                <a class="btn btn-warning btn-sm" href="'.SERVERURL.'alumnoslistas/'.$rows['idespecialidad'].'">
                                    Lista de alumnos
                                </a>   
                            </td>
                       
                </tr>

              ';


              
        }
        return $table;
    }
    public function lista_cursos_control()
    {
        $table = "";
        $cont=0;
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
        SELECT idespecialidad,nombre_es,fecha_inicio,fecha_fin FROM especialidad WHERE estado_actual=0 and  YEAR(fecha_fin)='2021' ORDER BY idespecialidad DESC ");

        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            
            $cont=$cont+1;
            

            $table .= '
                <tr>    
                      
                        <td>' . $cont. '</td> 
                        <td>' . $rows['idespecialidad'] . '</td> 
                        <td>' . $rows['nombre_es'] . '</td> 
                        <td>' . $rows['fecha_inicio'] . '</td>
                        <td>' . $rows['fecha_fin'] . '</td> 
                        <td>
                                <a class="btn btn-warning btn-sm" href="'.SERVERURL.'control/'.$rows['idespecialidad'].'">
                                    Lista de alumnos
                                </a>   
                        </td>
                       
                </tr>

              ';


              
        }
        return $table;
    }
    public function historialdecursos()
    {
        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
        SELECT * FROM especialidad WHERE estado_actual=0");

        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {

            //nombre de la categoia
            $idcat = $rows['idcategoria'];
            $datos2 = $conexion->query("
            SELECT nombre_cat FROM categoria WHERE idcategoria='$idcat'");
            foreach ($datos2 as $rows2) {
                $categoria = $rows2['nombre_cat'];
            }


            $table .= '
                <tr>
                        <td>' . $rows['codigo_curso'] . '</td>   
                      
                          
                            <td>' . $rows['nombre_es'] . '</td> 
                            <td>
                            <a class="btn btn-success btn-sm" href="'.SERVERURL.'basesclientes/'.$rows['idespecialidad'].'">
                                Clientes Potenciales
                            </a>   
                        </td>
                </tr>

              ';

            



              
        }
        return $table;
    }

    public function basesanteriores($id)
    {
        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
        SELECT * FROM interes WHERE idespecialidad='$id'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $codigocliente=$rows['codigocliente'];
            $idestado=$rows['idestado'];

            $datoscli = $conexion->query("
            SELECT * FROM cliente WHERE codigocliente='$codigocliente'");    
            $datoscli = $datoscli->fetchAll();
            foreach ($datoscli as $rows2) {
                $nombre=$rows2['nombres_cli'];
                $apellido=$rows2['apellidos_cli'];
                $correo=$rows2['correo_cli'];
                $telefono=$rows2['telefono_cli'];
            }

            $estadocli = $conexion->query("
            SELECT * FROM estado WHERE idestado=$idestado");    
            $estadocli = $estadocli->fetchAll();
            foreach ($estadocli as $rows3) {
                $estadonombr=$rows3['nombre_estado'];
                $color=$rows3['color'];               
            }

          


            $table .= '
                <tr>
                        <td>' .$rows['codigocliente'] . '</td> 
                        <td>' .$nombre.' '.$apellido.'</td> 
                        <td>' .$telefono. '</td> 
                        <td>' .$correo. '</td> 
                        <td style="color:'.$color.'">' .$estadonombr. '</td> 
                        <td>' .$rows['fecha_cambio_estado']. '</td> 
                </tr>

              ';

            



              
        }
        return $table;
    }
    public function leer_cursos_mes_controlador()
    {
        $fecha=date("Y-m-d");
          $elMesPasado = date('Y-m-d', strtotime('-1 month')) ;

        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
        SELECT * FROM especialidad WHERE estado_actual=0 AND estado_atencion=1 ORDER BY `especialidad`.`fecha_inicio` DESC ");

        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {

            //nombre de la categoia
            $idcat = $rows['idcategoria'];
            $datos2 = $conexion->query("
            SELECT nombre_cat FROM categoria WHERE idcategoria='$idcat'");
            foreach ($datos2 as $rows2) {
                $categoria = $rows2['nombre_cat'];
            }


            $table .= '
                <tr>
                        <td>' . $rows['codigo_curso'] . '</td>   
                        <td>' . $rows['nombre_es'] . '</td>  
                            <td>' . $rows['codigo_pack'] . '</td>   
                           ';  


                            //SI ESTA EN ESTADO DESACTIVOAD
                            if($rows['estado_atencion']==0)     {       
            $table .= '     <td>

                            <form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$rows['idespecialidad'].'" readonly="readonly">
                                <button type="submit" name="activar_atencion" id="activar_atencion" class="btn btn-primary"><i class="fa fa-bolt"></i>Activar</button>
                            </form>

                            </td>';
                            }
                          //  SI ESTA EN ESTADO ACTIVO 
                            if($rows['estado_atencion']==1)     {       
                                $table .= '<td>
                                    <form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                                    <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$rows['idespecialidad'].'" readonly="readonly">
                                                    <button type="submit" name="desactivar_atencion" id="desactivar_atencion" class="btn btn-danger"><i class="fa fa-times"></i>Parar</button>
                                    </form>
                                    </td>';
                               }
          
            $table .= '      <td>
                                <a class="btn btn-warning btn-sm" href="'.SERVERURL.'editarcurso/'.mainModel::encryption($rows['idespecialidad']).'">
                                    <i class="fa fa-pencil"></i> 
                                </a>   
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#'.$rows['idespecialidad'].'1">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                </tr>

              ';



                //ELIMINAR
                $table.='
                <div class="modal fade" id="'.$rows['idespecialidad'].'1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header bg-danger text-center">
                            <h4 class="text-light text-center">
                                <button class="btn btn-icons btn-rounded btn-light"><i class="fa fa-exclamation text-danger"></i></button>

                                ¿Esta seguro de eliminar este Curso</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-white">×</span>
                            </button>
                        </div>

                        <!--Body-->
                        <div class="modal-body bg-center">
                            <div class="row">
                              <form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                                         
                                <div class="col-md-2">
                                    <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$rows['idespecialidad'].'" readonly="readonly">
                                </div>
                                <div class="col-md-8 form-group">
                                <button type="submit" name="eliminar_curso" id="eliminar_curso" class="btn btn-danger"><i class="fa fa-check"></i>Eliminar</button>

                                <button type="button" class=" btn btn-info" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class=""><i class="fa fa-meh-o"></i> Cancel</a></span>
                                    </button>
                                </div>
                                <div class="col-md-2"></div>
                            </form>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
                ';


              
        }
        return $table;
    }


    public function formulario_editar_curso($datos){
                $codigo=mainModel::decryption($datos);
                $nombreCat="";
                $table="";

                 $conexion = mainModel::conectar();
                    $datos = $conexion->query("
                    SELECT * FROM especialidad WHERE idespecialidad='$codigo' ");
                    $datos = $datos->fetchAll();
                    foreach ($datos as $rows) {

                        if($rows['idcategoria']==1)
                        {
                            $nombreCat="Curso";
                        }else 
                            if($rows['idcategoria']==2){
                                $nombreCat="Diplomado";
                            }
                            else{
                                $nombreCat="Pack";
                            };

                        $table.=' 

                        &nbsp; '.$rows['nombre_es'].'</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            <!--formulario de registro de un curso-->
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary"> <i class="fa fa-bullhorn text-danger icon-lg"></i> LLene el formulario correctamente </h4>
            
                            <hr>
                        <form  action="'.SERVERURL.'ajax/cursoAjax.php" method="POST" class="forms-sample" autocomplete="off">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="exampleFormControlSelect1">Tipo</label>
                                <select class="form-control form-control-lg" name="categoria" id="categoria">
                                    <option value="'.$rows['idcategoria'].'">'.$nombreCat.'</option>
                                    <option value="1">Curso</option>
                                    <option value="2">Diplomado</option>
                                    <option value="3">Pack</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="exampleFormControlSelect1">Codigo Pack</label>
                                <input type="hidden" class="form-control form-control-lg" name="idespecialidad" id="idespecialidad" value="'.$rows['idespecialidad'].'" placeholder="Nombre del curso o diplomado" required>
                                <input type="text" class="form-control form-control-lg" name="codigopack" id="codigopack" value="'.$rows['codigo_pack'].'" placeholder="Nombre del curso o diplomado">
                       
                            </div>

                            <div class="form-group col-md-6">
                                <label>Nombre</label>
                                   <input type="text" class="form-control form-control-lg" name="nombre" id="nombre" value="'.$rows['nombre_es'].'" placeholder="Nombre del curso o diplomado" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nombre corto</label>
                                   <input type="text" class="form-control form-control-lg" name="abrev" id="abrev" value="'.$rows['abreviatura_es'].'" placeholder="Nombre del curso o diplomado" required>
                            </div>

                            <div class="form-group col-md-6">
                            <label>Descripcion</label>
                            <input type="text" class="form-control form-control-lg" name="descripcion" id="descripcion" value="'.$rows['descripcion_es'].'" placeholder="Corta descripcion del curso" required>
                        </div>
    
                        </div>
    
                        <div class="row">
    
                           
    
                           
    
                                    
                            <div class="form-group col-md-6">
                                <label>Fecha Inicio</label>
                                <div class="input-group date border-primary form_date col-md-12 input-group-append" >
                                    <input class="form-control" type="date"  name="fechainicio" id="fechainicio"  value="'.$rows['fecha_inicio'].'" required>
                                
                                </div>
    
                            </div>
    
    
    
                            <div class="form-group col-md-6">
                                <label>Fecha Fin</label>
                                <div class="input-group date border-primary form_date col-md-12 input-group-append">
                                    <input class="form-control" type="date" name="fechafin" id="fechafin" value="'.$rows['fecha_fin'].'" required>
                                </div>
    
                            </div>
    
                            <div class="form-group col-md-4">
                                <label>Duracion</label>
                                <input type="text" class="form-control form-control-lg" name="duracion" id="duracion" value="'.$rows['duracion_es'].'" placeholder="Duracion" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Horario</label>
                                <input type="text" class="form-control" name="horario" id="horario" value="'.$rows['horario'].'" placeholder="Horario de clases" aria-label="Horario" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Costo Matricula</label>
                                <input type="number" class="form-control" name="costomatricula" id="costomatricula" value="'.$rows['costo_matricula'].'" placeholder="Costo matricula" aria-label="Costo Matricula" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Costo Certificado</label>
                                <input type="number" class="form-control" name="costocertificado" id="costocertificado" value="'.$rows['costo_certi'].'" placeholder="Costo certificado" aria-label="Costo Certificado" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Costo Alternativo</label>
                                <input type="number" class="form-control" name="costoalternativo" id="costoalternativo" value="'.$rows['costo_alternativo'].'" placeholder="Costo alternativo" aria-label="Costo alternativo" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Horas de certificación</label>
                                <input type="text" class="form-control form-control-lg" name="horascertificado" id="horascertificado" value="'.$rows['horas_certificado'].'" placeholder="Horas de certificacion" aria-label="Horas de certificacion" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleFormControlSelect1">Modalidad</label>
                                <select class="form-control form-control-lg" name="modalidad" id="modalidad" required>
                                    <option value="'.$rows['modalidad'].'">Virtual en Vivo</option>
                                    <option value="1">Virtual en Vivo</option>
                                    <option value="2">Virtual /Solo accesos </option>
                                    <option value="3">Presencial </option>
    
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label>Docente</label>
                                <input type="text" class="form-control" name="docente" id="docente" value="'.$rows['docente'].'" placeholder="Nombre del docente" aria-label="Nombre del Docente" required>
                              
                                </div>

                                <div class="form-group col-md-6">
                                <label>Estado de Atencion</label>

                                <select class="form-control form-control-lg" name="estado_atencion" id="estado_atencion" required>
                                    
                                    <option value="1">Activado</option>
                                    <option value="0">Desactivado</option>
                                </select>

                                
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Matricula</label>
                                    <select class="form-control form-control-lg" name="estado_matricula" id="estado_matricula" required>
                                         <option value="1">Activado(Se puede matricular en este curso)</option>
                                        <option value="0">Desactivado(No puede matricular en este curso) </option>
                                    </select>
                                   </div>
    
                        </div>
    
    
                        <div class="row">

                      
                            <div class="form-group">
                                <button type="submit" name="actualizarcurso" class="btn btn-success"><i class="fa fa-check"></i> Actualizar Curso</button>
                                
                                <a href="'.SERVERURL.'listacurso" class="btn btn-info">
                                      <i class="fa fa-meh-o"></i> Cancel
                                </a>
                             </div>
                        </div>
            </form>';
                        $table.='';
                        $table.='';

                     }

                     return $table;
    }



    public function mostrar_notificaciones_controlador(){
        $notifiacion="";
        $clientesnuevos=0;
        $cursorepetido=8000;
        $des=1000000;
        $fecha=date("Y-m-d");
        $nuevosfinal=0;
        $especialidads="";
        $cont=0;
     


        $conexion = mainModel::conectar();
       //session_start(['name'=>'SRCP']);

               

        $cursoocupado=$_SESSION['codigo_srcp'];
        $cursos=$_SESSION['sesioncurso'];
        $curso=$_SESSION['curso'];


        $datosEspeciass = $conexion->query("
        SELECT * FROM especialidad where estado_actual=0 and estado_atencion='1'");
        $datosEspeciass = $datosEspeciass->fetchAll();
        foreach ($datosEspeciass as $rowssespes) {
            $cursoensesion=$rowssespes['sesion'];
          if($cursoensesion==$cursoocupado){
           
            $cont=1;
          }
          else{
            //$cont=0;
          }

        }

        if($cont==0){

            $datosnuevos = $conexion->query("
            SELECT idespecialidad FROM interes WHERE idestado=1 ORDER BY idespecialidad");
            $datosnuevos = $datosnuevos->fetchAll();
            foreach ($datosnuevos as $rowsnuevos) {
                $nuevos=$rowsnuevos['idespecialidad'];
    
               if($nuevos!=$cursorepetido) {
                $cursorepetido=$nuevos;
    
                $datosEspecia = $conexion->query("
                SELECT * FROM especialidad WHERE idespecialidad='$nuevos' AND estado_atencion='1'");
                $datosEspecia = $datosEspecia->fetchAll();
                foreach ($datosEspecia as $rowsespe) {
                    $especialidads=$rowsespe['nombre_es'];
                    $es=$rowsespe['idespecialidad'];
                    
                    $datosfinal = $conexion->query("
                    SELECT COUNT(*) AS nuevosfinal FROM interes 
                    WHERE idespecialidad='$es' and idestado=1");
                    $datosfinal = $datosfinal->fetchAll();
                    foreach ($datosfinal as $rowsfinal) {
                        $nuevosfinal=$rowsfinal['nuevosfinal'];
                    }
    
                }
                }
                        if($nuevos==$des){
                           
                         }else{
                            $des=$nuevos;
                            $notifiacion.='
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                '.$nuevosfinal.'
                                </div>
                              </div>
                              <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-medium text-dark">'.$especialidads.'</h6>
                                <p class="font-weight-light small-text">
                                  Clientes nuevos 
                                </p>
                              </div>
                            </a>';
                      
            }
        }
    
    

    
            $notifiacion.='';
    

        }
      
        if($cont==1 ){
        

            $datosEspecia = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$cursoocupado'");
            $datosEspecia = $datosEspecia->fetchAll();
            foreach ($datosEspecia as $rowsespe) {
                $ides=$rowsespe['idespecialidad'];
                //$especialidads=$rowsespe['nombre_es'];
                
                $datosfinal = $conexion->query("
                SELECT COUNT(*) AS nuevosfinal FROM interes 
                WHERE idespecialidad='$ides' and idestado=1");
                $datosfinal = $datosfinal->fetchAll();
                foreach ($datosfinal as $rowsfinal) {
                    $nuevosfinal=$rowsfinal['nuevosfinal'];
                }


            
            }
                       
                        $notifiacion.='
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                          <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                            '.$nuevosfinal.'
                            </div>
                          </div>
                          <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-medium text-dark">Clientes Nuevos</h6>
                            <p class="font-weight-light small-text">
                              Deben ser atendidos cuanto antes 
                            </p>
                          </div>
                        </a>';



                  
      //contado la cantidad de nuevos
        $datosSesion2 = $conexion->query("
        SELECT COUNT(*) AS nuevos FROM interes WHERE idestado=1");

        $datosSesion2 = $datosSesion2->fetchAll();
        foreach ($datosSesion2 as $rowssesion2) {
            $clientesnuevos=$rowssesion2['nuevos']; }


        //cursos con las notificaciones que esta programadas para hoy
        $datosSesion = $conexion->query("
        SELECT * FROM interes WHERE DATE_FORMAT(`fecha_notificacion`,'%Y-%m-%d')=curdate() AND idespecialidad=$ides");
        $datosSesion = $datosSesion->fetchAll();
        foreach ($datosSesion as $rowssesione) {
            $idinteres=$rowssesione['idespecialidad'];
            $idesinteres=$rowssesione['idinteres'];
            $idestado=$rowssesione['idestado'];
            $codigoclientee=$rowssesione['codigocliente'];
            $hora=$rowssesione['fecha_notificacion'];
            $fechanotificacion=$rowssesione['fecha_notificacion'];

            $resultado=explode(" ",$fechanotificacion);



            $datosSesiones = $conexion->query("
            SELECT * FROM cliente WHERE codigocliente='$codigoclientee'");
            $datosSesiones = $datosSesiones->fetchAll();
            foreach ($datosSesiones as $rowssesiones) {
                $codcliente=$rowssesiones['codigocliente'];
                $nombreCli=$rowssesiones['nombres_cli'];

                $notifiacion.='   <div class="dropdown-divider"></div>
                <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST">
                <input type="hidden" name="enlacecliente" value="'.$codcliente.'">
                <input type="hidden" name="idenestado" value="'.$idestado.'">
                <input type="hidden" name="idinterescontrol" value="'.$idesinteres.'">
               
                             
                
                <button  type="submit" name="vistacambioestado" class="dropdown-item preview-item">
                
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                   1
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-medium text-dark"> '.$codcliente.' : '.$nombreCli.' </h6>
                    <p class="font-weight-light small-text">
                     Llamar a las  '. $resultado[1].' 
                    </p>
                  </div>
                </button>
                </form>';
            
            }
        
        }


        $datosSesion2 = $conexion->query("
        SELECT * FROM interes WHERE DATE_FORMAT(`fecha_notificacion`,'%Y-%m-%d')<curdate() AND  DATE_FORMAT(`fecha_notificacion`,'%Y-%m-%d')<>'0000-00-00'  AND idespecialidad=$ides");
        $datosSesion2 = $datosSesion2->fetchAll();
        foreach ($datosSesion2 as $rowssesione2) {
            $codigoclientees=$rowssesione2['codigocliente'];
            $idinteres=$rowssesione2['idespecialidad'];
            $hora=$rowssesione2['fecha_notificacion'];
            $fechanotificacion=$rowssesione2['fecha_notificacion'];
            $idesinteresr=$rowssesione2['idinteres'];
            $idestador=$rowssesione2['idestado'];

            $resultado=explode(" ",$fechanotificacion);



            $datosSesiones = $conexion->query("
            SELECT * FROM cliente WHERE codigocliente='$codigoclientees'");
            $datosSesiones = $datosSesiones->fetchAll();
            foreach ($datosSesiones as $rowssesiones) {
                $codclientes=$rowssesiones['codigocliente'];
                $nombreClis=$rowssesiones['nombres_cli'];

                $notifiacion.='   <div class="dropdown-divider"></div>
                <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST">
                <input type="hidden" name="enlacecliente" value="'.$codigoclientees.'">
                <input type="hidden" name="idenestado" value="'.$idestador.'">
                <input type="hidden" name="idinterescontrol" value="'.$idesinteresr.'">
               
                  
                <button  type="submit" name="vistacambioestado" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-danger">
                   1
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-medium text-dark">'.$codclientes.' : '.$nombreClis.'  </h6>
                    <p class="font-weight-light small-text">
                    Debio llamar el '. $resultado[0].'  a las  '. $resultado[1].' 
                    </p>
                  </div>
                </button>
                </form>';
            
            }
        
        }

    }
        $notifiacion.='
        
        ';
        return $notifiacion;

    }

    public function notificacion(){
        $panel="";
        $total=0;
        $user=$_SESSION['codigo_srcp'];
        $conexion = mainModel::conectar();


        $consulta3=mainModel::ejecutar_consulta_simple("
        SELECT idespecialidad FROM especialidad WHERE sesion like '$user'");
        $cursosesion=($consulta3->fetchColumn(0));

        if(empty($cursosesion))
        {
            $datosSesiones = $conexion->query("
            SELECT idespecialidad,grupo, nombre_es FROM especialidad WHERE estado_atencion=1");
            $datosSesiones = $datosSesiones->fetchAll();
            foreach ($datosSesiones as $rowssesiones) {
                $ides=$rowssesiones['idespecialidad'];
                $grupo=$rowssesiones['grupo'];
           
            $consulta3=mainModel::ejecutar_consulta_simple("
            SELECT COUNT(*) FROM interes WHERE idespecialidad=$ides 
            and grupo=$grupo and idestado=1");
            $cantidad=($consulta3->fetchColumn(0));
    
            if($cantidad>=1){
                $panel.='
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                        '.$cantidad.'
                    </div>
                </div>
                <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-medium text-dark">
                    '.$rowssesiones['nombre_es'].'
                    </h6>
                    <p class="font-weight-light small-text">
                    Clientes nuevos 
                    </p>
                </div>
                </a>';
                 }
            }
        }else{
            $consulta3=mainModel::ejecutar_consulta_simple("
            SELECT grupo FROM especialidad WHERE idespecialidad=$cursosesion");
            $grupo=($consulta3->fetchColumn(0));

            $dats = $conexion->query("
            SELECT 
                codigocliente, 
                idinteres, 
                DATE_FORMAT(fecha_notificacion,'%Y-%m-%d') as fecha,
                DATE_FORMAT('fecha_notificacion','%H:%i:%s') as hora,
                fecha_notificacion
            FROM interes WHERE
            idespecialidad='$cursosesion' and grupo=$grupo and idestado='6'
            and DATE_FORMAT(fecha_notificacion,'%Y-%m-%d')<=curdate()
            and DATE_FORMAT(`fecha_notificacion`,'%Y-%m-%d')<>'0000-00-00'");

            $dats = $dats->fetchAll();
            foreach ($dats as $row) {
            $codigocliente=$row['codigocliente'];
            $idinteres=$row['idinteres'];
            $fecha=$row['fecha_notificacion'];
            $hora=$row['hora'];
            $resultado=explode(" ",$fecha);

            $consultaf=mainModel::ejecutar_consulta_simple("
            SELECT nombres_cli FROM cliente WHERE codigocliente like '$codigocliente'");
            $nombre=($consultaf->fetchColumn(0));
            
            if($row['fecha']==date("Y-m-d")){
                $panel.='
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="'.SERVERURL.'sesionestados/'.$idinteres.'/6">
                    <div class="preview-thumbnail">
                    
                            <div class="preview-icon bg-warning">
                                <span class="text-center">
                                    &nbsp; <i class="fa fa-exclamation"></i>
                                </span>
                            </div>
                    
                    </div>
                        <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-medium text-dark">
                        '.$nombre.'
                        </h6>
                        <p class="font-weight-light small-text">
                        Debe llamar a las '.$resultado[1].'
                        </p>
                    </div>
                </a>';
            }
            else{
                $panel.='
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="'.SERVERURL.'sesionestados/'.$idinteres.'/6">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-danger">
                            <span class="text-center">
                            &nbsp; <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-medium text-dark">
                            '.$nombre.'
                        </h6>
                        <p class="font-weight-light small-text">
                           Debio llamar el : '.$fecha.'
                        </p>
                    </div>
                 </a>';
            }
           
            }
        }
      


        return $panel;

    }
    //mostrar cursos en el inicio
    public function mostrar_cursos_controlador()
    {
        
        $tarjeta = "";
   
        $conexion = mainModel::conectar();
        $time = time();
        $tim= date("d-m-Y (H:i:s)");


        $fecha=date("Y-m-d", $time);
       // $tarjeta .= '<p class="bg bg-success mt-2 text-white">INICIA HOY '.$tim.'</p>';

        //validacion 
        $codigousuario=$_SESSION['codigo_srcp'];
        $con=0;
        $datosSesion = $conexion->query("
        SELECT COUNT(*) AS sesiones FROM especialidad WHERE sesion='$codigousuario'");
        $datosSesion = $datosSesion->fetchAll();
        foreach ($datosSesion as $rowssesion) {
           if($rowssesion['sesiones']>=1){
                $con=1;
           }
        }
        
       

        if($con==0){
            $datos = $conexion->query("
                SELECT * FROM especialidad WHERE estado_actual=0 AND  estado_atencion=1 ORDER BY sesion<>'disponible' DESC,	fecha_inicio ");
    
             $datos = $datos->fetchAll();
            foreach ($datos as $rows) {


            $tarjeta .= '
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card text-center bg-center ">
            ';
           
             if($rows['fecha_inicio']==$fecha)
              {  $tarjeta .= '
                            <div class="card2 card-statistics bg bg-secondary">
                            <p class="bg bg-success mt-2 text-white">INICIA HOY '.$tim.'</p>
                            ';

              }
             else
                 $tarjeta .= '  <div class="card2 card-statistics ">';

            $tarjeta .= '<div class="card-body3 " >
                <div class="clearfix">
                  <h5 class="text-center">'.$rows['nombre_es'].'</h5>
                  <hr>
    
                  <div class="float-left">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fa fa-calendar-o icon-sm text-dark"></i>
                          <p class="mb-0 ml-1">
                          FI : '.$rows['fecha_inicio'].'
                          </p>
                          
                      </div>

                    

                      <div class="d-flex flex-row align-items-center">
                          <i class="fa fa-money icon-sm text-dark"></i>
                          <p class="mb-0 ml-1">
                          S/. '.($rows['costo_matricula']+$rows['costo_certi']).'
                          </p>
                      </div>
                    
                  </div>
                  <div class="float-right">
                    <p class="mb-0 text-right">Registros</p>
                    <div class="fluid-container">
                      <h3 class="font-weight-medium text-right mb-0">';
            $grupo=$rows['grupo'];
            $idinteres= $rows['idespecialidad'];
             $datos2 = $conexion->query("
            SELECT COUNT(*)  AS total FROM interes WHERE idespecialidad=$idinteres AND grupo='$grupo'");
            $datos2 = $datos2->fetchAll();
            foreach ($datos2 as $rows2) {
                
            $tarjeta .= '<p><i class="fa fa-list-ul icon-sm text-dark"></i> '.$rows2['total'].'</p>';

            }
            $tarjeta .= '
                        </h3>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                   <div class="btn-group" role="group" aria-label="First group">';

               if($rows['sesion']==$_SESSION['codigo_srcp']){
                $tarjeta .= '<a href="sesionestadoactual/0" class="btn btn-success"><i class="fa fa-star-o"></i> En linea</a>
               ';
             }
                if($rows['sesion']=="disponible"){
                  $tarjeta .= '<form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
                    <input type="hidden" name="codigocurso" value="'.$rows['idespecialidad'].'">
                    <input type="hidden" name="codigousuario" value="'.$_SESSION['codigo_srcp'].'">
                    <button type="submit" name="ocuparcurso"  class="btn btn-primary"><i class="fa fa-star-o"></i> Libre </button>
                   </form>  ';
                }

                if($rows['sesion']!=$_SESSION['codigo_srcp'] && $rows['sesion']!="disponible"){
                    $tarjeta .= '<a href="" class="btn btn-danger"> Ocupado</a>
                   ';
                 }

                
            
            $tarjeta .= '<form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
            <input type="hidden" name="codigocursover" value="'.$rows['idespecialidad'].'">
            <button type="submit" name="verinfocurso"  class="btn btn-dark"><i class="fa fa-eye"></i> Ver </button>
             </form>  
            
                      </div>
                  </div>
                  
                </div>
                
              
                ';
                  
                    $codigouser=$rows['sesion'];
                    $datosUSER = $conexion->query("
                        SELECT nombre_us FROM usuario WHERE codigousuario='$codigouser'");
                
                    $datosUSER = $datosUSER->fetchAll();
                    foreach ($datosUSER as $rowsUSER) {
                     $tarjeta .= ' <p class="text-muted mt-3 mb-0">
                     <i class="fa fa-user-circle-o mr-1" aria-hidden="true"></i> '.$rowsUSER['nombre_us'].'</p>';
                    }
            $tarjeta .= ' 
              </div>
            </div>
          </div>

                ';
        }}
        

        if($con==1){
            $datos = $conexion->query("
                SELECT * FROM especialidad WHERE sesion!='disponible'  ORDER BY 	fecha_inicio");
        
            $datos = $datos->fetchAll();
            foreach ($datos as $rows) {
    
    
                $tarjeta .= '
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body2">
                    <div class="clearfix">
                      <h4 class="text-center">'.$rows['nombre_es'].'</h4>
                      <div class="float-left">
                        <div class="d-flex flex-row align-items-center">
                            <i class="mdi mdi-compass icon-sm text-danger"></i>
                              <p class="mb-0 ml-1">
                              '.$rows['fecha_inicio'].'
                              </p>
                          </div>
                          <div class="d-flex flex-row align-items-center">
                              <i class="mdi mdi-compass icon-sm text-danger"></i>
                              <p class="mb-0 ml-1">
                              '.$rows['costo_matricula'].'
                              </p>
                          </div>
                        
                      </div>
                      <div class="float-right">
                        <p class="mb-0 text-right">Registros</p>
                        <div class="fluid-container">
                          <h3 class="font-weight-medium text-right mb-0">';
    
                $idinteres= $rows['idespecialidad'];
                $grupo= $rows['grupo'];
                 $datos2 = $conexion->query("
                SELECT COUNT(*)  AS total FROM interes WHERE idespecialidad=$idinteres AND grupo='$grupo'");
                $datos2 = $datos2->fetchAll();
                foreach ($datos2 as $rows2) {
                    
                $tarjeta .= '<p> '.$rows2['total'].'</p>';
    
                }
                $tarjeta .= '
                            </h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                       <div class="btn-group" role="group" aria-label="First group">';
    
                   if($rows['sesion']==$_SESSION['codigo_srcp']){
                    $tarjeta .= '<a href="sesionestadoactual/0" class="btn btn-success"><i class="fa fa-star-o"></i> En linea</a>
                   ';
                 }
                    if($rows['sesion']=="disponible"){
                      $tarjeta .= '<form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
                        <input type="hidden" name="codigocurso" value="'.$rows['idespecialidad'].'">
                        <input type="hidden" name="codigousuario" value="'.$_SESSION['codigo_srcp'].'">
                        <button type="submit" name="ocuparcurso"  class="btn btn-primary"><i class="fa fa-star-o"></i> Libre </button>
                       </form>  ';
                    }
    
                    if($rows['sesion']!=$_SESSION['codigo_srcp'] && $rows['sesion']!="disponible"){
                        $tarjeta .= '<a href="" class="btn btn-danger"> Ocupado</a>
                       ';
                     }
                     

                     $tarjeta .= '<form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
            <input type="hidden" name="codigocursover" value="'.$rows['idespecialidad'].'">
            <button type="submit" name="verinfocurso"  class="btn btn-dark"><i class="fa fa-eye"></i> Ver </button>
             </form>  
                    
                     </div>
                      </div>
                      
                    </div>
                    
                  
                    
                ';
                  
                $codigouser=$rows['sesion'];
                $datosUSER = $conexion->query("
                    SELECT nombre_us FROM usuario WHERE codigousuario='$codigouser'");
            
                $datosUSER = $datosUSER->fetchAll();
                foreach ($datosUSER as $rowsUSER) {
                 $tarjeta .= ' <p class="text-muted mt-3 mb-0">
                 <i class="fa fa-user-circle-o mr-1" aria-hidden="true"></i> Usuario:  '.$rowsUSER['nombre_us'].'</p>';
                }
        $tarjeta .= ' 
               
               
        </div>
        </div>
        </div>
    
                    ';
            }}
        return $tarjeta;
    }


    public function activar_variable_codigocursogeneral()
    {  
        session_start(['name'=>'SRCP']);
        $_SESSION['codigocursogeneral']=$_POST['codigocurso'];

        $direccion=SERVERURL."gruposdecurso";
        header('location:'.$direccion);
    
    } 
     


 

    public function mostrar_tabla_cursos_controlador()
    {
        
        $tarjeta = "";
        $conexion = mainModel::conectar();
        $fecha=date("Y-m-d");

        //validacion 
        $codigousuario=$_SESSION['codigo_srcp'];
        $con=0;
        $datosSesion = $conexion->query("
        SELECT COUNT(*) AS sesiones FROM especialidad WHERE sesion='$codigousuario'");

        $datosSesion = $datosSesion->fetchAll();
        foreach ($datosSesion as $rowssesion) {
           if($rowssesion['sesiones']>=1){
                $con=1;
           }
        }

        if($con==0){
        $datos = $conexion->query("
            SELECT * FROM especialidad WHERE estado_actual=0 ORDER BY sesion<>'disponible' DESC,	fecha_inicio ");
    
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {

            $tarjeta .= '  
                <tr class="bg bg-inverse-primary">
                    <td>'.$rows['nombre_es'].'</td>
                   
                                      
                 ';

  


       

               if($rows['sesion']==$_SESSION['codigo_srcp']){
                $tarjeta .= '<td><a href="sesioncurso" class="btn btn-success"><i class="fa fa-star-o"></i> En linea</a></td>
               ';
             }
                if($rows['sesion']=="disponible"){
                  $tarjeta .= '<td><form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
                    <input type="hidden" name="codigocurso" value="'.$rows['idespecialidad'].'">
                    <input type="hidden" name="codigousuario" value="'.$_SESSION['codigo_srcp'].'">
                    <button type="submit" name="ocuparcurso"  class="btn btn-primary"> lIbre </button>
                   </form></td>  ';
                }

                if($rows['sesion']!=$_SESSION['codigo_srcp'] && $rows['sesion']!="disponible"){
                    $tarjeta .= '<td><a href="" class="btn btn-danger"> Ocupado</a></td>
                   ';
                 }

                
            
            $tarjeta .= '<td><form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
            <input type="hidden" name="codigocursover" value="'.$rows['idespecialidad'].'">
            <button type="submit" name="verinfocurso"  class="btn btn-dark"><i class="fa fa-eye"></i> Ver </button>
             </form> </td>
             
             <td><i class="fa fa-user-o"></i> 
            
                 
              
                ';
                  
                    $codigouser=$rows['sesion'];
                    $datosUSER = $conexion->query("
                        SELECT nombre_us FROM usuario WHERE codigousuario='$codigouser'");
                
                    $datosUSER = $datosUSER->fetchAll();
                    foreach ($datosUSER as $rowsUSER) {
                     
                            $tarjeta .= '
                            '.$rowsUSER['nombre_us'].'';

                    }

                    $tarjeta .= '</td></tr>';
        
        }}

        if($con==1){
            $datos = $conexion->query("
                SELECT * FROM especialidad WHERE sesion!='disponible'  ORDER BY 	fecha_inicio");
        
            $datos = $datos->fetchAll();
            foreach ($datos as $rows) {
    
    
                $tarjeta .= '  
                <tr>
                    <td>'.$rows['nombre_es'].'</td>
                    <td>'.$rows['fecha_inicio'].'</td>
                    <td>'.($rows['costo_matricula']+$rows['costo_certi']).'</td>
                                  
                 ';

    
                $idinteres= $rows['idespecialidad'];
                 $datos2 = $conexion->query("
                SELECT COUNT(*)  AS total FROM interes WHERE idespecialidad=$idinteres");
                $datos2 = $datos2->fetchAll();
                foreach ($datos2 as $rows2) {
                    
                $tarjeta .= '<td> '.$rows2['total'].'</td>';
    
                }
                  
                   if($rows['sesion']==$_SESSION['codigo_srcp']){
                    $tarjeta .= '<td> <a href="sesioncurso" class="btn btn-success"><i class="fa fa-star-o"></i> En linea</a></td> 
                   ';
                 }
                    if($rows['sesion']=="disponible"){
                      $tarjeta .= '<td><form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
                        <input type="hidden" name="codigocurso" value="'.$rows['idespecialidad'].'">
                        <input type="hidden" name="codigousuario" value="'.$_SESSION['codigo_srcp'].'">
                        <button type="submit" name="ocuparcurso"  class="btn btn-primary"><i class="fa fa-star-o"></i> Disponible </button>
                       </form></td>   ';
                    }
    
                    if($rows['sesion']!=$_SESSION['codigo_srcp'] && $rows['sesion']!="disponible"){
                        $tarjeta .= '<td><a href="" class="btn btn-danger"><i class="fa fa-star-o"></i> Ocupado</a></td>
                       ';
                     }
                     

                     $tarjeta .= '<td><form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
            <input type="hidden" name="codigocursover" value="'.$rows['idespecialidad'].'">
            <button type="submit" name="verinfocurso"  class="btn btn-dark"><i class="fa fa-eye"></i> Ver </button>
             </form></td>  
                    
                   
                  
                    
                ';
                  
                $codigouser=$rows['sesion'];
                $datosUSER = $conexion->query("
                    SELECT nombre_us FROM usuario WHERE codigousuario='$codigouser'");
            
                $datosUSER = $datosUSER->fetchAll();
                foreach ($datosUSER as $rowsUSER) {
                 $tarjeta .= '<td>  Usuario:  '.$rowsUSER['nombre_us'].'</td></tr>';
                }
     
            }}
            
        return $tarjeta;
    }



    /*public function iniciar_sesion_curso(){
        session_start(['name'=>'SRCP']);

        if($_SESSION['sesioncurso']=="libre"){
            $Codigo=$_GET['Curso'];
           //$Codigo=1;
           $_SESSION['curso']= $Codigo;
            $datos=[
                "Usuario"=>$_SESSION['codigo_srcp'],
                 "Curso"=>$Codigo
              
            ];
            //return "true";
            return cursoModelo::iniciar_sesion_curso_modelo($datos);
        }
        else if($_SESSION['sesioncurso']=="ocupado"){
            return "ocupado";
        }else{
            return "false";
        }
     
       
    }*/

   /* public function cerrar_sesion_curso(){
        session_start(['name'=>'SRCP']);

        if($_SESSION['sesioncurso']=="ocupado"){
            $Codigo=$_GET['Especialidad'];
           //$Codigo=1;
         
            $datos=[
              
                 "Curso"=>$Codigo
              
            ];
            //return "true";
            return cursoModelo::cerrar_sesion_curso_modelo($datos);
        }
       else{
            return "false";
        }
     
       
    }*/
     //mostrar cursos en el inicio
    /* public function mostrar_sesion_cursos_controlador()
     {
        //session_start(['name'=>'SRCP']);
        //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
         $tarjeta = "";
         $conexion = mainModel::conectar();
         $curso=$_SESSION['curso'];      
         $datosd = $conexion->query("
             SELECT * FROM especialidad WHERE idespecialidad='$curso' ");
 
         $datosd = $datosd->fetchAll();
         foreach ($datosd as $rows) {
 
 
             $tarjeta .= '
                    '.$rows['nombre_es'].'
                
                 ';
         }
         return $tarjeta;
     }
*/

     public function mostrar_sesion2_cursos_controlador()
     {
        $codigocurso = mainModel::limpiar_cadena($_POST['codigocurso']);
        $codigousuario = mainModel::limpiar_cadena($_POST['codigousuario']);
       

        $datosCurso = [
            "Codigocurso" => $codigocurso,
            "Codigusuario" => $codigousuario,
        

        ];
        $guardarsesionCurso = cursoModelo::agregar_sesion_curso_modelo($datosCurso);
        if($guardarsesionCurso->rowCount()>=1){
            $direccion=SERVERURL."sesionestadoactual/0";
           header('location:'.$direccion);

          
        }

        
    
    
    }

    public function ver_curso_controlador(){
        $codigocurso = mainModel::limpiar_cadena($_POST['codigocursover']);
       // $guardarsesionCurso = cursoModelo::agregar_sesion_curso_modelo($datosCurso);
       session_start(['name'=>'SRCP']);
       $_SESSION['cursover']=$codigocurso;
            $direccion=SERVERURL."vercurso";
           header('location:'.$direccion);

        
    }

    public function mostrar_nombre_curso_grupo(){
       // $codigocurso = mainModel::limpiar_cadena($_POST['codigocursover']);
       // $guardarsesionCurso = cursoModelo::agregar_sesion_curso_modelo($datosCurso);
      // session_start(['name'=>'SRCP']);
      $nombrecurso="Ocurrio un error";
      $cont=0;
      $variable=$_SESSION['codigocursogeneral'];
      $conexion=mainModel::conectar();
      $datos = $conexion->query("
      SELECT nombre_es FROM especialidad WHERE estado_actual=0 AND codigo_curso='$variable' ORDER BY codigo_curso ");
      $datos = $datos->fetchAll();
      foreach ($datos as $rows) {
          if($cont==0){
             $nombrecurso=$rows['nombre_es'];
                $cont++;
        }
    }

        return $nombrecurso;

        
    }

    public function cerrar_cursos2_controlador()
    {
       $codigocerrar= mainModel::limpiar_cadena($_POST['codigocerrar']);
     
       $datosCursoCerrar = [
           "Codigocursoc" => $codigocerrar  

       ];
       $guardarsesionCurso = cursoModelo::cerrar_sesion_curso_modelo($datosCursoCerrar);
       if($guardarsesionCurso->rowCount()>=1){
           $direccion=SERVERURL."home";
          header('location:'.$direccion);
         
       }
 
   }

   public function top_curso_controlador(){
    $tarjeta = "";

    $conexion=mainModel::conectar();
    $datos = $conexion->query("
    SELECT * FROM especialidad WHERE estado_actual=0  ORDER BY 	fecha_inicio");

    $datos = $datos->fetchAll();
    foreach ($datos as $rows) {

        
        

        $tarjeta .= '
        <div class="col-sm-4 col-md-3 grid-margin stretch-card ¿">
            <div class="card  badge-success">
                <div class="card-body">
                    <h4 class="card-title text-white text-center"><i class="fa fa-graduation-cap"></i>'.$rows['nombre_es'].'</h4>
                    <div class="media">
                        <h1>1 | </h1>
                        <div class="media-body">
                           ';

                        $idinteres= $rows['idespecialidad'];
                        $datos2 = $conexion->query("
                        SELECT COUNT(*)  AS total FROM interes WHERE idespecialidad=$idinteres");
                        $datos2 = $datos2->fetchAll();
                        foreach ($datos2 as $rows2) {
                            
                        $tarjeta .= ' <h4 class="card-text text-center">Número de Participantes : '.$rows2['total'].'</h4>';

                          }
                                
                         $tarjeta .= '</div>
                    </div>
                </div>
            </div>
        </div>';
   }
    return $tarjeta;
   }

   public function ver_sesion_curso_exitoso_controlador()
   {
      //session_start(['name'=>'SRCP']);
      //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
       $tarjeta = "";
       $totalpre=0;
       
       $contadorestados=array();
       $conexion = mainModel::conectar();
       $usuario=$_SESSION['codigo_srcp'];
       $datosd = $conexion->query("
           SELECT * FROM especialidad WHERE sesion='$usuario' ");

       $datosd = $datosd->fetchAll();
       foreach ($datosd as $rows) {



           $tarjeta .= '
               ';

               //Descripcion del curso 
               $tarjeta .= '
                   <div class="row">
                   <div class="col-lg-12 grid-margin stretch-card">
                       <div class="card">
                           <div class="card-body">
                               <div class="row ">
                               ';

                              //ESTADOS
                                //SECCION ESTADOS
                                $te=0;
                                $estadoinicial=0;
                                $idespecialidad=$rows['idespecialidad'];
                                $datosInteress = $conexion->query("
                                SELECT COUNT(*) AS totalestado FROM interes WHERE idespecialidad='$idespecialidad'");
                            $datosInteress = $datosInteress->fetchAll();
                            foreach ($datosInteress as $rowsIntd) {
                                $te=$rowsIntd['totalestado'];
                                
                            
                        }
                                                   
                                $tarjeta .= '    
                       

                                 <div class="col-md-2 badge " style="background-color:#D14DFF;">
                                                                          <button type="submit" name="estadoespecifico" class="btn" style="background-color:#D14DFF;" >
                                  <div class="wrapper d-flex justify-content-between">
                                     <div class="side-left">
                                   
                                         <p class="mb-2 ">Total</p>
                                         <p class="display-3 mb-4 font-weight-light text-white" >'.$te.'</p>
                                     </div>
                                    
                                 </div>
                                 </button>

                               
                             </div>


                             
                                ';
                               //$estado=$rows['idestado'];
                               $to=0;
                               $datosEstado = $conexion->query("
                               SELECT * FROM estado WHERE estado_actual=1");
                               $datosEstado = $datosEstado->fetchAll();
                               foreach ($datosEstado as $rowsEstado){ 




                                       //datos de interes 
                                           $t=80;
                                           $idestado=$rowsEstado['idestado'];
                                      
                                           $idespecialidad=$rows['idespecialidad'];
                                           $datosInteres = $conexion->query("
                                           SELECT COUNT(*) AS totalestado FROM interes WHERE idespecialidad='$idespecialidad' AND idestado='$idestado'");
                                       $datosInteres = $datosInteres->fetchAll();
                                       foreach ($datosInteres as $rowsInt) {
                                           $t=$rowsInt['totalestado'];

                                           if( $idestado==8){
                                            $totalpre=$t;
                                        }
                                           
                                       
                                   }

                                
                                                       
                               $tarjeta .= '    
                                  <div class="col-md-2 badge " style="background-color:'.$rowsEstado['color'].';">
                                                   <button type="submit" name="estadoespecifico" class="btn" style="background-color:'.$rowsEstado['color'].';" >
                                        <div class="wrapper d-flex justify-content-between">
                                           <div class="side-left">
                                         
                                               <p class="mb-2 ">'.$rowsEstado['nombre_estado'].'</p>
                                               <p class="display-3 mb-4 font-weight-light text-white" >'.$t.'</p>
                                           </div>
                                          
                                       </div>
                                       </button>

                                      
                                   </div>
                                  ';
                               }
                               $preinscritos=$te-$totalpre;
                               $tarjeta .= ' 
                               <div class="col-md-2 badge-center " style="background-color:#5DE87A;">
                              
                                   <div class="wrapper d-flex justify-content-between ">
                                       <div class="side-left">
                                       
                                           <p class="mb-2 ">Preinscritos</p>
                                           <p class=" display-3 mb-4 font-weight-light text-white" > '.$preinscritos.'</p>
                                       </div>
                                   </div>                                                               
                               </div>
                             
                         
                               </div>
                           </div>
                       </div>
                   </div>
               </div>';
       }
       return $tarjeta;
   }
   public function mostrar_correos_yaenviados()
   {
    $correos = "";
    $emails="";
    $conexion = mainModel::conectar();
    $usuario=$_SESSION['codigo_srcp'];

    $datosd = $conexion->query("
    SELECT * FROM especialidad WHERE sesion='$usuario' ");
    $datosd = $datosd->fetchAll();
    foreach ($datosd as $rows) {

        $idespecialidad=$rows['idespecialidad'];
        
        $datosInteress = $conexion->query("
        SELECT codigocliente FROM interes WHERE idespecialidad='$idespecialidad' AND envio_correo=1");
        $datosInteress = $datosInteress->fetchAll();
        foreach ($datosInteress as $rowsIntd) {
           


        $codigoCliente=$rowsIntd['codigocliente'];
        $datosCliente = $conexion->query("
        SELECT correo_cli FROM cliente WHERE codigocliente='$codigoCliente' and correo_cli LIKE '%@%' ");
        $datosCliente = $datosCliente->fetchAll();
     
        foreach ($datosCliente as $rowsCliente) {
           // $emails=$rowsCliente['correo_cli'];
            $correos .=''.$rowsCliente['correo_cli'].'<br>';
        }
    }


    }
    return $correos;
   }

   public function mostrar_correos()
   {
    $correos = "";
    $emails="";
    $conexion = mainModel::conectar();
    $usuario=$_SESSION['codigo_srcp'];

    $datosd = $conexion->query("
    SELECT * FROM especialidad WHERE sesion='$usuario' ");
    $datosd = $datosd->fetchAll();
    foreach ($datosd as $rows) {

        $idespecialidad=$rows['idespecialidad'];
        
        $datosInteress = $conexion->query("
        SELECT codigocliente FROM interes WHERE idespecialidad='$idespecialidad' and envio_correo=0");
        $datosInteress = $datosInteress->fetchAll();
        foreach ($datosInteress as $rowsIntd) {
           


        $codigoCliente=$rowsIntd['codigocliente'];
        $datosCliente = $conexion->query("
        SELECT correo_cli FROM cliente WHERE codigocliente='$codigoCliente' and correo_cli LIKE '%@%' ");
        $datosCliente = $datosCliente->fetchAll();
     
        foreach ($datosCliente as $rowsCliente) {
           // $emails=$rowsCliente['correo_cli'];
            $correos .=''.$rowsCliente['correo_cli'].'<br>';
        }
    }


    }
    return $correos;
   }

   public function mostrar_correos_dos()
   {
    $correos = "";
    $emails="";
    $conexion = mainModel::conectar();
    $usuario=$_SESSION['codigo_srcp'];

    $datosd = $conexion->query("
    SELECT * FROM especialidad WHERE sesion='$usuario' ");
    $datosd = $datosd->fetchAll();
    foreach ($datosd as $rows) {

        $idespecialidad=$rows['idespecialidad'];
        
        $datosInteress = $conexion->query("
        SELECT codigocliente FROM interes WHERE idespecialidad='$idespecialidad' and envio_correo=0");
        $datosInteress = $datosInteress->fetchAll();
        foreach ($datosInteress as $rowsIntd) {
           


        $codigoCliente=$rowsIntd['codigocliente'];
        $datosCliente = $conexion->query("
        SELECT correo_cli FROM cliente WHERE codigocliente='$codigoCliente' and correo_cli LIKE '%@%' ");
        $datosCliente = $datosCliente->fetchAll();
     
        foreach ($datosCliente as $rowsCliente) {
           // $emails=$rowsCliente['correo_cli'];
            $correos .=''.$rowsCliente['correo_cli'].',';
        }


    }

    $correos.='';


    }
    return $correos;
   }

   public function cambiar_correo_enviado()
   {
    $correos = "";
    $theVariable = array();
    $emails="";
    $conexion = mainModel::conectar();
    $usuario=$_SESSION['codigo_srcp'];
    $cont=0;

    function array_envia($array) { 
        $tmp = serialize($array); 
        $tmp = urlencode($tmp); 
        return $tmp; 
    }

    $datosd = $conexion->query("
    SELECT * FROM especialidad WHERE sesion='$usuario' ");
    $datosd = $datosd->fetchAll();
    foreach ($datosd as $rows) {

        $idespecialidad=$rows['idespecialidad'];      
    
    $correos.=' 
    <form class="forms-sample" action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">
        <div class="form-group"> 
            <input type="hidden" name="especialidad" value="'.$idespecialidad.'">  
            <button type="submit" name="enviar_correos" class="btn btn-primary mr-2">Ya envie correos</button>
        </div>
    </form>
    <a href="'.SERVERURL.'sesionestadoactual/0" class="btn btn-dark mr-2">Cancelar</a>
    <a href="'.SERVERURL.'sesionestadoactual/0" class="btn btn-dark mr-2">Regresar</a>
    
   
    ';


    }
    return $correos;
   }


    public function sesion_curso_exitoso_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $tarjeta = "";
        $totalpre=0;
        $contadorestados=array();
        $conexion = mainModel::conectar();
        $usuario=$_SESSION['codigo_srcp'];
        $datosd = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");

        $datosd = $datosd->fetchAll();
        foreach ($datosd as $rows) {

            $grupo=$rows['grupo'];

            $tarjeta .= '
            <h3 class="text-dark  text-center ">
            '.$rows['nombre_es'].' <br><br>
                <button type="button" class="btn btn-dark"  data-toggle="modal" data-target="#agregarcli">
                   +
                </button> 
                
                <a href="'.SERVERURL.'enviarcorreos" name="cerrarcurso" class="btn btn-dark ">
                <i class="fa fa-envelope-o icon-sm"></i>
                </a>

                <button type="button" class="btn btn-dark dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    En línea
                </button>

                <form  class="dropdown-menu bg-danger" action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">       
                    <input type="hidden" name="codigocerrar" value="'.$rows['idespecialidad'].'">
                    <button  type="submit" name="cerrarcurso" class="dropdown-item " >
                        Cerrar Session
                    </button>
                </form> 

            </h3>
           
            
          
                
                ';

                //Descripcion del curso 
                $tarjeta .= '
               
                    <div class="row p-2">
                 
                                ';

                               //ESTADOS
                                 //SECCION ESTADOS
                                 $te=0;
                                 $estadoinicial=0;
                                 $idespecialidad=$rows['idespecialidad'];
                                 $datosInteress = $conexion->query("
                                 SELECT COUNT(*) AS totalestado FROM interes WHERE idespecialidad='$idespecialidad' AND grupo='$grupo' ");
                             $datosInteress = $datosInteress->fetchAll();
                             foreach ($datosInteress as $rowsIntd) {
                                 $te=$rowsIntd['totalestado'];
                                 
                             
                         }
                                                    
                                 $tarjeta .= '    
                      
                                  <div class="col-md-1.5 badge badge-primary" style="background-color:#A100C0;">
                                        <a href="'.SERVERURL.'sesionestadoactual/0" >    
                                             <button type="submit" name="estadoespecifico" class="btn" style="color:#424964;" >
                                                Total <br>
                                                <span font-weight-light style="font-size:35px;">'.$te.'</span>
                                            </button>
                                        </a>
                                 </div>

                                 


                              
                                 ';
                                //$estado=$rows['idestado'];
                                $to=0;
                                $datosEstado = $conexion->query("
                                SELECT * FROM estado WHERE estado_actual=1");
                                $datosEstado = $datosEstado->fetchAll();
                                foreach ($datosEstado as $rowsEstado){ 




                                        //datos de interes 
                                            $t=0;
                                            $idestado=$rowsEstado['idestado'];
                                       
                                            $idespecialidad=$rows['idespecialidad'];
                                            $datosInteres = $conexion->query("
                                            SELECT COUNT(*) AS totalestado FROM interes WHERE idespecialidad='$idespecialidad' AND idestado='$idestado' AND grupo='$grupo'");
                                        $datosInteres = $datosInteres->fetchAll();
                                        foreach ($datosInteres as $rowsInt) {
                                            $t=$rowsInt['totalestado'];
                                            
                                        if( $idestado==8){
                                            $totalpre=$t;
                                        }
                                    }

                                 
       
                                   $tarjeta .= '    
                                   <div class="col-md-1.5 badge  badge-secondary  " style="background-color:'.$rowsEstado['color'].';">
                                       <a href="'.SERVERURL.'sesionestadoactual/'.$idestado.'">    
                                           
                                           <button  class="btn" style="color:#424964" >
                                            '.$rowsEstado['nombre_estado'].' <br>
                                               <span class="font-weight-light" style="font-size:35px;color:#424964">
                                               <strong>'.$t.'</strong></span>
                                              
                                               </button>
                                       </a>
                                   </div>

                                  ';
                                }
                                $preinscritos=$te-$totalpre;
                                $tarjeta .= ' 
                                <div class="col-md-1.5 badge badge-secondary " style="background-color:#5DE87A;">
                                       <button type="submit" name="estadoespecifico" class="btn " style="color:#424964;" >
                                            Preinscritos <br>
                                            <span font-weight-light style="font-size:35px;">'.$preinscritos.'</span>
                                        </button>
                                 </div>

                </div>';
        }
        return $tarjeta;
    }

    public function busqueda_Especial_interesado()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $tarjeta = "";
        $tarjeta .= '
            <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST">       
                <label for="">Búsqueda de clientes</label><br>
                <input type="text" name="parametrobusqueda" placeholder="Dato del cliente">
                <button  type="submit" name="buscarcliente" class="dropdown-item text-danger" >
                    Buscar
                </button>
            </form>            
                ';
                       
        return $tarjeta;
    }
    public function busqueda_cliente_controlador (){

        $elemento = mainModel::limpiar_cadena($_POST['parametrobusqueda']);
        
       
        $direccion=SERVERURL."buscarcliente/".mainModel::encryption($elemento);
        header('location:'.$direccion);

    }
    public function datoscurso_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);       
       date_default_timezone_set('America/Lima');
       setlocale(LC_TIME, 'spanish');
       setlocale(LC_TIME,"es_ES");

     
        
       
       
       $tarjeta = "";
        
        $contadorestados=array();
        $conexion = mainModel::conectar();
        $usuario=$_SESSION['codigo_srcp'];
        $datosd = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");

        $datosd = $datosd->fetchAll();
        foreach ($datosd as $rows) {

            $fechaactua=$rows['fecha_inicio'];
            // $new_date=date('Ym-d', strtotime(str_replace('-','/', $fechaactua)));
            //$fechaactua=$rows['fecha_inicio'];
          
          // $new_date = date_format(date_create($fechaactua), 'Y-m-d');
            $fechaactual=date($fechaactua);


            $costototal=$rows['costo_matricula']+$rows['costo_certi'];

            $tarjeta .= '<h5 class="text-dark text-center"><strong>'.$rows['nombre_es'].'</strong>
                  
                    </h5>
                ';

                //Descripcion del curso 
                $tarjeta .= '
                <div class="row">
                    <div class="col-4 p-3">
                        <h5 class="mb-2 text-dark"><strong>HORARIO</strong></h5>
                        <p class="mb-1"><strong> Inicio : </strong> '.$fechaactual.' </p>
                        <p class="mb-2 text"> <strong>Fin : </strong>  '.$rows['fecha_fin'].'</p>
                        <p class="mb-1 text"> <strong>Duración : </strong>'.$rows['duracion_es'].'</p>
                        <p class="mb-2 text"> <strong>Horario  : </strong> '.$rows['horario'].'</p>
                    </div>
                    <div class="col-2 p-3">
                        <h5 class="mb-2 text-dark"><strong>COSTO</strong></h5>
                        <p class="mb-1 text"> <strong>Matricula :</strong> S/. '.$rows['costo_matricula'].' </p>
                        <p class="mb-2 text"> <strong>Certificado :</strong>  S/. '.$rows['costo_certi'].' </p>
                        <p class="mb-1 text"> <strong>Alternativo : </strong>S/.'.$costototal.'   </p>
                       
                    </div>
                    <div class="col-6 p-3">
                        <h5 class="mb-2 text-dark"> <strong> BENEFICIOS</strong></h5>
                        <ul class="list-ticked">
                            <li>Acceso a nuestra aula virtual las 24 horas.</li>
                            <li>Videotutoriales didácticos para que los pueda visualizar desde su celular.</li>
                            '; 
                                             
                            if($rows['modalidad']==1){
                            $tarjeta .='
                                <li>Asesoramiento constante de parte del docente vía correo y WhatsApp.</li>
                            ';}
                            $tarjeta .=' <li>';

                            if($rows['idcategoria']==1){
                                $tarjeta .='
                                Certificado  &nbsp; ';}
                                else{
                                $tarjeta .='Diploma  &nbsp;';
                                }
                            $tarjeta .='con '.$rows['horas_certificado'].' horas pedagógicas en digital autenticado mediante código QR.</li>
                            <li>Material de las clases en digital.</li>
                        </ul>
                     
                    </div>
                </div>
                ';
        }
        return $tarjeta;
    }

    public function infocurso_controlador($datosinteres)
    { 
       date_default_timezone_set('America/Lima');
       setlocale(LC_TIME, 'spanish');
       setlocale(LC_TIME,"es_ES");
       $tarjeta = "";
       $conexion = mainModel::conectar();

       $consulta3=mainModel::ejecutar_consulta_simple("
       SELECT idespecialidad FROM interes WHERE idinteres='$datosinteres'");
       $idespecialidad=($consulta3->fetchColumn(0));
               
      
        $datosd = $conexion->query("
            SELECT * FROM especialidad WHERE idespecialidad='$idespecialidad'");
        $datosd = $datosd->fetchAll();
        foreach ($datosd as $rows) {

            $fechaactua=$rows['fecha_inicio'];
            $fechaactual=date($fechaactua);


            $costototal=$rows['costo_matricula']+$rows['costo_certi'];

            $tarjeta .= '<h5 class="text-dark text-center"><strong>'.$rows['nombre_es'].'</strong>
                  
                    </h5>
                ';

                //Descripcion del curso 
                $tarjeta .= '
                <div class="row">
                    <div class="col-4 p-3">
                        <h5 class="mb-2 text-dark"><strong>HORARIO</strong></h5>
                        <p class="mb-1"><strong> Inicio : </strong> '.$fechaactual.' </p>
                        <p class="mb-2 text"> <strong>Fin : </strong>  '.$rows['fecha_fin'].'</p>
                        <p class="mb-1 text"> <strong>Duración : </strong>'.$rows['duracion_es'].'</p>
                        <p class="mb-2 text"> <strong>Horario  : </strong> '.$rows['horario'].'</p>
                    </div>
                    <div class="col-2 p-3">
                        <h5 class="mb-2 text-dark"><strong>COSTO</strong></h5>
                        <p class="mb-1 text"> <strong>Matricula :</strong> S/. '.$rows['costo_matricula'].' </p>
                        <p class="mb-2 text"> <strong>Certificado :</strong>  S/. '.$rows['costo_certi'].' </p>
                        <p class="mb-1 text"> <strong>Alternativo : </strong>S/.'.$costototal.'   </p>
                       
                    </div>
                    <div class="col-6 p-3">
                        <h5 class="mb-2 text-dark"> <strong> BENEFICIOS</strong></h5>
                        <ul class="list-ticked">
                            <li>Acceso a nuestra aula virtual las 24 horas.</li>
                            <li>Videotutoriales didácticos para que los pueda visualizar desde su celular.</li>
                            '; 
                                             
                            if($rows['modalidad']==1){
                            $tarjeta .='
                                <li>Asesoramiento constante de parte del docente vía correo y WhatsApp.</li>
                            ';}
                            $tarjeta .=' <li>';

                            if($rows['idcategoria']==1){
                                $tarjeta .='
                                Certificado  &nbsp; ';}
                                else{
                                $tarjeta .='Diploma  &nbsp;';
                                }
                            $tarjeta .='con '.$rows['horas_certificado'].' horas pedagógicas en digital autenticado mediante código QR.</li>
                            <li>Material de las clases en digital.</li>
                        </ul>
                     
                    </div>
                </div>
                ';
        }
        return $tarjeta;
    }

    public function ver_sesion_curso_controlador(){
        $tarjeta = "";
        $idesp=$_SESSION['cursover'];
        $conexion = mainModel::conectar();
        $datosd = $conexion->query("
        SELECT * FROM especialidad WHERE idespecialidad='$idesp' ");

       $datosd = $datosd->fetchAll();
       foreach ($datosd as $rows) {

        $tarjeta .= '<h3 class="text-primary">'.$rows['nombre_es'].'
               <div class="btn-group dropdown float-right">
                  
                    <div class="dropdown-menu ">
                        <form action="'.SERVERURL.'ajax/cursoAjax.php" method="POST">       
                        
                            <input type="hidden" name="codigocerrar" value="'.$rows['idespecialidad'].'">
                               <button  type="submit" name="cerrarcurso" class="dropdown-item text-danger " >
                            <i class="fa fa-reply fa-fw"></i>
                            <p class="">Cerrar Session</p>
                        </button>
                        </form> 
                    </div>
                </div>
                </h3>
            ';

            //Descripcion del curso 
            $tarjeta .= '
                <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-success mb-2">
                                Detalle del Curso/Diplomado
                            </h2>

                            <div class="row">
                                <div class="col-md-3">
                                    <address class="">
                                        <p class="font-weight-bold">
                                            Fecha
                                        </p>
                                        <p class="mb-2">
                                        '.$rows['fecha_inicio'].'
                                        </p>
                                        <p class="font-weight-bold">
                                            Duración
                                        </p>
                                        <p>
                                        '.$rows['duracion_es'].'
                                        </p>
                                    </address>
                                </div>

                                <div class="col-md-3">
                                    <address class="">
                                        <p class="font-weight-bold">
                                            Modalidad
                                        </p>
                                       
                                         '; 
                                         
                                if($rows['modalidad']==1){
                                    $tarjeta .= '<p class="mb-2">Virtual en Vivo</p>';
                                        }
                                      else  if($rows['modalidad']==2){
                                            $tarjeta .= '<p class="mb-2">Solo Accesos</p>';
                                                }else{
                                                    $tarjeta .= '<p class="mb-2">Presencial</p>';
                                          
                                                }
                                $tarjeta .= ' 
                                        <p class="font-weight-bold">
                                            Certificacion
                                        </p>
                                        <p>
                                        '.$rows['horas_certificado'].'
                                        </p>
                                    </address>
                                </div>

                                <div class="col-md-3">
                                    <address class="">
                                        <p class="font-weight-bold">
                                            Costo matricula
                                        </p>
                                        <p class="mb-2">
                                        '.$rows['costo_matricula'].'
                                        </p>
                                        <p class="font-weight-bold">
                                            Costo certificado
                                        </p>
                                        <p>
                                        '.$rows['costo_certi'].'
                                        </p>
                                    </address>
                                </div>

                                <div class="col-md-3">
                                    <address class="">
                                        <p class="font-weight-bold">
                                            Costo total
                                        </p>
                                        '; 
                                         
                                        $costototal=$rows['costo_matricula']+$rows['costo_certi'];
                                        
                                            $tarjeta .= '  <p class="mb-2">
                                           '.$costototal.'
                                        </p>';

                                               
                                        $tarjeta .= '  
                                      
                                        <p class="font-weight-bold">
                                            Costo Alternativo
                                        </p>
                                        <p>
                                            '.$rows['costo_alternativo'].'
                                        </p>
                                    </address>
                                </div>
                            </div>
                         
                            ';
                        }
        return $tarjeta;
    }

    public function tabla_interesados_estado_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $idespecialidad=0;
        $tarjeta = "";
        $conexion = mainModel::conectar();
        

        //SELECIONADO CURSO
        $usuario=$_SESSION['codigo_srcp'];

    

        $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
            $grupo=$rowsEs['grupo'];
        }
        if($_SESSION['idestado']==0){

            $direccion=SERVERURL."sesioncurso";
            header('location:'.$direccion);


            
        }
        else{
            $estadoActual=$_SESSION['idestado'];
                //SECCION INTERES
        $datosInteres = $conexion->query("
        SELECT * FROM interes WHERE
         idespecialidad='$idespecialidad'
          AND idestado=$estadoActual
           AND grupo='$grupo' ORDER by idestado ");
           
    $datosInteres = $datosInteres->fetchAll();
    foreach ($datosInteres as $rows) {
        $interes_des=$rows['descri_estado'];
        $interes_correo=$rows['envio_correo'];

    //SELECIONAR cliente
    $codigoCliente=$rows['codigocliente'];
    $datosCliente = $conexion->query("
    SELECT * FROM cliente WHERE codigocliente='$codigoCliente' ");
    $datosCliente = $datosCliente->fetchAll();
 
    foreach ($datosCliente as $rowsCliente) {
        $tarjeta .= '
                <tr>
                    <td>'.$rows['codigocliente'].'</td>
                    <td>'.$rowsCliente['nombres_cli'].'</td>
                 

                    <td class="text-danger">
                        <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST">
                            <input type="hidden" name="enlacecliente" value="'.$rows['codigocliente'].'">
                            <input type="hidden" name="idenestado" value="'.$rows['idestado'].'">
                            <input type="hidden" name="idinterescontrol" value="'.$rows['idinteres'].'">
                           
                                <button type="submit" name="vistacambioestado" class="btn btn-success  btn-sm">
                                     Atender
                                </button>
                          
                        </form>
                    </td>


                    <td>
                        <div class="btn-group dropdown float-right">';
                      
                        
                //SECCION ESTADOS
                $estado=$rows['idestado'];
                $datosEstado = $conexion->query("
                SELECT * FROM estado WHERE 	idestado='$estado' ");
                $datosEstado = $datosEstado->fetchAll();
                foreach ($datosEstado as $rowsEstado) {
                 $tarjeta .= '<button type="button"  class="btn  btn-sm  " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                             '.$rowsEstado['nombre_estado'].'
                            </button>

                            <button type="button" style="background-color:'.$rowsEstado['color'].';" class=" btn btn-inverse btn-sm" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#'.$rowsEstado['idestado'].'">
                         
                            </button>

                        ';

                }

                $tarjeta .= '     
                </div>
            </td>';
        if($interes_correo==1){
            $tarjeta .= '<td class="text-success">SI</td>';
        }
        else{
            $tarjeta .= '<td class="text-danger">NO</td>';
        }

      $tarjeta .= '        <td >'.$interes_des.'</td>
            <td>
            '.$rows['fecha_notificacion'].'
            </td>
            <td>
            '.$rows['fecha_cambio_estado'].'
            </td>
         
         </tr>';
    }}
        }
    

       
    
        return $tarjeta;
    }
    public function enviando_parametro_atencion()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $idespecialidad=0;
        $tarjeta = "";
        $conexion = mainModel::conectar();

        //SELECIONADO CURSO
        $usuario=$_SESSION['codigo_srcp'];
        $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
            $grupo=$rowsEs['grupo'];
        }

       
        //SECCION INTERES
        $datosInteres = $conexion->query("
            SELECT * FROM interes WHERE idespecialidad='$idespecialidad' AND grupo='$grupo' ORDER by idestado ");
        $datosInteres = $datosInteres->fetchAll();
        foreach ($datosInteres as $rows) {
            $interes_des=$rows['descri_estado'];
            $interes_correo=$rows['envio_correo'];

        //SELECIONAR cliente
        $codigoCliente=$rows['codigocliente'];
        $datosCliente = $conexion->query("
        SELECT * FROM cliente WHERE codigocliente='$codigoCliente' ");
        $datosCliente = $datosCliente->fetchAll();
     
        foreach ($datosCliente as $rowsCliente) {
            $tarjeta .= '
                    <tr>
                        <td>
                        '.$rows['codigocliente'].' -
                            ';
                           

                        if($interes_correo==1){
                            $tarjeta .= '<spam class="text-success">SI</span>';
                        }
                        else{
                            $tarjeta .= '<span class="text-danger">NO</span>';
                        }
    
                      $tarjeta .= '
                       
                       
                        <td>'.$rowsCliente['nombres_cli'].'</td>
                      
                      

                        <td class="text-black">
                          ';
 
                                //SECCION ESTADOS
                                $estado=$rows['idestado'];
                                $datosEstado = $conexion->query("
                                SELECT * FROM estado WHERE 	idestado='$estado' ");
                                $datosEstado = $datosEstado->fetchAll();
                                foreach ($datosEstado as $rowsEstado) {
                                $tarjeta .= 
                                '  
                                
                    
                                <a href="'.SERVERURL.'sesionestados/'.$rows['idinteres'].'" name="vistacambioestado" class="btn btn-sm" style="color:#424964">
                                <span type="text" class="p-2 text-white" style="background-color:#424964 ">
                                Atender
                              </span>
                              <span type="text" class="p-2 text-white" style="background-color:'.$rowsEstado['color'].' ">
                               
                              </span>&nbsp;&nbsp;'.$rowsEstado['nombre_estado'].'
                                </a>
                            ';

                    }

                    $tarjeta .= '     
                   
                        </td>';
                  $tarjeta .= '      
                         <td class="text-uppercase">'.$interes_des.'</td>
                        <td>
                        '.$rows['fecha_notificacion'].'
                        </td>
                        <td>
                        '.$rows['fecha_cambio_estado'].'
                        </td>
                        <td>
                        '.$rowsCliente['telefono_cli'].'
                        </td>
                        <td>
                        '.$rowsCliente['correo_cli'].'
                        </td>
                     
                     </tr>';
        }}
        return $tarjeta;
    }
    public function enviando_parametro_atencion_estado($datos)
    {
     
        $tarjeta = "";
        $usuario=$_SESSION['codigo_srcp'];
        $conexion = mainModel::conectar();
       
            
        $consulta3 = $conexion->query("SELECT 
        idespecialidad, grupo FROM especialidad WHERE sesion='$usuario'");
        $consulta3 = $consulta3->fetchAll();
        foreach ($consulta3 as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
            $grupo=$rowsEs['grupo'];
            
        }
       
        if($datos==0){
            $datosInteres = $conexion->query("
            SELECT * FROM interes WHERE idespecialidad='$idespecialidad' AND grupo='$grupo'");
            $datosInteres = $datosInteres->fetchAll();
        }else{
            $datosInteres = $conexion->query("
            SELECT * FROM interes WHERE idestado='$datos' AND idespecialidad='$idespecialidad' AND grupo='$grupo'");
            $datosInteres = $datosInteres->fetchAll();
        }
       
        foreach ($datosInteres as $rows) {
            $interes_des=$rows['descri_estado'];
            $interes_correo=$rows['envio_correo'];

        //SELECIONAR cliente
        $codigoCliente=$rows['codigocliente'];
        $datosCliente = $conexion->query("
        SELECT * FROM cliente WHERE codigocliente='$codigoCliente' ");
        $datosCliente = $datosCliente->fetchAll();
     
        foreach ($datosCliente as $rowsCliente) {
            $tarjeta .= '
                    <tr>
                        <td>
                        '.$rows['codigocliente'].' -
                            ';
                           

                        if($interes_correo==1){
                            $tarjeta .= '<spam class="text-success">SI</span>';
                        }
                        else{
                            $tarjeta .= '<span class="text-danger">NO</span>';
                        }
    
                      $tarjeta .= '
                       
                       
                        <td>'.$rowsCliente['nombres_cli'].'</td>
                      
                      

                        <td class="text-black">
                          ';
 
                                //SECCION ESTADOS
                                $estado=$rows['idestado'];
                                $datosEstado = $conexion->query("
                                SELECT * FROM estado WHERE 	idestado='$estado' ");
                                $datosEstado = $datosEstado->fetchAll();
                                foreach ($datosEstado as $rowsEstado) {
                                $tarjeta .= 
                                '  
                                
                    
                                <a href="'.SERVERURL.'sesionestados/'.$rows['idinteres'].'/'.$rows['idestado'].'" name="vistacambioestado" class="btn btn-sm" style="color:#424964">
                                <span type="text" class="p-2 text-white" style="background-color:#424964 ">
                                Atender
                              </span>
                              <span type="text" class="p-2 text-white" style="background-color:'.$rowsEstado['color'].' ">
                               
                              </span>&nbsp;&nbsp;'.$rowsEstado['nombre_estado'].'
                                </a>
                            ';

                    }

                    $tarjeta .= '     
                   
                        </td>';
                  $tarjeta .= '      
                         <td class="text-uppercase">'.$interes_des.'</td>
                        <td>
                        '.$rows['fecha_notificacion'].'
                        </td>
                        <td>
                        '.$rows['fecha_cambio_estado'].'
                        </td>
                        <td>
                        '.$rowsCliente['telefono_cli'].'
                        </td>
                        <td>
                        '.$rowsCliente['correo_cli'].'
                        </td>
                     
                     </tr>';
        }}
        return $tarjeta;
    }

    public function tabla_interesados_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $idespecialidad=0;
        $tarjeta = "";
        $conexion = mainModel::conectar();

        //SELECIONADO CURSO
        $usuario=$_SESSION['codigo_srcp'];
        $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
            $grupo=$rowsEs['grupo'];
        }

       
        //SECCION INTERES
        $datosInteres = $conexion->query("
            SELECT * FROM interes WHERE idespecialidad='$idespecialidad' AND grupo='$grupo' ORDER by idestado ");
        $datosInteres = $datosInteres->fetchAll();
        foreach ($datosInteres as $rows) {
            $interes_des=$rows['descri_estado'];
            $interes_correo=$rows['envio_correo'];

        //SELECIONAR cliente
        $codigoCliente=$rows['codigocliente'];
        $datosCliente = $conexion->query("
        SELECT * FROM cliente WHERE codigocliente='$codigoCliente' ");
        $datosCliente = $datosCliente->fetchAll();
     
        foreach ($datosCliente as $rowsCliente) {
            $tarjeta .= '
                    <tr>
                        <td>
                        '.$rows['codigocliente'].' -
                            ';
                           

                        if($interes_correo==1){
                            $tarjeta .= '<spam class="text-success">SI</span>';
                        }
                        else{
                            $tarjeta .= '<span class="text-danger">NO</span>';
                        }
    
                      $tarjeta .= '
                       
                       
                        <td>'.$rowsCliente['nombres_cli'].'</td>
                      
                      

                        <td class="text-black">
                            <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST">
                                <input type="hidden" name="enlacecliente" value="'.$rows['codigocliente'].'">
                                <input type="hidden" name="idenestado" value="'.$rows['idestado'].'">
                                <input type="hidden" name="idinterescontrol" value="'.$rows['idinteres'].'">
                                   ';
 
                                //SECCION ESTADOS
                                $estado=$rows['idestado'];
                                $datosEstado = $conexion->query("
                                SELECT * FROM estado WHERE 	idestado='$estado' ");
                                $datosEstado = $datosEstado->fetchAll();
                                foreach ($datosEstado as $rowsEstado) {
                                $tarjeta .= 
                                '  
                                
                    
                                <button type="submit" name="vistacambioestado" class="btn btn-sm" style="color:#424964">
                                <span type="text" class="p-2 text-white" style="background-color:#424964 ">
                                Atender
                              </span>
                              <span type="text" class="p-2 text-white" style="background-color:'.$rowsEstado['color'].' ">
                               
                              </span>&nbsp;&nbsp;'.$rowsEstado['nombre_estado'].'
                                </button>
                               


                            ';

                    }

                    $tarjeta .= '     
                    </form>
                        </td>';
                  $tarjeta .= '      
                         <td class="text-uppercase">'.$interes_des.'</td>
                        <td>
                        '.$rows['fecha_notificacion'].'
                        </td>
                        <td>
                        '.$rows['fecha_cambio_estado'].'
                        </td>
                        <td>
                        '.$rowsCliente['telefono_cli'].'
                        </td>
                        <td>
                        '.$rowsCliente['correo_cli'].'
                        </td>
                     
                     </tr>';
        }}
        return $tarjeta;
    }

    public function solover_tabla_interesados_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $idespecialidad=0;
        $tarjeta = "";
        $nombreusuario="";
        $conexion = mainModel::conectar();

        //SELECIONADO CURSO
        $idespe=$_SESSION['cursover'];
         
        //SECCION INTERES
        $datosInteres = $conexion->query("
            SELECT * FROM interes WHERE idespecialidad='$idespe' ORDER by idestado ");
        $datosInteres = $datosInteres->fetchAll();
        foreach ($datosInteres as $rows) {

            
            $coduser=$rows['idusuario'];
            $datosUusario = $conexion->query("
            SELECT nombre_us FROM usuario WHERE idusuario='$coduser'");
        $datosUusario = $datosUusario->fetchAll();
        foreach ($datosUusario as $rowsUsuario) {
            $nombreusuario=$rowsUsuario['nombre_us'];
        }

        //SELECIONAR cliente
        $codigoCliente=$rows['codigocliente'];
        $datosCliente = $conexion->query("
        SELECT * FROM cliente WHERE codigocliente='$codigoCliente' ");
        $datosCliente = $datosCliente->fetchAll();
     
        foreach ($datosCliente as $rowsCliente) {
            $tarjeta .= '
                    <tr>
                        <td>'.$rows['codigocliente'].'</td>
                        <td>'.$rowsCliente['nombres_cli'].' '.$rowsCliente['apellidos_cli'].'</td>
                     
                        <td>
                            <div class="btn-group dropdown float-right">';
                          
                            
                    //SECCION ESTADOS
                    $estado=$rows['idestado'];
                    $datosEstado = $conexion->query("
                    SELECT * FROM estado WHERE 	idestado='$estado' ");
                    $datosEstado = $datosEstado->fetchAll();
                    foreach ($datosEstado as $rowsEstado) {
                     $tarjeta .= '<button type="button" style="background-color:'.$rowsEstado['color'].';" class="btn  btn-sm white-text " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                 '.$rowsEstado['nombre_estado'].'
                                </button>

                               
';

                    }

                    $tarjeta .= '     
                            </div>
                        </td>
                        <td>
                        '.$rows['descri_estado'].'
                        </td>
                       
                        <td>
                        '.$rows['fecha_cambio_estado'].'
                        </td>
                        <td>
                        '.$nombreusuario.'
                        </td>
                       
                        
                     </tr>';
        }}
        return $tarjeta;
    }



    
    public function agregar_interesados_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $idespecialidad=0;
        $tarjeta = "";
        $conexion = mainModel::conectar();

        //SELECIONADO CURSO
        $usuario=$_SESSION['codigo_srcp'];
        $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' and estado_actual=0");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
            $grupo=$rowsEs['grupo'];
        }

         $tarjeta .= '
         <div class="modal fade" id="agregarcli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header bg-success">
                            <h3 class="text-light text-center">Agregar Cliente</h3>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="white-text">×</span>
                            </button>
                        </div>

                        <!--Body-->
                        <div class="modal-body">
                            <div class="form-group">
                                <p class="text-center">Verifique todos los datos ingresados antes de confirmar</p>

                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">

                                                <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <!--nombre/apellidos/correo-->

                                                            <div class="row">
                                                                <div class="col-md-3 form-group">
                                                                    <label for="exampleInputEmail1">DNI</label>
                                                                    <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$idespecialidad.'" >
                                                                    <input type="hidden" class="form-control" name="codigousuario" id="codigousuario" value="'. $usuario.'">
                                                                    <input type="hidden" class="form-control" name="grupo" id="grupo" value="'. $grupo.'">
                                                                    <input type="text" class="form-control" name="dni" id="dni" placeholder="DNI" >
                                                                </div>
                                                               
                                                                <div class="col-md-5 form-group">
                                                                    <label for="exampleInputEmail1">Fecha Nacimiento</label>
                                                                    <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento" >
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label for="exampleInputEmail1">Alumno</label>
                                                                    <select class="form-control form-control-lg" name="alumno" id="alumno">
                                                                        <option value="Nuevo">Nuevo</option>
                                                                        <option value="ExAlumno">ExAlumno</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <label for="exampleInputEmail1">Siglas</label>
                                                                    <input type="text" class="form-control" name="siglas" id="siglas" placeholder="Ing,etc">
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label for="exampleInputEmail1">Nombres</label>
                                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                                                </div>

                                                                <div class="col-md-5 form-group">
                                                                    <label for="exampleInputPassword1">Apellidos</label>
                                                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Correo</label>
                                                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo">
                                                                </div>
                                                                <div class=" col-md-6 form-group">
                                                                    <label for="exampleInputEmail1">Teléfono</label>
                                                                    <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono">
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <!--telefono/profesion/grado-->
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Profesión</label>
                                                                    <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesion">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Grado</label>
                                                                    <input type="text" class="form-control" name="grado" id="grado" placeholder="grado">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Pais</label>
                                                                    <input type="text" class="form-control" name="pais" id="pais" placeholder="pais" value="Perú">
                                                                </div>

                                                                <div class=" col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Departamento</label>
                                                                    <input type="text" class="form-control" name="departamento" id="departamento" placeholder="Departamento">
                                                                </div>
                                                                <div class=" col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Distrito</label>
                                                                    <input type="text" class="form-control" name="distrito" id="distrito" placeholder="Distrito">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1">Direccion</label>
                                                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion">
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <label for="exampleInputPassword1">Detalle</label>
                                                                    <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Direccion">
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <button type="submit" name="agregar_cliente" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
                                                            <button type="button" class=" btn btn-info" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class=""><i class="fa fa-meh-o"></i> Cancel</a></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
                   ';
        
        return $tarjeta;
    }
    public function agregar_interesados_corto_controlador()
    {
       //session_start(['name'=>'SRCP']);
       //$categoria = mainModel::limpiar_cadena($_GET['Curso']);    
        $idespecialidad=0;
        $tarjeta = "";
        $conexion = mainModel::conectar();

        //SELECIONADO CURSO
        $usuario=$_SESSION['codigo_srcp'];
        $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE sesion='$usuario' and estado_actual=0");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $idespecialidad=$rowsEs['idespecialidad'];
            $grupo=$rowsEs['grupo'];
        }

         $tarjeta .= '
         <div class="modal fade" id="agregarcli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header bg-dark text-center">
                            <h5 class="text-light text-center">Datos de cliente</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-white">×</span>
                            </button>

                            
                        </div>

                        <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <form action="'.SERVERURL.'ajax/clienteAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!--nombre/apellidos/correo-->

                                                <div class="row">
                                                                                                             
                                                       <div class="col-md-12 form-group">

                                                        <label for="exampleInputEmail1"><strong> Nombres y Apellidos</strong></label>
                                                        <input type="hidden" class="form-control" name="idespecialidad" id="idespecialidad" value="'.$idespecialidad.'" >
                                                        <input type="hidden" class="form-control" name="codigousuario" id="codigousuario" value="'. $usuario.'">
                                                        <input type="hidden" class="form-control" name="grupo" id="grupo" value="'. $grupo.'">
                                                   
                                                        <input type="text" class="form-control"  name="nombre" id="nombre" placeholder="Nombre"  required>
                                                    </div>

                                                   

                                                    <div class="col-md-6 form-group">
                                                        <label for="exampleInputPassword1"><strong>Correo</strong></label>
                                                        <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo">
                                                    </div>
                                                    <div class=" col-md-6 form-group">
                                                        <label for="exampleInputEmail1"><strong>Celular</strong></label>
                                                        <input type="number" class="form-control" name="telefono" id="telefono"  placeholder="Telefono">
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                     <label for="exampleInputPassword1"><strong>Detalle</strong></label>
                                                     <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Ciudad-Horario de llamada, etc">
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                 <button type="submit" name="agregar_cliente" class="btn btn-dark col-md-12"> Agregar</button>
                                             </div>

                                             <div class="col-md-6 form-group">
                                                <button type="button" class=" btn btn-danger col-md-12" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true" class=""> Cancel</a></span>
                                                </button>
                                             </div>
                                            </div>


                                            </div>

                                        </div>
    
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                     
                    </div>
                </div>
            </div> 
                   ';
        
        return $tarjeta;
    }

   
   
}
