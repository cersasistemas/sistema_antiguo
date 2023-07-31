<?php


if ($peticionAjax) {
    require_once('../modelos/matriculaModelo.php');
} else {
    require_once('./modelos/matriculaModelo.php');
}



class matriculaControlador extends matriculaModelo
{

    public function nuevamatricula_controlador()
    {   
        
         $siglas = mainModel::limpiar_cadena($_POST['siglas']);
         $grupo = mainModel::limpiar_cadena($_POST['grupo']);
        $nombres_cli = mainModel::limpiar_cadena($_POST['nombres_cli']);
        $apellidos_cli = mainModel::limpiar_cadena($_POST['apellidos_cli']);
        $correo_cli = mainModel::limpiar_cadena($_POST['correo_cli']);
        $telefono_cli = mainModel::limpiar_cadena($_POST['telefono_cli']);
        $dni_cli = mainModel::limpiar_cadena($_POST['dni_cli']);
        $fechanacimiento_cli = mainModel::limpiar_cadena($_POST['fechanacimiento_cli']);
        $alumno_cli = mainModel::limpiar_cadena($_POST['alumno_cli']);
        $usuario = mainModel::limpiar_cadena($_POST['usuario']);
        $idespecialidad = mainModel::limpiar_cadena($_POST['idespecialidad']);
        $pago = mainModel::limpiar_cadena($_POST['pago']);
        $descuento = mainModel::limpiar_cadena($_POST['descuento']);
        $fechapago = mainModel::limpiar_cadena($_POST['fechapago']);
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion']);
        $tipo_curso = mainModel::limpiar_cadena($_POST['tipo_curso']);

        
        $profesion_cli = mainModel::limpiar_cadena($_POST['profesion_cli']);
        $pais_cli = mainModel::limpiar_cadena($_POST['pais_cli']);
        $departamento_cli = mainModel::limpiar_cadena($_POST['departamento_cli']);


        $siglas = mb_convert_encoding(mb_convert_case($siglas, MB_CASE_TITLE), "UTF-8"); 
        $nombres_cli = mb_convert_encoding(mb_convert_case($nombres_cli, MB_CASE_TITLE), "UTF-8"); 
        $apellidos_cli = mb_convert_encoding(mb_convert_case($apellidos_cli, MB_CASE_TITLE), "UTF-8"); 
     

        $idinteres = mainModel::limpiar_cadena($_POST['idinteres']);
        $codigoAlumno="Vacio";
  
   

        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT MAX(idmatricula) FROM matricula");
        $numero = ($consulta1->fetchColumn()) + 1;
        $codigom = mainModel::generar_codigo_aleatorio("M-", 0, $numero);


        $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
        dni_al, codigoalumno FROM alumno where dni_al=$dni_cli ");
        $dni_al = $consultaAlumnoExiste->fetchColumn();


        if (empty($dni_al)) {

            $consultaAlumno = mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idalumno) FROM alumno ");
            $numeroAlumno = ($consultaAlumno->fetchColumn()) + 1;
            $codigoAlumno = mainModel::generar_codigo_aleatorio("ALUM", 0, $numeroAlumno);
            $datosAlumno = [
                "Codigo" => $codigoAlumno,    
                "Siglas" => $siglas,
                "Nombre" => $nombres_cli,
                "Apellidos" => $apellidos_cli,
                "Correo" => $correo_cli,
                "Telefono" => $telefono_cli,

                "Profesion" => $profesion_cli,
                "Grado" => "",
                "Pais" =>$pais_cli,
                "Departamento" => $departamento_cli,
                "Distrito" => "",
                "Direccion" => "",
                "Detalle" =>"",

                "Dni" => $dni_cli,
                "Fecha" => $fechanacimiento_cli,  
                "Alumno" => $alumno_cli,        
            ];

           $guardarAlumno = matriculaModelo::agregar_alumno_modelo($datosAlumno);
        } else {

            $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
            codigoalumno FROM alumno where dni_al=$dni_cli ");
            $codigo = $consultaAlumnoExiste->fetchColumn();
            $codigoAlumno = $codigo;

            $datosAlumno = [
                "Codigo" => $codigoAlumno,    
                "Siglas" => $siglas,
                "Nombre" => $nombres_cli,
                "Apellidos" => $apellidos_cli,
                "Correo" => $correo_cli,
                "Telefono" => $telefono_cli,
                "Profesion" => $profesion_cli,
                "Grado" => "",
                "Pais" =>$pais_cli,
                "Departamento" => $departamento_cli,
                "Distrito" => "",
                "Direccion" => "",
                "Detalle" =>"",

                "Dni" => $dni_cli,
                "Fecha" => $fechanacimiento_cli,  
                "Alumno" => $alumno_cli,     ];

                $ActualizarAlumno = matriculaModelo::actualizar_alumno_modelo($datosAlumno);
              
        }

        $type = $_FILES['img_up']['type'];
        $tmp_name = $_FILES['img_up']["tmp_name"];
        $name = $_FILES['img_up']["name"];
        $name = $dni_cli."-".$_FILES['img_up']["name"];
        $nuevo_path ="../vistas/images/voucher/" . $name;
        move_uploaded_file($tmp_name, $nuevo_path);
         $array = explode('.', $nuevo_path);
         $ext = end($array);
         $direccionImg=SERVERURL."vistas/images/voucher/".$name;


        $estado=0;
         $datosMatricula = [
            "CodigoM" => $codigom,
            "Baucher" => $direccionImg,
            "Tipo_curso" => $tipo_curso,
            "Grupo" => $grupo,
            "Usuario" => $usuario,
            "Idespecialidad" => $idespecialidad,
            "Pago" => $pago,
            "Fechapago" => $fechapago,
            "Descripcion" => $descripcion."/".$alumno_cli,  
            "Descuento" => $descuento,  
            "Estado" => $estado,
            "CodigoAl" => $codigoAlumno    
        ];

        $estado=3;
        $descripcion="Codigo de Matricula : ".$codigom;
        $datosInteres = [
            "Estado"=>$estado,
            "Idinteres" => $idinteres, 
            "Descripcion"=>$descripcion        
        ];

        $actualizarInteres = matriculaModelo::atualizar_interes_modelo($datosInteres);
        $guardarMatricula = matriculaModelo::agregar_matricula_modelo($datosMatricula);
        //$actualizarCliente = matriculaModelo::actualizar_cliente_modelo($datosCliente);
        $actualizarInteres = matriculaModelo::atualizar_interes_modelo($datosInteres);
       

         if ($guardarMatricula->rowCount() >= 1) {
        mail("cersaingenieros@gmail.com","Nueva Matricula","Nueva Matriciula :www.admin.cersa.org.pe");
         mail("sistemas@cersa.org.pe","Nueva Matricula","Nueva Matriciula :www.admin.cersa.org.pe");
         $direccion = SERVERURL . "sesionestadoactual/3";
         header('location:' . $direccion);
        }
        else{
             echo "error";
        }
    }
    public function nuevamatricula_admin_controlador()
    {   
        
         $siglas = mainModel::limpiar_cadena($_POST['siglas']);
         $grupo = mainModel::limpiar_cadena($_POST['grupo']);
        $nombres_cli = mainModel::limpiar_cadena($_POST['nombres_cli']);
        $apellidos_cli = mainModel::limpiar_cadena($_POST['apellidos_cli']);
        $correo_cli = mainModel::limpiar_cadena($_POST['correo_cli']);
        $telefono_cli = mainModel::limpiar_cadena($_POST['telefono_cli']);
        $dni_cli = mainModel::limpiar_cadena($_POST['dni_cli']);
        $fechanacimiento_cli = mainModel::limpiar_cadena($_POST['fechanacimiento_cli']);
        $alumno_cli = mainModel::limpiar_cadena($_POST['alumno_cli']);
        $usuario = mainModel::limpiar_cadena($_POST['usuario']);
        $idespecialidad = mainModel::limpiar_cadena($_POST['idespecialidad']);
       
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion']);
        $tipo_curso = mainModel::limpiar_cadena($_POST['tipo_curso']);


        $siglas = mb_convert_encoding(mb_convert_case($siglas, MB_CASE_TITLE), "UTF-8"); 
        $nombres_cli = mb_convert_encoding(mb_convert_case($nombres_cli, MB_CASE_TITLE), "UTF-8"); 
        $apellidos_cli = mb_convert_encoding(mb_convert_case($apellidos_cli, MB_CASE_TITLE), "UTF-8"); 
     

       
        $codigoAlumno="Vacio";
  
   

        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT MAX(idmatricula) FROM matricula");
        $numero = ($consulta1->fetchColumn()) + 1;
        $codigom = mainModel::generar_codigo_aleatorio("M-", 0, $numero);


        $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
        dni_al, codigoalumno FROM alumno where dni_al=$dni_cli ");
        $dni_al = $consultaAlumnoExiste->fetchColumn();


        if (empty($dni_al)) {

            $consultaAlumno = mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idalumno) FROM alumno ");
            $numeroAlumno = ($consultaAlumno->fetchColumn()) + 1;
            $codigoAlumno = mainModel::generar_codigo_aleatorio("ALUM", 0, $numeroAlumno);
            $datosAlumno = [
                "Codigo" => $codigoAlumno,    
                "Siglas" => $siglas,
                "Nombre" => $nombres_cli,
                "Apellidos" => $apellidos_cli,
                "Correo" => $correo_cli,
                "Telefono" => $telefono_cli,

                "Profesion" => "",
                "Grado" => "",
                "Pais" =>"",
                "Departamento" => "",
                "Distrito" => "",
                "Direccion" => "",
                "Detalle" =>"",

                "Dni" => $dni_cli,
                "Fecha" => $fechanacimiento_cli,  
                "Alumno" => $alumno_cli,        
            ];

           $guardarAlumno = matriculaModelo::agregar_alumno_modelo($datosAlumno);
        } else {

            $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
            codigoalumno FROM alumno where dni_al=$dni_cli ");
            $codigo = $consultaAlumnoExiste->fetchColumn();
            $codigoAlumno = $codigo;

            $datosAlumno = [
                "Codigo" => $codigoAlumno,    
                "Siglas" => $siglas,
                "Nombre" => $nombres_cli,
                "Apellidos" => $apellidos_cli,
                "Correo" => $correo_cli,
                "Telefono" => $telefono_cli,
                "Profesion" => "",
                "Grado" => "",
                "Pais" =>"",
                "Departamento" => "",
                "Distrito" => "",
                "Direccion" => "",
                "Detalle" =>"",

                "Dni" => $dni_cli,
                "Fecha" => $fechanacimiento_cli,  
                "Alumno" => $alumno_cli,     ];

                $ActualizarAlumno = matriculaModelo::actualizar_alumno_modelo($datosAlumno);
              
        }

     
        $estado=1;
         $datosMatricula = [
            "CodigoM" => $codigom,
          
            "Tipo_curso" => $tipo_curso,
            "Grupo" => $grupo,
            "Usuario" => $usuario,
            "Idespecialidad" => $idespecialidad,           
            "Descripcion" => $descripcion."/".$alumno_cli,          
            "Estado" => $estado,
            "CodigoAl" => $codigoAlumno    
        ];

      
        $guardarMatricula = matriculaModelo::agregar_matricula__admin_modelo($datosMatricula);
     
       

         if ($guardarMatricula->rowCount() >= 1) {
          $direccion = SERVERURL . "alumnoslistas/".$idespecialidad."/".$grupo;
         header('location:' . $direccion);
        }
        else{
             echo "error";
        }
    }
    public function horario_controlador()
    {   
        
         $fecha = mainModel::limpiar_cadena($_POST['fecha']);
         $hora_inicio = mainModel::limpiar_cadena($_POST['hora_inicio']);
        $hora_fin = mainModel::limpiar_cadena($_POST['hora_fin']);
        $curso = mainModel::limpiar_cadena($_POST['curso']);
        $grupo = mainModel::limpiar_cadena($_POST['grupo']);
      
        
        $estado=1;
         $datosMatricula = [
            "Fecha" => $fecha,          
            "Hora_inicio" => $hora_inicio,
            "Hora_fin" => $hora_fin,
            "Curso" => $curso,
            "Grupo" => $grupo,        
          
            "Estado" => $estado
           
        ];

      
        $guardarSecion = matriculaModelo::agregar_seccion($datosMatricula);
     
       

         if ($guardarSecion->rowCount() >= 1) {
          $direccion = SERVERURL . "horario/".$curso."/".$grupo;
         header('location:' . $direccion);
        }
        else{
             echo "error al insertar la seccion";
        }
    }
    public function horario_controlador_actualizado()
    {   
        
         $fecha = mainModel::limpiar_cadena($_POST['fecha']);
         $hora_inicio = mainModel::limpiar_cadena($_POST['hora_inicio']);
        $hora_fin = mainModel::limpiar_cadena($_POST['hora_fin']);
        $curso = mainModel::limpiar_cadena($_POST['curso']);
        $grupo = mainModel::limpiar_cadena($_POST['grupo']);
      
        
        $estado=1;
         $datosMatricula = [
            "Fecha" => $fecha,          
            "Hora_inicio" => $hora_inicio,
            "Hora_fin" => $hora_fin,
            "Curso" => $curso,
            "Grupo" => $grupo,        
          
            "Estado" => $estado
           
        ];

      
        $guardarSecion = matriculaModelo::agregar_seccion($datosMatricula);
     
       

         if ($guardarSecion->rowCount() >= 1) {
          $direccion = SERVERURL . "horariocontrol/".$curso."/".$grupo;
         header('location:' . $direccion);
        }
        else{
             echo "error al insertar la seccion";
        }
    }
    public function editar_sesion_horario_controlador()
    {   
        
         $idh = mainModel::limpiar_cadena($_POST['idh']); 
         $fecha = mainModel::limpiar_cadena($_POST['fecha']);
         $hora_inicio = mainModel::limpiar_cadena($_POST['hora_inicio']);
         $hora_fin = mainModel::limpiar_cadena($_POST['hora_fin']);
         $curso = mainModel::limpiar_cadena($_POST['curso']);
         $grupo = mainModel::limpiar_cadena($_POST['grupo']);
      
        
         $datosMatricula = [
            "Idh" => $idh,    
            "Fecha" => $fecha,          
            "Hora_inicio" => $hora_inicio,
            "Hora_fin" => $hora_fin  
           
        ];

      
        $guardarSecion = matriculaModelo::editar_sesion_horario_modelo($datosMatricula);
     
       

         if ($guardarSecion->rowCount() >= 1) {
          $direccion = SERVERURL . "horario/".$curso."/".$grupo;
         header('location:' . $direccion);
        }
        else{
             echo "error al editar";
        }
    }
    public function eliminar_sesion_horario_controlador()
    {   
        
         $idh = mainModel::limpiar_cadena($_POST['idh']); 
         $grupo = mainModel::limpiar_cadena($_POST['grupo']);
         $curso = mainModel::limpiar_cadena($_POST['curso']);
      
        
         $datosMatricula = [
            "Idh" => $idh,   
           
        ];

      
        $guardarSecion = matriculaModelo::eliminar_sesion_horario_modelo($datosMatricula);
     
       

         if ($guardarSecion->rowCount() >= 1) {
          $direccion = SERVERURL . "horario/".$curso."/".$grupo;
         header('location:' . $direccion);
        }
        else{
             echo "error al editar";
        }
    }
    public function activar_asistencia_controlador()
    {   
        
         $idhorario = mainModel::limpiar_cadena($_POST['idhorario']);        
        $alumno = mainModel::limpiar_cadena($_POST['alumno']); 
        $idalumno = mainModel::limpiar_cadena($_POST['idalumno']); 

        $idcurso = mainModel::limpiar_cadena($_POST['idcurso']);   
        $grupo = mainModel::limpiar_cadena($_POST['grupo']);        
        
        $estado=1;
         $datosasistencia = [
            "Idhorario" => $idhorario,          
            "Alumno" => $idalumno,           
            "Estado" => $estado
           
        ];

      
        $guardarAsistencia = matriculaModelo::activar_asistencia_modelo($datosasistencia);
     
       

         if ($guardarAsistencia->rowCount() >= 1) {
          $direccion = SERVERURL . "asistencia/". mainModel::encryption($alumno)."/".mainModel::encryption($idcurso)."/".mainModel::encryption($grupo);
         header('location:' . $direccion);
        }
        else{
             echo "error al insertar";
        }
    }
    public function activar_asistencia_controlador_2()
    {   
        
        $idhorario = mainModel::limpiar_cadena($_POST['idhorario']);        
       // $alumno = mainModel::limpiar_cadena($_POST['alumno']); 
        $idalumno = mainModel::limpiar_cadena($_POST['idalumno']); 
       $idcurso = mainModel::limpiar_cadena($_POST['idcurso']);   
       $grupo = mainModel::limpiar_cadena($_POST['grupo']);        
        
        $estado=1;
         $datosasistencia = [
            "Idhorario" => $idhorario,          
            "Alumno" => $idalumno,           
            "Estado" => $estado           
        ];

      
        $guardarAsistencia = matriculaModelo::activar_asistencia_modelo($datosasistencia);
     
       

         if ($guardarAsistencia->rowCount() >= 1) {
          $direccion = SERVERURL . "alumnoslistasmarcar/". $idcurso."/".$grupo."/".$idhorario;
         header('location:' . $direccion);
        }
        else{
             echo "error al insertar";
        }
    }
    public function nuevamatriculaGrupo_controlador()
    {   
        
        $siglas = mainModel::limpiar_cadena($_POST['siglas']);
        $nombres_cli = mainModel::limpiar_cadena($_POST['nombres_cli']);
        $apellidos_cli = mainModel::limpiar_cadena($_POST['apellidos_cli']);
        $correo_cli = mainModel::limpiar_cadena($_POST['correo_cli']);
        $telefono_cli = mainModel::limpiar_cadena($_POST['telefono_cli']);
        $dni_cli = mainModel::limpiar_cadena($_POST['dni_cli']);
        $fechanacimiento_cli = mainModel::limpiar_cadena($_POST['fechanacimiento_cli']);
        $alumno_cli = mainModel::limpiar_cadena($_POST['alumno_cli']);

        $usuario = mainModel::limpiar_cadena($_POST['usuario']);
        $pago = mainModel::limpiar_cadena($_POST['pago']);
        $descuento = mainModel::limpiar_cadena($_POST['descuento']);
        $fechapago = mainModel::limpiar_cadena($_POST['fechapago']);
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion']);
        $tipo_curso = mainModel::limpiar_cadena($_POST['tipo_curso']);
        $codigoAlumno="Vacio";

        $profesion_cli = mainModel::limpiar_cadena($_POST['profesion_cli']);
        $pais_cli = mainModel::limpiar_cadena($_POST['pais_cli']);
        $departamento_cli = mainModel::limpiar_cadena($_POST['departamento_cli']);

       
        $siglas = mb_convert_encoding(mb_convert_case($siglas, MB_CASE_TITLE), "UTF-8"); 
        $nombres_cli = mb_convert_encoding(mb_convert_case($nombres_cli, MB_CASE_TITLE), "UTF-8"); 
        $apellidos_cli = mb_convert_encoding(mb_convert_case($apellidos_cli, MB_CASE_TITLE), "UTF-8"); 
     

        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT MAX(idmatricula) FROM matricula");
        $numero = ($consulta1->fetchColumn()) + 1;
        $codigom = mainModel::generar_codigo_aleatorio("M-", 0, $numero);


        $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
        dni_al, codigoalumno FROM alumno where dni_al=$dni_cli ");
        $dni_al = $consultaAlumnoExiste->fetchColumn();


        if (empty($dni_al)) {

            $consultaAlumno = mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idalumno) FROM alumno ");
            $numeroAlumno = ($consultaAlumno->fetchColumn()) + 1;
            $codigoAlumno = mainModel::generar_codigo_aleatorio("ALUM", 0, $numeroAlumno);
            $datosAlumno = [
                "Codigo" => $codigoAlumno,    
                "Siglas" => $siglas,
                "Nombre" => $nombres_cli,
                "Apellidos" => $apellidos_cli,
                "Correo" => $correo_cli,
                "Telefono" => $telefono_cli,

                "Profesion" => $profesion_cli,
                "Grado" => "",
                "Pais" => $pais_cli,
                "Departamento" =>  $departamento_cli,
                "Distrito" => "",
                "Direccion" => "",
                "Detalle" =>"",

                "Dni" => $dni_cli,
                "Fecha" => $fechanacimiento_cli,  
                "Alumno" => $alumno_cli,    
                
                
            ];

           $guardarAlumno = matriculaModelo::agregar_alumno_modelo($datosAlumno);
            
        } else {

            $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
            codigoalumno FROM alumno where dni_al=$dni_cli ");
            $codigo = $consultaAlumnoExiste->fetchColumn();
            $codigoAlumno = $codigo;

            $datosAlumno = [
                "Codigo" => $codigoAlumno,    
                "Siglas" => $siglas,
                "Nombre" => $nombres_cli,
                "Apellidos" => $apellidos_cli,
                "Correo" => $correo_cli,
                "Telefono" => $telefono_cli,
                "Profesion" => $profesion_cli,
                "Grado" => "",
                "Pais" => $pais_cli,
                "Departamento" =>  $departamento_cli,
                "Distrito" => "",
                "Direccion" => "",
                "Detalle" =>"",

                "Dni" => $dni_cli,
                "Fecha" => $fechanacimiento_cli,  
                "Alumno" => $alumno_cli,     ];

                $ActualizarAlumno = matriculaModelo::actualizar_alumno_modelo($datosAlumno);
              
        }


      
        $cursos = $_POST['idespecialidad'];
        if(empty($cursos)) 
        {
          echo("ERROR");
        } 
        else 
        {
          $N = count($cursos);
          for($i=0; $i < $N; $i++)
          {
            $type = $_FILES['img_up']['type'];
            $tmp_name = $_FILES['img_up']["tmp_name"];
            $name = $_FILES['img_up']["name"];
            $name = $dni_cli."-".$_FILES['img_up']["name"];
            $nuevo_path ="../vistas/images/voucher/" . $name;
            move_uploaded_file($tmp_name, $nuevo_path);
             $array = explode('.', $nuevo_path);
             $ext = end($array);
             $direccionImg=SERVERURL."vistas/images/voucher/".$name;
    
    
            $estado=0;
            $grupo=0;
             $datosMatricula = [
                "CodigoM" => $codigom,
                "Baucher" => $direccionImg,
                "Tipo_curso" => $tipo_curso,
                "Usuario" => $usuario,
                "Idespecialidad" => $cursos[$i],
                "Pago" => $pago,
                "Fechapago" => $fechapago,
                "Descripcion" => $descripcion."/".$alumno_cli."/".$pais_cli,  
                "Descuento" => $descuento,  
                "Estado" => $estado,
                "CodigoAl" => $codigoAlumno ,
                "Grupo"=>$grupo   
            ];
    
            $guardarMatricula = matriculaModelo::agregar_matricula_modelo($datosMatricula);
           
          }
        }

       

         if ($guardarMatricula->rowCount() >= 1) {
            mail("sistemas@cersa.org.pe","Nueva Matricula","Enviar Notificación");
         $direccion = SERVERURL . "home";
         header('location:' . $direccion);
        }
        else{
             echo "error AL ENVIAR MATRICULA /ARMA TU PACK";
        }
    }
    public function listarcursos()
    {
        $contenedor="";

        $conexion = mainModel::conectar();
        $datos = $conexion->query("
          SELECT * FROM especialidad WHERE estado_actual=0 and 
          estado_matricula=1 ");
        $datos = $datos->fetchAll();
          foreach ($datos as $rows) {
            $contenedor .= '
            <tr>
            <td style="font-size:12px">
              
                    <label>
                        <input type="checkbox" 
                        name="idespecialidad[]" 
                        value="'.$rows['idespecialidad'].'
                        class="custom-control-input" ">
                         '.$rows['nombre_es'].'
                    </label>
                           
              </td>     
            </tr>';
          }
        return $contenedor;

    }
    public function listadeasistencia($alumno){
        $table='';
        $cursos="";
        $grupos="";
        $c=0;
        $conexion = mainModel::conectar();
        $alumno=mainModel::decryption($alumno);

        $datos = $conexion->query("
            SELECT * FROM matricula  
            WHERE codigoalumno='$alumno'
            and tipo_curso='0' ");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $cod=$rows['codigocurso'];
            $c++;

            $cursodatos = $conexion->query("
            SELECT nombre_es FROM especialidad  WHERE idespecialidad='$cod' ");
            $cursodatos = $cursodatos->fetchAll();
            foreach ($cursodatos as $rowscurso) {
                $nombrecurso=$rowscurso['nombre_es'];
            }
           
         $table.='
            
         <tr>
            <td>'.$c.'</td>
           
            <td>
                <a href="'.SERVERURL.'asistencia/'.mainModel::encryption($alumno).'/'.mainModel::encryption($rows['codigocurso']).'/'.mainModel::encryption($rows['grupo']).'" class="btn btn-success">
                    Asistencia
                </a>
            </td>
            <td>'.$nombrecurso.'</td>
         </tr>
         
         ';
 
        }
        return $table;
    }
    public function alumno_asistencia($alumno){

        $alumno=mainModel::decryption($alumno);
        $conexion = mainModel::conectar();
        $datosalumnos = $conexion->query("
        SELECT nombres_al, apellidos_al FROM alumno  WHERE codigoalumno='$alumno'");
        $datosalumnos = $datosalumnos->fetchAll();
        foreach ($datosalumnos as $rowsalumno) {
            $nombresalumno=$rowsalumno['nombres_al'].' '.$rowsalumno['apellidos_al'];
        }
        return $nombresalumno;

    }
    public function asistencia_marcar($alumno, $curso,$grupo){

        $alumno=mainModel::decryption($alumno);
        $curso=mainModel::decryption($curso);
        $grupo=mainModel::decryption($grupo);
        
        
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');
        $hoy=date("Y-m-d");
        $estado="Faltó";
        $estadoasistencia=0;
        $color='danger';
        $idalumno=0;
        $hora=date("H:i:s",time());

        $conexion = mainModel::conectar();

        $datosalumnos = $conexion->query("
            SELECT idalumno FROM alumno  WHERE codigoalumno='$alumno'");
        $datosalumnos = $datosalumnos->fetchAll();
        foreach ($datosalumnos as $rowsalumno) {
            $idalumno=$rowsalumno['idalumno'];
        }

        $table='';
   
      

        $datos = $conexion->query("
            SELECT * FROM horario  WHERE idcurso='$curso' and grupo='$grupo' order by fecha asc");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $id=$rows['id'];

            $datosasis = $conexion->query("
            SELECT * FROM asistencia  WHERE idhorario='$id' and idalumno='$idalumno'");
            $datosasis = $datosasis->fetchAll();
            foreach ($datosasis as $rowsasis) {
                if($rowsasis['estado']==1){
                    $estado="Presente";
                    $color='success';
                    $estadoasistencia=1;
                }
                else{
                    $estado="Faltó";
                    $color='danger';
                    $estadoasistencia=0;
                }
            }

           
           
         $table.='
            
         <tr>
          
           
           
           
            <td>';

            if($rows['fecha']==$hoy ){

                if($rows['hora_inicio']<=$hora &&  $rows['hora_fin']>=$hora){
                    if($estadoasistencia==1){
                        $table.= '<span class="badge badge-'.$color.' text-white" disabled >'.$estado.'</span>';
                    }else{
                    
                    $table.='
                    <form action="'.SERVERURL.'ajax/matriculaAjax.php" method="POST" class="forms-sample" autocomplete="off">
                            <input  type="hidden" class="form-control" name="idhorario" id="idhorario" value="'.$rows['id'].'" readonly="readonly">
                            <input  type="hidden" class="form-control" name="idcurso" id="idcurso" value="'.$rows['idcurso'].'" readonly="readonly">
                            <input  type="hidden" class="form-control" name="grupo" id="grupo" value="'.$rows['grupo'].'" readonly="readonly">
                            <input  type="hidden" class="form-control" name="alumno" id="alumno" value="'.$alumno.'" readonly="readonly">
                            <input type="hidden"  class="form-control" name="idalumno" id="idalumno" value="'.$idalumno.'" readonly="readonly">
                            <button type="submit" name="activar_asistencia" id="activar_asistencia" class="btn btn-success"><i class="fa fa-bolt"></i>Marcar Asistencia</button>
                        </form>  ';    
                    }
                }
                elseif($rows['hora_inicio']>$hora){
                    $table.= '<button class="btn btn-success" disabled>Pendiente</button>';
                }elseif($rows['hora_fin']<$hora){
                    $table.= '<span class="badge badge-'.$color.' text-white" disabled >'.$estado.'</span>';
                }else{
                    $table.= '<button class="btn btn-success" disabled>Pendiente</button>';
                }
            } 
            elseif($rows['fecha']<$hoy ){
                $table.= '<span class="badge badge-'.$color.' text-white" disabled >'.$estado.'</span>';
            }  
            elseif($rows['fecha']>$hoy){
                $table.= '<button class="btn btn-success" disabled>Pendiente</button>';
            }  
            
            
            $table.='
           
            </td>
            <td>'.$rows['fecha'].'</td>
            <td>'.$rows['hora_inicio'].'</td>
            <td>'.$rows['hora_fin'].'</td>
            
         </tr>
         
         ';
      
         $estadoasistencia=0;
         $estado="Faltó";
         $color='danger';
        }
        return $table;
    }
    public function asistencia_matricula()
    {

        $dni =mainModel::limpiar_cadena($_POST['dni']);
        $codigo='';
       
        $conexion = mainModel::conectar();

        $datos = $conexion->query("
            SELECT codigoalumno FROM alumno  WHERE dni_al='$dni' ");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $codigo=$rows['codigoalumno'];
 
        }
        if($codigo!=null){
        $link= SERVERURL.'asistencia/'.mainModel::encryption($codigo);
        header('location:'.$link);      
        }
        else{
            $link= SERVERURL.'asistencia';
        echo '<script type="text/javascript">
            alert("DNI NO REGISTRADO o INCORRECTO");
            window.location.href="'.$link.'"
            </script>';
         
        }
       
       // return $link;
    }
    
    public function Nombre_Curso($variable){
        $consultaCurso=mainModel::ejecutar_consulta_simple("SELECT 
        nombre_es FROM especialidad where idespecialidad='$variable'");
        $curso=($consultaCurso->fetchColumn());
        return $curso;
    }
    public function Nombre_Alumno($variable){
        $matriz=array(); 
        $matriz[0]=""; 
        $matriz[1]=""; 

        $conexion = mainModel::conectar();
        $datos = $conexion->query("
        SELECT * FROM alumno WHERE codigoalumno='$variable'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $matriz[0]=$rows['nombres_al'];
            $matriz[1]=$rows['apellidos_al'];
            $matriz[3]=$rows['dni_al'];
            $matriz[4]=$rows['siglas'];
            $matriz[5]=$rows['correo_al'];
            $matriz[6]=$rows['telefono_al'];
            $matriz[7]=$rows['fechanacimiento_al'];
        }

        return $matriz;
    }
    //devuelve el estado de la matrícula
    public function EstadoM($id){
        $buttonestado="";
        if($id==1){
            $buttonestado.='
                <button class="btn btn-outline-success btn-sm">
                    Matriculado
                </button>
            ';

        }
        elseif($id==0){
            $buttonestado.='
            <button class="btn btn-outline-warning btn-sm">
                Pendiente
            </button>
        ';
        }
        elseif($id==3){
            $buttonestado.='
            <button class="btn btn-outline-danger btn-sm">
                Rechazado
            </button>
        ';
        }
        return $buttonestado;

    }
    public function matriculashoy($dia)
    {   
        $date=date('Y-m-d');
        $date2=date('Y-m-d');

        if(date('Y-m-d')<=date('Y-m-07')){
            $date=date('Y-m-01');
            $date2=date('Y-m-07');
         }elseif(date('Y-m-d')<=date('Y-m-14')){
            $date=date('Y-m-08');
            $date2=date('Y-m-14');
         }elseif(date('Y-m-d')<=date('Y-m-21')){
            $date=date('Y-m-05');
            $date2=date('Y-m-21');
         }elseif(date('Y-m-d')<=date('Y-m-31')){
            $date=date('Y-m-22');
            $date2=date('Y-m-31');
        }
        
        $user=$_SESSION['codigo_srcp'];
        if($dia=="hoy"){
            $consulta3=mainModel::ejecutar_consulta_simple("SELECT 
            COUNT(*) FROM matricula  WHERE 
             codigousuario='$user'
            and DATE_FORMAT(`fecharegistro`,'%Y-%m-%d')=curdate()"); 
        }elseif($dia=="semana"){
            $consulta3=mainModel::ejecutar_consulta_simple("SELECT 
            COUNT(*) FROM matricula  WHERE 
             codigousuario='$user'
            and DATE_FORMAT(`fecharegistro`,'%Y-%m-%d')>='$date' and 
            DATE_FORMAT(`fecharegistro`,'%Y-%m-%d')<='$date2'"); 
        }elseif($dia=="mes"){
            $consulta3=mainModel::ejecutar_consulta_simple("SELECT 
            COUNT(*) FROM matricula  WHERE 
             codigousuario='$user'
            and DATE_FORMAT(`fecharegistro`,'%m')=MONTH(curdate())"); 
        }
       

        
        
        $numero=($consulta3->fetchColumn());

        return $numero;
      
    }
    
    public function estadomatriculas($estado)
    {
        $contenedor="";
        $cont=0;
        $user=$_SESSION['codigo_srcp'];

        $conexion = mainModel::conectar();
        $datos = $conexion->query("
          SELECT * FROM matricula WHERE 
          codigousuario='$user' and estado='$estado'
          and DATE_FORMAT(`fecharegistro`,'%m')=MONTH(curdate())
          ORDER BY idmatricula DESC");
        $datos = $datos->fetchAll();
          foreach ($datos as $rows) {
            $cont++;
              

            $curso=self::Nombre_Curso($rows['codigocurso']);
            $alumno=self::Nombre_Alumno($rows['codigoalumno']);
            $estado=self::EstadoM($rows['estado']);
            $contenedor .= '
            <tr>
            <td style="font-size:12px">
            <span class="text-white">'.$cont.'</span>
              '.$rows['codigomatricula'].'
              </td> 

              <td style="font-size:12px">
                '.$estado.'
              </td>  

              <td style="font-size:12px">
              '.$alumno[0].' '.$alumno[1].'
              </td> 
              <td style="font-size:12px">
               S/ '.$rows['pago'].'
              </td> 

              <td style="font-size:12px">
              '.$curso.'
              </td> 

              <td style="font-size:12px">
              '.$rows['fechapago'].'
              </td> 
              <td style="font-size:12px">
                <a href="'.$rows['baucher'].'" target="_blank">
                <i class="fa fa-file"></i>  Descargar
                </a>
              </td> 
              
            </tr>';
          }
        return $contenedor;

    }
    


}
