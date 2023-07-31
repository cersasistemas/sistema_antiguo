<?php

if ($peticionAjax) {
  require_once('../modelos/estadisticascursoModelo.php');
} else {
  require_once('./modelos/estadisticascursoModelo.php');
}

class estadisticascursoControlador extends estadisticascursoModelo
{



  public function total_clientes_interes_controlador()
  {
    $porcentaje = 0;
    $table = "";
    $total = 0;
    $cantidadpormes = 0;

    $conexion = mainModel::conectar();

    //cantidad de clientes en total
    $datosEs = $conexion->query("
                    SELECT *  FROM especialidad  where estado_actual=0 and estado_atencion='1'");
    $datosEs = $datosEs->fetchAll();
    foreach ($datosEs as $rowsE) {
      $idespecialidadEs = $rowsE['idespecialidad'];
      $grupo = $rowsE['grupo'];

      $consulta2 = mainModel::ejecutar_consulta_simple("SELECT 
                      COUNT(*) FROM interes where idespecialidad=$idespecialidadEs and grupo=$grupo");
      $interesados = ($consulta2->fetchColumn());
      $total = $total + $interesados;
    }

    $datos = $conexion->query("
                    SELECT *  FROM especialidad  where estado_actual=0 and estado_atencion='1'");
    $datos = $datos->fetchAll();
    foreach ($datos as $rows) {
      $idespecialidad = $rows['idespecialidad'];
      $grupo = $rows['grupo'];

      $consulta3 = mainModel::ejecutar_consulta_simple("SELECT 
      COUNT(*) FROM interes where idespecialidad=$idespecialidad and grupo=$grupo");
      $interesados = ($consulta3->fetchColumn());
      $por = ($interesados * 100) / $total;


      $table .= ' 
                      <tr>
                          <td >
                          ' . $rows['fecha_inicio'] . '
                          </td>

                          <td >
                            ' . $rows['nombre_es'] . '
                          </td>
                          <td >
                          ' . $interesados . '
                        </td>';

      $color = "";
      if ($por < 10) {
        $color = '#FC606C';
      } else if ($por <= 20) {
        $color = 'yellow';
      } else if ($por > 20) {
        $color = '#44EF59';
      }
      $table .= '
                        
                        <td style="background:' .$color . '">
                          ' . number_format($por, 2, ',', ' ') . ' %
                        </td>
                        </tr>';
    }
    return $table;
  }
  public function tota_interesados()
  {
    $porcentaje = 0;
    $table = "";
    $total = 0;
    $cantidadpormes = 0;

    $conexion = mainModel::conectar();

    //cantidad de clientes en total
    $datosEs = $conexion->query("
                    SELECT *  FROM especialidad  where estado_actual=0 and estado_atencion='0'");
    $datosEs = $datosEs->fetchAll();
    foreach ($datosEs as $rowsE) {
      $idespecialidadEs = $rowsE['idespecialidad'];
      $grupo = $rowsE['grupo'];

      $consulta2 = mainModel::ejecutar_consulta_simple("SELECT 
                      COUNT(*) FROM interes where idespecialidad=$idespecialidadEs and grupo=$grupo");
      $interesados = ($consulta2->fetchColumn());
      $total = $total + $interesados;
    }

    $datos = $conexion->query("
                    SELECT *  FROM especialidad  where estado_actual=0 and estado_atencion='0'");
    $datos = $datos->fetchAll();
    foreach ($datos as $rows) {
      $idespecialidad = $rows['idespecialidad'];
      $grupo = $rows['grupo'];

      $consulta3 = mainModel::ejecutar_consulta_simple("SELECT 
      COUNT(*) FROM interes where idespecialidad=$idespecialidad and grupo=$grupo");
      $interesados = ($consulta3->fetchColumn());
      $por = ($interesados * 100) / $total;


      $table .= ' 
                      <tr>
                         

                          <td >
                            ' . $rows['nombre_es'] . '
                          </td>
                          <td >
                          ' . $interesados . '
                        </td>';

      $color = "";
      if ($por < 3) {
        $color = '#FC606C';
      } else if ($por <= 8) {
        $color = 'yellow';
      } else if ($por > 8) {
        $color = '#44EF59';
      }
      $table .= '
                        
                        <td style="background:' .$color . '">
                          ' . number_format($por, 2, ',', ' ') . ' %
                        </td>
                        </tr>';
    }
    return $table;
  }
  public function colorstatic($variable)
  { }
  public function EstadosCursoCantidad($idespecialidad,$grupo,$estado)
  { 
    $consultaReserva = mainModel::ejecutar_consulta_simple("
      SELECT COUNT(*) FROM interes WHERE idespecialidad='$idespecialidad' 
      and grupo='$grupo' and idestado='$estado'");
      $cantidadReserva = ($consultaReserva->fetchColumn());

      return $cantidadReserva;

  }
  public function reporte_general_curso()
  {
    
    $table = "";
    $conexion = mainModel::conectar();
    $cantidatotal = 0;
    $cantidadestadoMatriculados = 0;

    $datosespe = $conexion->query("
    SELECT *  FROM especialidad 
    where estado_actual=0 and estado_atencion=1");
    $datosespe = $datosespe->fetchAll();
    foreach ($datosespe as $rowsespecialidad) {
    
      $idespecialidad = $rowsespecialidad['idespecialidad'];
      $grupo=$rowsespecialidad['grupo'];
    

      $table .= '
            <tr>
              <td class="font-weight-medium">
              ' . $rowsespecialidad['fecha_inicio'] . '
              </td>
              <td class="font-weight-medium" style="width:50px">
                ' . $rowsespecialidad['nombre_es'] . '
              </td>';


      //RESERVA
      $cantidadReserva=self::EstadosCursoCantidad($idespecialidad,$grupo,4);
      $table .= '<td class="font-weight-medium">
                  ' . $cantidadReserva . '
                  </td>';
        

      //MATRICULADOS
      $cantidadestadoMatriculados=self::EstadosCursoCantidad($idespecialidad,$grupo,3);
      $table .= ' <td class="font-weight-medium">
                    ' . $cantidadestadoMatriculados . '
                    </td>';
      


      //total
      $consultaTotal = mainModel::ejecutar_consulta_simple("
      SELECT COUNT(*) FROM interes WHERE idespecialidad='$idespecialidad' 
      and grupo='$grupo'");
      $cantidatotal = ($consultaTotal->fetchColumn());
      
      //correo
      $cantidadcorreo=self::EstadosCursoCantidad($idespecialidad,$grupo,8);
    

      $preinscritos = $cantidatotal - $cantidadcorreo;
      $meta = $preinscritos / 5;

      if ($cantidadestadoMatriculados != 0) {
        $porcentajeaance = ($cantidadestadoMatriculados * 100) / $meta;
      } else {
        $porcentajeaance = 0;
      }

      //Porcentaje de preinscritos con respecto a los matriculados
      if ($cantidadestadoMatriculados != 0) {
        $preinscritosmatricu = ($cantidadestadoMatriculados * 100) / $preinscritos;
      } else {
        $preinscritosmatricu = 0;
      }


      //colores
     $table .= '
                  <td class="font-weight-medium" ';

      if ($porcentajeaance <= 60) {
        $table .= 'bgcolor="red"';
      } else if ($porcentajeaance >= 61 && $porcentajeaance <= 85) {
        $table .= 'bgcolor="#FFE633"';
      } else if ($porcentajeaance >= 86 && $porcentajeaance <= 100) {
        $table .= 'bgcolor="#09C81A"';
      } else {
        $table .= 'bgcolor="#7533FF"';
      }



      $table .= '>
                  ' . round($porcentajeaance, 2) . ' %
                  </td>
                  <td class="font-weight-medium">
                  ' . round($meta) . '
                  </td>
                  ';


      $table .= '
                  <td class="font-weight-medium">
                   ' . $preinscritos . '
                  </td>';

      $table .= '
                  <td class="font-weight-medium">
                  ' . $cantidadcorreo . '
                  </td>';

      $table .= '
                  <td class="font-weight-medium" ';

      if ($preinscritosmatricu <= 60) {
        $table .= 'bgcolor="red"';
      } else if ($preinscritosmatricu >= 61 && $preinscritosmatricu <= 85) {
        $table .= 'bgcolor="#FFE633"';
      } else if ($preinscritosmatricu >= 86 && $preinscritosmatricu <= 100) {
        $table .= 'bgcolor="#09C81A"';
      } else {
        $table .= 'bgcolor="#7533FF"';
      }


      $table .= '
                  >
                  ' . round($preinscritosmatricu, 2) . ' %
                  </td>';


      $table .= '
           
              
                 
          </tr> 
          ';
    }

    return $table;
  }

  public function reporte_general_total_cursos()
  {
    
    $table = "";

    $conexion = mainModel::conectar();
    $cantidatotal = 0;
    $cantidadestadoMatriculados = 0;

    $datosespe = $conexion->query("
    SELECT *  FROM especialidad 
    where estado_actual=0 and estado_atencion<>1");
    $datosespe = $datosespe->fetchAll();
    foreach ($datosespe as $rowsespecialidad) {
    
      $idespecialidad = $rowsespecialidad['idespecialidad'];
      $grupo=$rowsespecialidad['grupo'];
    

      $table .= '
            <tr>
              <td class="font-weight-medium">
              ' . $rowsespecialidad['fecha_inicio'] . '
              </td>

              <td class="font-weight-medium" style="width:50px">
                ' . $rowsespecialidad['nombre_es'] . '
              </td>';


      //RESERVA
      $consultaReserva = mainModel::ejecutar_consulta_simple("
      SELECT COUNT(*) FROM interes WHERE idespecialidad='$idespecialidad' 
      and grupo='$grupo' and idestado='4'");
      $cantidadReserva = ($consultaReserva->fetchColumn());
      $table .= '<td class="font-weight-medium">
                  ' . $cantidadReserva . '
                  </td>';
        
      


      //MATRICULADOS
      $consultaMa = mainModel::ejecutar_consulta_simple("
      SELECT COUNT(*) FROM interes WHERE idespecialidad='$idespecialidad' 
      and grupo='$grupo' and idestado='3'");
      $cantidadestadoMatriculados = ($consultaMa->fetchColumn());
      $table .= ' <td class="font-weight-medium">
                    ' . $cantidadestadoMatriculados . '
                    </td>';
      


      //total
      $consultaTotal = mainModel::ejecutar_consulta_simple("
      SELECT COUNT(*) FROM interes WHERE idespecialidad='$idespecialidad' 
      and grupo='$grupo'");
      $cantidatotal = ($consultaTotal->fetchColumn());
      
      //correo
      $consultaCor = mainModel::ejecutar_consulta_simple("
      SELECT COUNT(*) FROM interes WHERE idespecialidad='$idespecialidad' 
      and grupo='$grupo' and idestado='8'");
      $cantidadcorreo = ($consultaCor->fetchColumn());

      $preinscritos = $cantidatotal - $cantidadcorreo;
      $meta = $preinscritos / 5;

      if ($cantidadestadoMatriculados != 0) {
        $porcentajeaance = ($cantidadestadoMatriculados * 100) / $meta;
      } else {
        $porcentajeaance = 0;
      }

      //Porcentaje de preinscritos con respecto a los matriculados
      if ($cantidadestadoMatriculados != 0) {
        $preinscritosmatricu = ($cantidadestadoMatriculados * 100) / $preinscritos;
      } else {
        $preinscritosmatricu = 0;
      }


      //colores



      $table .= '
                  <td class="font-weight-medium" ';

      if ($porcentajeaance <= 60) {
        $table .= 'bgcolor="red"';
      } else if ($porcentajeaance >= 61 && $porcentajeaance <= 85) {
        $table .= 'bgcolor="#FFE633"';
      } else if ($porcentajeaance >= 86 && $porcentajeaance <= 100) {
        $table .= 'bgcolor="#09C81A"';
      } else {
        $table .= 'bgcolor="#7533FF"';
      }



      $table .= '>
                  ' . round($porcentajeaance, 2) . ' %
                  </td>
                  <td class="font-weight-medium">
                  ' . round($meta) . '
                  </td>
                  ';


      $table .= '
                  <td class="font-weight-medium">
                   ' . $preinscritos . '
                  </td>';

      $table .= '
                  <td class="font-weight-medium">
                  ' . $cantidadcorreo . '
                  </td>';

      $table .= '
                  <td class="font-weight-medium" ';

      if ($preinscritosmatricu <= 60) {
        $table .= 'bgcolor="red"';
      } else if ($preinscritosmatricu >= 61 && $preinscritosmatricu <= 85) {
        $table .= 'bgcolor="#FFE633"';
      } else if ($preinscritosmatricu >= 86 && $preinscritosmatricu <= 100) {
        $table .= 'bgcolor="#09C81A"';
      } else {
        $table .= 'bgcolor="#7533FF"';
      }


      $table .= '
                  >
                  ' . round($preinscritosmatricu, 2) . ' %
                  </td>';


      $table .= '
           
              
                 
          </tr> 
          ';
    }

    return $table;
  }


  public function total_estados_interes_controlador()
  {
    $prematri = 0;
    $porcentaje = 0;
    $table = "";

    $conexion = mainModel::conectar();

    //cantidad de clientes en total




    $table .= '
               <thead class="bg bg-primary text-white">
                    <tr>
                   
                        <th>
                         Curso
                        </th>
                       ';

    $datosEstado = $conexion->query("
            SELECT * FROM estado WHERE idestado <> 7 ORDER BY idestado");
    $datosEstado = $datosEstado->fetchAll();
    foreach ($datosEstado as $rowsEstado) {

      $table .= ' <th>
                                   ' . $rowsEstado['nombre_estado'] . '
                                 </th>';
    }

    //estados de cada interes

    $table .= ' 
            <th>
                Pre Inscritos
                </th>
                <th>
                Total
                </th>
                
              </tr>
            </thead>
            <tbody>';


    $idcat = 0;

    $datosespe = $conexion->query("
            SELECT *  FROM especialidad  where estado_actual=0 and estado_atencion=1");
    $datosespe = $datosespe->fetchAll();
    foreach ($datosespe as $rowsespecialidad) {
      $sumadeestados = 0;
      $idespecialidad = $rowsespecialidad['idespecialidad'];
      $grupo = $rowsespecialidad['grupo'];
      $idcat = $rowsespecialidad['idcategoria'];

      $table .= '
            <tr>
                <td class="font-weight-medium">
                ' . $rowsespecialidad['nombre_es'] . '
                </td>';
      $datosEstado = $conexion->query("
            SELECT * FROM estado  WHERE idestado <> 7  ORDER BY idestado");
      $datosEstado = $datosEstado->fetchAll();
      foreach ($datosEstado as $rowsEstado) {
        $idestado = $rowsEstado['idestado'];



        //interesados por curso

        $totalinterescurso = 0;
        $datosinteres = $conexion->query("
            SELECT COUNT(*) AS totalint FROM interes WHERE idespecialidad='$idespecialidad'  and grupo='$grupo' AND idestado=$idestado ORDER BY idestado");
        $datosinteres = $datosinteres->fetchAll();
        foreach ($datosinteres as $rowsinteres) {
          $cantidadestado = $rowsinteres['totalint'];
          if ($idestado == 8) {
            $prematri = $cantidadestado;
          }
          $sumadeestados += $cantidadestado;
          $total = $sumadeestados - $prematri;
          $prematri = 0;


          $table .= '
           
              <td class="font-weight-medium">
              ' . $cantidadestado . '
            </td>
           
          ';
        }
      }


      $table .= '
           
                <td class="font-weight-medium">
                ' . $total . '
              </td>

                <td class="bg">
                ' . $sumadeestados . '
                  </td>
                 
          </tr> 
          ';
    }

    return $table;
  }


  public function estadisticas_generales_controlador()
  {
    $tableGe = "";
    $contador = 0;
    $fecha = date("Y-m-d ");

    $conexion = mainModel::conectar();

    //cantidad de clientes en total
    $totalcursos = 0;
    $datosCur = $conexion->query("
            SELECT COUNT(*) as total FROM especialidad WHERE estado_actual=0");
    $datosCur = $datosCur->fetchAll();
    foreach ($datosCur as $datosCur) {
      $totalcursos = $datosCur['total'];
    }
    $totalcursos2 = 0;
    $datosCurso = $conexion->query("
            SELECT COUNT(*) as totalcursos FROM especialidad WHERE idcategoria='1' and estado_actual=0  ");
    $datosCurso = $datosCurso->fetchAll();
    foreach ($datosCurso as $datosCurso) {
      $totalcursos2 = $datosCurso['totalcursos'];
    }

    $totaldiplomados = 0;
    $datosDiplomados = $conexion->query("
            SELECT COUNT(*) as total FROM especialidad WHERE idcategoria='2' and estado_actual=0");
    $datosDiplomados = $datosDiplomados->fetchAll();
    foreach ($datosDiplomados as $datosDip) {
      $totaldiplomados = $datosDip['total'];
    }


    $datosCur = $conexion->query("
            SELECT COUNT(*) as total FROM especialidad WHERE estado_actual=0");
    $datosCur = $datosCur->fetchAll();
    foreach ($datosCur as $datosCur) {
      $totalcursos = $datosCur['total'];
    }

    //el capo de los cursos o dimplomados
    $variablemayor = 0;
    $nombrecurso = "";
    $nombrecursomayor = "";
    $idespecialidad = 0;
    $datosespe = $conexion->query("
            SELECT *  FROM especialidad WHERE estado_actual=0");
    $datosespe = $datosespe->fetchAll();
    foreach ($datosespe as $rowsespecialidad) {
      $idespecialidad = $rowsespecialidad['idespecialidad'];
      $nombrecurso = $rowsespecialidad['nombre_es'];

      $totalinterescurso = 0;
      $datosinteres = $conexion->query("
            SELECT COUNT(*) AS totalint FROM interes WHERE idespecialidad='$idespecialidad'");
      $datosinteres = $datosinteres->fetchAll();
      foreach ($datosinteres as $rowsinteres) {
        $totalinterescurso = $rowsinteres['totalint'];
      }

      if ($variablemayor < $totalinterescurso) {
        $variablemayor = $totalinterescurso;
        $nombrecursomayor = $nombrecurso;
      }
    }




    $contador++;
    $tableGe .= '
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                      <div class="card-body">
                        <div class="clearfix">
                          <div class="float-left">
                            <i class="fa fa-desktop text-danger icon-lg"></i>
                          </div>
                          <div class="float-right">
                            <p class="mb-0 text-right">Total de Cursos/Dip</p>
                            <div class="fluid-container">
                              <h3 class="font-weight-medium text-right mb-0">' . $totalcursos . '</h3>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                          <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Datos hasta el ' . $fecha . '
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                      <div class="card-body">
                        <div class="clearfix">
                          <div class="float-left">
                            <i class="fa fa-graduation-cap text-warning icon-lg"></i>
                          </div>
                          <div class="float-right">
                            <p class="mb-0 text-right">Diplomados</p>
                            <div class="fluid-container">
                              <h3 class="font-weight-medium text-right mb-0">' . $totaldiplomados . '</h3>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                          <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Datos hasta el ' . $fecha . '
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                      <div class="card-body">
                        <div class="clearfix">
                          <div class="float-left">
                            <i class="fa fa-book text-success icon-lg"></i>
                          </div>
                          <div class="float-right">
                            <p class="mb-0 text-right">Cursos</p>
                            <div class="fluid-container">
                              <h3 class="font-weight-medium text-right mb-0">' . $totalcursos2 . '</h3>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Datos hasta el ' . $fecha . '
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                      <div class="card-body">
                        <div class="clearfix">
                          <div class="float-left">
                            <i class="mdi mdi-account-location text-info icon-lg"></i>
                          </div>
                          <div class="float-right">
                            <p class="mb-0 text-right">Mayor interes</p>
                            <div class="fluid-container">
                              <h3 class="font-weight-medium text-right mb-0">' . $variablemayor . '</h3>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                          <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Nombre :' . $nombrecursomayor . '
                        </p>
                      </div>
                    </div>
                  </div>
                  
           ';


    return $tableGe;
  }

  public function tabla_control_usuarios()
  {

    date_default_timezone_set('America/Lima');
    setlocale(LC_TIME, 'spanish');


    $table = "";
    $idusuario = 0;
    $porcentaje = 0;
    $fecha = date("Y-m-d");
    $fechaactual = strftime(" %d de %B de %Y ");


    $conexion = mainModel::conectar();
    //contador de segundos en total
    $contadortotal = 0;
    $datostotal = $conexion->query("
          SELECT TIMESTAMPDIFF(SECOND, `fecha_inicio`,`fecha_fin`) as segundos
          FROM `controlusuario` WHERE fecha='$fecha'");
    $datostotal = $datostotal->fetchAll();
    foreach ($datostotal as $rowstotal) {


      $contadortotal = $contadortotal + $rowstotal['segundos'];
    }


    $hours = floor($contadortotal / 3600);
    $minutos = floor(($contadortotal % 3600) / 60);
    $segundos = (($contadortotal % 3600) % 60);


    $table .= ' 
          <h4 class="text-primary text-center">' . $fechaactual . '</h4>
          <h3><i class="fa fa-clock-o text-danger icon-lg"></i> ' . $hours . ' h ' . $minutos . ' m ' . $segundos . ' s </h3>
          <div class="table-responsive">
          <table class="table table-hover dataTable no-footer" id="bootstrap-data-table" role="grid" aria-describedby="bootstrap-data-table_info">
              <thead class="table-danger">
             
                <tr>
                  <th>
                   Codigo Usuario
                  </th>
                  <th>
                    Nombre Usuario
                  </th>
                  <th>
                    Interaciones
                  </th>
                  <th>
                   Tiempo
                  </th>
                  <th>
                    Porcentaje
                  </th>

                  
                 
                </tr>
              </thead>
              <tbody>
              ';

    //mostrar todos los usuarios activos

    $datosusuario = $conexion->query("
            SELECT * FROM usuario WHERE estado_us=1 AND permisos=3");
    $datosusuario = $datosusuario->fetchAll();
    foreach ($datosusuario as $rowsusuario) {

      $idusuario = $rowsusuario['idusuario'];


      //funcion contar segundos por cada usuario
      $cont = 0;
      $contadorsegundo = 0;
      $datoscontrol = $conexion->query("
              SELECT TIMESTAMPDIFF(SECOND, `fecha_inicio`,`fecha_fin`) as segundos
              FROM `controlusuario` WHERE codigousuario='$idusuario' AND 	fecha='$fecha'");
      $datoscontrol = $datoscontrol->fetchAll();
      foreach ($datoscontrol as $rowscontrol) {

        $contadorsegundo = $contadorsegundo + $rowscontrol['segundos'];
        $cont++;
      }

      $hours2 = floor($contadorsegundo / 3600);
      $minutos2 = floor(($contadorsegundo % 3600) / 60);
      $segundos2 = (($contadorsegundo % 3600) % 60);
      if ($contadortotal > 0) {
        $porcentaje = ($contadorsegundo * 100) / $contadortotal;
      }


      $table .= '
           
            <tr>
                <td class="font-weight-medium">
                  ' . $rowsusuario['codigousuario'] . '
                </td>
                <td class="font-weight-medium">
                ' . $rowsusuario['nombre_us'] . '
                </td>

                <td class="font-weight-medium">
                ' . $cont . '
                </td>
                
                <td>
                ' . $hours2 . ' h ' . $minutos2 . ' m ' . $segundos2 . ' s
                </td>
                <td>
                ' . round($porcentaje, 2) . '%
                </td>

                

                

          </tr> 
          ';
    }


    return $table;
  }

  public function tabla_semana_control_usuarios()
  {


    $table = "";
    $idusuario = 0;
    $porcentaje = 0;
    $fecha = date("Y-m-d");
    $SemanaPasada = date('Y-m-d', strtotime('-1 week')); // resta 1 semana
    $SemanaPas = date('d/m/Y', strtotime('-1 week')); // resta 1 semana
    $fech = date("d/m/Y");

    $conexion = mainModel::conectar();
    //contador de segundos en total
    $contadortotal = 0;
    $datostotal = $conexion->query("
          SELECT TIMESTAMPDIFF(SECOND, `fecha_inicio`,`fecha_fin`) as segundos
          FROM `controlusuario` WHERE fecha BETWEEN '$SemanaPasada' AND '$fecha'");
    $datostotal = $datostotal->fetchAll();
    foreach ($datostotal as $rowstotal) {

      $contadortotal = $contadortotal + $rowstotal['segundos'];
    }


    $hours = floor($contadortotal / 3600);
    $minutos = floor(($contadortotal % 3600) / 60);
    $segundos = (($contadortotal % 3600) % 60);


    $table .= ' 
          <h4 class="text-primary text-center">Desde ' . $SemanaPas . ' hasta ' . $fech . ' </h4>
          <h3><i class="fa fa-clock-o text-danger icon-lg"></i> ' . $hours . ' h ' . $minutos . ' m ' . $segundos . ' s </h3>
          <div class="table-responsive">
          <table class="table table-hover dataTable no-footer" id="bootstrap-data-table" role="grid" aria-describedby="bootstrap-data-table_info">
              <thead class="table-danger">
             
                <tr>
                  <th>
                   Codigo Usuario
                  </th>
                  <th>
                    Nombre Usuario
                  </th>
                  <th>
                    Interaciones
                  </th>
                  <th>
                   Tiempo
                  </th>
                  <th>
                    Porcentaje
                  </th>

                
                 
                </tr>
              </thead>
              <tbody>
              ';

    //mostrar todos los usuarios activos

    $datosusuario = $conexion->query("
            SELECT * FROM usuario WHERE estado_us=1 AND permisos=3");
    $datosusuario = $datosusuario->fetchAll();
    foreach ($datosusuario as $rowsusuario) {
      $idusuario = $rowsusuario['idusuario'];


      //funcion contar segundos por cada usuario
      $cont = 0;
      $contadorsegundo = 0;
      $datoscontrol = $conexion->query("
              SELECT TIMESTAMPDIFF(SECOND, `fecha_inicio`,`fecha_fin`) as segundos
              FROM `controlusuario` WHERE codigousuario='$idusuario' AND 	fecha BETWEEN '$SemanaPasada' AND '$fecha'");
      $datoscontrol = $datoscontrol->fetchAll();
      foreach ($datoscontrol as $rowscontrol) {

        $contadorsegundo = $contadorsegundo + $rowscontrol['segundos'];
        $cont++;
      }

      $hours2 = floor($contadorsegundo / 3600);
      $minutos2 = floor(($contadorsegundo % 3600) / 60);
      $segundos2 = (($contadorsegundo % 3600) % 60);
      if ($contadortotal > 0) {
        $porcentaje = ($contadorsegundo * 100) / $contadortotal;
      }


      $table .= '
           
            <tr>
                <td class="font-weight-medium">
                  ' . $rowsusuario['codigousuario'] . '
                </td>
                <td class="font-weight-medium">
                ' . $rowsusuario['nombre_us'] . '
                </td>

                <td class="font-weight-medium">
                ' . $cont . '
                </td>
                
                <td>
                ' . $hours2 . ' h ' . $minutos2 . ' m ' . $segundos2 . ' s
                </td>
                <td>
                ' . round($porcentaje, 2) . '%
                </td>

                

          </tr> 
          ';
    }


    return $table;
  }

  public function tabla_mes_control_usuarios()
  {

    // date_default_timezone_set('Europe/Madrid');

    // setlocale(LC_TIME, 'spanish');


    $table = "";
    $idusuario = 0;
    $porcentaje = 0;
    $fecha = date("Y-m-d");
    $elMesPasado = date('Y-m-d', strtotime('-1 month'));

    $fech = date("d/m/Y");
    $elMesPasad = date('d/m/Y', strtotime('-1 month'));
    // $fechaactual=strftime(" %d de %B de %Y %H:%M");


    // $fecha1=date("Y/m/d");
    // $elMesPasado1 = date('Y/m/d', strtotime('-1 month')) ;// rest // resta 1 semana

    $conexion = mainModel::conectar();
    //contador de segundos en total

    $contadortotal = 0;
    $datostotal = $conexion->query("
          SELECT TIMESTAMPDIFF(SECOND, `fecha_inicio`,`fecha_fin`) as segundos
          FROM `controlusuario` WHERE fecha BETWEEN '$elMesPasado' AND '$fecha'");
    $datostotal = $datostotal->fetchAll();
    foreach ($datostotal as $rowstotal) {

      $contadortotal = $contadortotal + $rowstotal['segundos'];
    }


    $hours = floor($contadortotal / 3600);
    $minutos = floor(($contadortotal % 3600) / 60);
    $segundos = (($contadortotal % 3600) % 60);


    $table .= '
          <h4 class="text-primary text-center">Desde ' . $elMesPasad . ' hasta ' . $fech . ' </h4>
          <h3><i class="fa fa-clock-o text-danger icon-lg"></i> ' . $hours . ' h ' . $minutos . ' m ' . $segundos . ' s </h3>
          <div class="table-responsive">
          <table class="table table-hover dataTable no-footer" id="bootstrap-data-tablee" role="grid" aria-describedby="bootstrap-data-table_info">
              <thead class="table-danger">
             
                <tr>
                  <th>
                   Codigo Usuario
                  </th>
                  <th>
                    Nombre Usuario
                  </th>
                  <th>
                    Interaciones
                  </th>
                  <th>
                   Tiempo
                  </th>
                  <th>
                    Porcentaje
                  </th>

                 
                </tr>
              </thead>
              <tbody>
              ';

    //mostrar todos los usuarios activos

    $datosusuario = $conexion->query("
            SELECT * FROM usuario WHERE estado_us=1 AND permisos=3");
    $datosusuario = $datosusuario->fetchAll();
    foreach ($datosusuario as $rowsusuario) {
      $idusuario = $rowsusuario['idusuario'];


      //funcion contar segundos por cada usuario
      $cont = 0;
      $contadorsegundo = 0;
      $datoscontrol = $conexion->query("
              SELECT TIMESTAMPDIFF(SECOND, `fecha_inicio`,`fecha_fin`) as segundos
              FROM `controlusuario` WHERE codigousuario='$idusuario' AND 	fecha BETWEEN '$elMesPasado' AND '$fecha'");
      $datoscontrol = $datoscontrol->fetchAll();
      foreach ($datoscontrol as $rowscontrol) {

        $contadorsegundo = $contadorsegundo + $rowscontrol['segundos'];
        $cont++;
      }

      $hours2 = floor($contadorsegundo / 3600);
      $minutos2 = floor(($contadorsegundo % 3600) / 60);
      $segundos2 = (($contadorsegundo % 3600) % 60);
      if ($contadortotal > 0) {
        $porcentaje = ($contadorsegundo * 100) / $contadortotal;
      }


      $table .= '
           
            <tr>
                <td class="font-weight-medium">
                  ' . $rowsusuario['codigousuario'] . '
                </td>
                <td class="font-weight-medium">
                ' . $rowsusuario['nombre_us'] . '
                </td>

                <td class="font-weight-medium">
                ' . $cont . '
                </td>
                
                <td>
                ' . $hours2 . ' h ' . $minutos2 . ' m ' . $segundos2 . ' s
                </td>
                <td>
                ' . round($porcentaje, 2) . '%
                </td>

                

          </tr> 
          ';
    }


    return $table;
  }



  public function tabla_busqueda_control_usuarios()
  {

    $fechainicio = $_POST['fechainicio_usuario'];
    $fechafin = $_POST['fechafin_usuario'];

    $table = "";
    $idusuario = 0;
    $porcentaje = 0;
    $fecha = date("Y-m-d");

    $conexion = mainModel::conectar();
    //contador de segundos en total
    $contadortotal = 0;
    $datostotal = $conexion->query("
          SELECT TIMESTAMPDIFF(SECOND, `fecha_inicio`,`fecha_fin`) as segundos
          FROM `controlusuario` WHERE fecha BETWEEN '$fechainicio' AND '$fechafin'");
    $datostotal = $datostotal->fetchAll();
    foreach ($datostotal as $rowstotal) {

      $contadortotal = $contadortotal + $rowstotal['segundos'];
    }


    $hours = floor($contadortotal / 3600);
    $minutos = floor(($contadortotal % 3600) / 60);
    $segundos = (($contadortotal % 3600) % 60);


    $table .= ' <p class="text-danger">Tiempo total de atencion al cliente entre ' . $fechainicio . ' - ' . $fechafin . ' :</p><h3><i class="fa fa-clock-o text-danger icon-lg"></i> ' . $hours . ' h ' . $minutos . ' m ' . $segundos . ' s </h3>
          <div class="table-responsive">
          <table class="table table-hover dataTable no-footer" id="bootstrap-data-table" role="grid" aria-describedby="bootstrap-data-table_info">
              <thead class="table-danger">
             
                <tr>
                  <th>
                   Codigo Usuario
                  </th>
                  <th>
                    Nombre Usuario
                  </th>
                  <th>
                    Interaciones
                  </th>
                  <th>
                   Tiempo
                  </th>
                  <th>
                    Porcentaje
                  </th>

                  <th>
                    Fecha (Hoy)
                  </th>
                 
                </tr>
              </thead>
              <tbody>
              ';

    //mostrar todos los usuarios activos

    $datosusuario = $conexion->query("
            SELECT * FROM usuario WHERE estado_us=1 AND permisos=3");
    $datosusuario = $datosusuario->fetchAll();
    foreach ($datosusuario as $rowsusuario) {
      $idusuario = $rowsusuario['idusuario'];


      //funcion contar segundos por cada usuario
      $contadorsegundo = 0;
      $datoscontrol = $conexion->query("
              SELECT TIMESTAMPDIFF(SECOND, `fecha_inicio`,`fecha_fin`) as segundos
              FROM `controlusuario` WHERE codigousuario='$idusuario' AND 	fecha BETWEEN '$fechainicio' AND '$fechafin'");
      $datoscontrol = $datoscontrol->fetchAll();
      foreach ($datoscontrol as $rowscontrol) {

        $contadorsegundo = $contadorsegundo + $rowscontrol['segundos'];
      }

      $hours2 = floor($contadorsegundo / 3600);
      $minutos2 = floor(($contadorsegundo % 3600) / 60);
      $segundos2 = (($contadorsegundo % 3600) % 60);
      if ($contadortotal > 0) {
        $porcentaje = ($contadorsegundo * 100) / $contadortotal;
      }


      $table .= '
           
            <tr>
                <td class="font-weight-medium">
                  ' . $rowsusuario['codigousuario'] . '
                </td>
                <td class="font-weight-medium">
                ' . $rowsusuario['nombre_us'] . '
                </td>

                <td class="font-weight-medium">
                ' . $rowsusuario['nombre_us'] . '
                </td>
                
                <td>
                ' . $hours2 . ' h ' . $minutos2 . ' m ' . $segundos2 . ' s
                </td>
                <td>
                ' . round($porcentaje, 2) . '%
                </td>

                <td>
                ' . $fecha . '
                </td>

                

          </tr> 
          ';
    }


    return $table;
  }
}
