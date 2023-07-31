<?php
$codigocliente = "Sin codigo";
if ($peticionAjax) {
    require_once('../modelos/clienteModelo.php');
} else {
    require_once('./modelos/clienteModelo.php');
}

class clienteControlador extends clienteModelo
{

    public function agregar_informacion_controlador($codigos)
    {

        $cursointeres = $codigos;


        $conexion = mainModel::conectar();
        $datosEs = $conexion->query("
                SELECT fecha_fin FROM especialidad WHERE idespecialidad=$cursointeres ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $fincurso = $rowsEs['fecha_fin'];
        }


        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $apellidos = "";
        $correo = mainModel::limpiar_cadena($_POST['correo']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion']);
        $grado = mainModel::limpiar_cadena($_POST['grado']);
        $detalle = mainModel::limpiar_cadena($_POST['detalle']);
        $pais = "";
        $departamento = mainModel::limpiar_cadena($_POST['departamento']);
        $distrito = "";
        $direccion = "";
        $siglas = "";

        $dni = "";
        $fecha = "";
        $alumno = "";


        $consulta3 = mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idcliente) FROM cliente ");
        $numero = ($consulta3->fetchColumn()) + 1;
        $codigo = mainModel::generar_codigo_aleatorio("CL", 0, $numero);



        $estado = 1;

        $codigodeusuario = 1;

        $datosInteres = [
            "Estado" => $estado,
            "Usuario" => $codigodeusuario,
            "Curso" => $cursointeres, //aqui debemos pasar el parametro del curso
            "Cliente" => $codigo,
            "Fincurso" => $fincurso,
            "Descripcion" => "Cliente nuevo",
        ];
        clienteModelo::agregar_interes_modelo($datosInteres);

        $datosCliente = [
            "Codigo" => $codigo,
            "Siglas" => $siglas,
            "Nombre" => $nombre,
            "Apellidos" => $apellidos,
            "Correo" => $correo,
            "Telefono" => $telefono,
            "Profesion" => $profesion,
            "Grado" => $grado,
            "Pais" => $pais,
            "Departamento" => $departamento,
            "Distrito" => $distrito,
            "Direccion" => $direccion,

            "Dni" => $dni,
            "Fecha" => $fecha,
            "Detalle" => $detalle,
            "Fincurso" => $fincurso,
            "Alumno" => $alumno

        ];
        $guardarCliente = clienteModelo::agregar_cliente_modelo($datosCliente);

        if ($guardarCliente->rowCount() >= 1) {
            $direccion = SERVERURL . "gracias";
            header('location:' . $direccion);
        } else {
            $a = "<script>console.log( 'No insertado' );</script>";
        }


        return $a;
    }

    public function gracias()
    {
        // $table="";
        //$table.="<p>Te quiero yo y tu ami</p>";

    }

    public function agregar_informacion2_controlador()
    {

        $cursointeres = 2;


        $conexion = mainModel::conectar();
        $datosEs = $conexion->query("
                SELECT fecha_fin FROM especialidad WHERE idespecialidad=$cursointeres ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $fincurso = $rowsEs['fecha_fin'];
        }


        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $apellidos = "";
        $correo = mainModel::limpiar_cadena($_POST['correo']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion']);
        $grado = mainModel::limpiar_cadena($_POST['grado']);
        $detalle = mainModel::limpiar_cadena($_POST['detalle']);
        $pais = "";
        $departamento = mainModel::limpiar_cadena($_POST['departamento']);
        $distrito = "";
        $direccion = "";

        $dni = "";
        $fecha = "";
        $siglas = "";
        $alumno = "";


        $consulta3 = mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idcliente) FROM cliente ");
        $numero = ($consulta3->fetchColumn()) + 1;
        $codigo = mainModel::generar_codigo_aleatorio("CL", 0, $numero);



        $estado = 1;

        $codigodeusuario = 1;

        $datosInteres = [
            "Estado" => $estado,
            "Usuario" => $codigodeusuario,
            "Curso" => $cursointeres, //aqui debemos pasar el parametro del curso
            "Cliente" => $codigo,
            "Fincurso" => $fincurso,
            "Descripcion" => "Cliente nuevo",
        ];
        clienteModelo::agregar_interes_modelo($datosInteres);

        $datosCliente = [
            "Codigo" => $codigo,
            "Nombre" => $nombre,
            "Siglas" => $siglas,
            "Apellidos" => $apellidos,
            "Correo" => $correo,
            "Telefono" => $telefono,
            "Profesion" => $profesion,
            "Grado" => $grado,
            "Pais" => $pais,
            "Departamento" => $departamento,
            "Distrito" => $distrito,
            "Direccion" => $direccion,

            "Dni" => $dni,
            "Fecha" => $fecha,
            "Detalle" => $detalle,
            "Fincurso" => $fincurso,
            "Alumno" => $alumno

        ];
        $guardarCliente = clienteModelo::agregar_cliente_modelo($datosCliente);

        if ($guardarCliente->rowCount() >= 1) {

            $direccion = "https://sistema.cersa.org.pe/cursogracias";
            header('location:' . $direccion);
        } else {
            $a = "<script>console.log( 'No insertado' );</script>";
        }


        return $a;
    }


    public function agregar_cliente_controlador()
    {
        //PARA AGREGAR INTERES
        $cursointeres = $_POST['idespecialidad'];
        $codigodeusuario = $_POST['codigousuario'];

        $conexion = mainModel::conectar();
        $datosEs = $conexion->query("
                SELECT fecha_fin FROM especialidad WHERE idespecialidad=$cursointeres ");
        $datosEs = $datosEs->fetchAll();
        foreach ($datosEs as $rowsEs) {
            $fincurso = $rowsEs['fecha_fin'];
        }

        $siglas = mainModel::limpiar_cadena($_POST['siglas']);
        $grupo = mainModel::limpiar_cadena($_POST['grupo']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
        $correo = mainModel::limpiar_cadena($_POST['correo']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion']);
        $grado = mainModel::limpiar_cadena($_POST['grado']);
        $pais = mainModel::limpiar_cadena($_POST['pais']);
        $departamento = mainModel::limpiar_cadena($_POST['departamento']);
        $distrito = mainModel::limpiar_cadena($_POST['distrito']);
        $direccion = mainModel::limpiar_cadena($_POST['direccion']);

        $dni = mainModel::limpiar_cadena($_POST['dni']);
        $fecha = mainModel::limpiar_cadena($_POST['fechanacimiento']);
        $alumno = mainModel::limpiar_cadena($_POST['alumno']);
        $detalle = mainModel::limpiar_cadena($_POST['detalle']);
        $detalle.= " / Nueva Registro";

        $consulta3 = mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idcliente) FROM cliente ");
        $numero = ($consulta3->fetchColumn()) + 1;
        $codigo = mainModel::generar_codigo_aleatorio("CL", 0, $numero);





        $estado = 1;
        session_start(['name' => 'SRCP']);
        $codigodeusuario = $_SESSION['id_usuario'];

        $datosInteres = [
            "Estado" => $estado,
            "Usuario" => $codigodeusuario,
            "Curso" => $cursointeres, //aqui debemos pasar el parametro del curso
            "Cliente" => $codigo,
            "Grupo" => $grupo,
            "Fincurso" => $fincurso,
            "Descripcion" => $detalle,
        ];
        clienteModelo::agregar_interes_modelo($datosInteres);

        $datosCliente = [
            "Codigo" => $codigo,
            "Siglas" => $siglas,
            "Nombre" => $nombre,
            "Apellidos" => $apellidos,
            "Correo" => $correo,
            "Telefono" => $telefono,
            "Profesion" => $profesion,
            "Grado" => $grado,
            "Pais" => $pais,
            "Departamento" => $departamento,
            "Distrito" => $distrito,
            "Direccion" => $direccion,

            "Dni" => $dni,
            "Fecha" => $fecha,
            "Detalle" => $detalle,
            "Fincurso" => $fincurso,
            "Alumno" => $alumno

        ];
        $guardarCliente = clienteModelo::agregar_cliente_modelo($datosCliente);

        if ($guardarCliente->rowCount() >= 1) {

            $direccion = SERVERURL . "sesionestadoactual/1";
            header('location:' . $direccion);
        } else {
            $a = "<script>console.log( 'No insertado' );</script>";
        }


        return $a;
    }


    //MOSTRAR CLIENTES EN ESTADO CLIENTE 
    public function actualizar_cliente_controlador()
    {
        //PARA AGREGAR INTERES
        // $cursointeres=$_POST['idespecialidad'];
        //$codigodeusuario=$_POST['codigousuario'];

        $idcliente = mainModel::limpiar_cadena($_POST['idcliente']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
        $correo = mainModel::limpiar_cadena($_POST['correo']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion']);
        $grado = mainModel::limpiar_cadena($_POST['grado']);
        $pais = mainModel::limpiar_cadena($_POST['pais']);
        $departamento = mainModel::limpiar_cadena($_POST['departamento']);
        $distrito = mainModel::limpiar_cadena($_POST['distrito']);
        $direccion = mainModel::limpiar_cadena($_POST['direccion']);

        $dni = mainModel::limpiar_cadena($_POST['dni']);
        $fecha = mainModel::limpiar_cadena($_POST['fechanacimiento']);
        $alumno = mainModel::limpiar_cadena($_POST['alumno']);
        $detalle = mainModel::limpiar_cadena($_POST['detalle']);

        $estadocool = mainModel::limpiar_cadena($_POST['estadocool']);
        $estadofull = mainModel::limpiar_cadena($_POST['estadofull']);

        $datosClienteA = [
            "Idcliente" => $idcliente,
            "Nombre" => $nombre,
            "Apellidos" => $apellidos,
            "Correo" => $correo,
            "Telefono" => $telefono,
            "Profesion" => $profesion,
            "Grado" => $grado,
            "Pais" => $pais,
            "Departamento" => $departamento,
            "Distrito" => $distrito,
            "Direccion" => $direccion,

            "Dni" => $dni,
            "Fecha" => $fecha,
            "Detalle" => $detalle,
            "Alumno" => $alumno

        ];
        $actualizarCliente = clienteModelo::actualizar_cliente_modelo($datosClienteA);
        $direccion = SERVERURL . "sesionestados/".$estadocool."/".$estadofull;
        header('location:' . $direccion);
    }

    public function actualizar_alumno_controlador()
    {
        $idalumno = mainModel::limpiar_cadena($_POST['idalumno']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $siglas = mainModel::limpiar_cadena($_POST['siglas']);
        $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
        $correo = mainModel::limpiar_cadena($_POST['correo']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion']);
        $grado = mainModel::limpiar_cadena($_POST['grado']);
        $pais = mainModel::limpiar_cadena($_POST['pais']);
        $departamento = mainModel::limpiar_cadena($_POST['departamento']);
        $distrito = mainModel::limpiar_cadena($_POST['distrito']);
        $direccion = mainModel::limpiar_cadena($_POST['direccion']);
        $dni = mainModel::limpiar_cadena($_POST['dni']);
        $fecha = mainModel::limpiar_cadena($_POST['fechanacimiento']);
        $alumno = mainModel::limpiar_cadena($_POST['alumno']);
        $detalle = mainModel::limpiar_cadena($_POST['detalle']);

        $datosAlumnoA = [
            "Idalumno" => $idalumno,
            "Nombre" => $nombre,
            "Siglas" => $siglas,
            "Apellidos" => $apellidos,
            "Correo" => $correo,
            "Telefono" => $telefono,
            "Profesion" => $profesion,
            "Grado" => $grado,
            "Pais" => $pais,
            "Departamento" => $departamento,
            "Distrito" => $distrito,
            "Direccion" => $direccion,
            "Dni" => $dni,
            "Fecha" => $fecha,
            "Detalle" => $detalle,
            "Alumno" => $alumno

        ];
        $actualizarAlumno = clienteModelo::actualizar_alumno_modelo($datosAlumnoA);



        $direccion = "<script>javascript:history.back(-1);</script>";
        echo $direccion;
    }


    //actualizar certificado
    public function actualizar_certificado_controlador()
    {


        $iddetalle = mainModel::limpiar_cadena($_POST['iddetalle']);
        $fechainicio = mainModel::limpiar_cadena($_POST['fechainicio']);
        $fechafinal = mainModel::limpiar_cadena($_POST['fechafinal']);
        $fechaemision = mainModel::limpiar_cadena($_POST['fechaemision']);
        $horasp = mainModel::limpiar_cadena($_POST['horasp']);
        $nota = mainModel::limpiar_cadena($_POST['nota']);


        // $fechaactual=date("Y-m-d");
        //
        if ($nota >= 14 && $nota <= 20) {
            $activar_cer = 1;

            if (empty($fechaemision)) {
                $fechaactual = date("Y-m-d");
                $fechaemision = $fechaactual;
            }
        } else {
            $activar_cer = 0;
        }

        $DatosCertificado = [
            "Iddetalle" => $iddetalle,
            "Fechainicio" => $fechainicio,
            "Fechafinal" => $fechafinal,
            "Fechaemision" => $fechaemision,
            "Horasp" => $horasp,
            "Nota" => $nota,
            "Activacion" => $activar_cer

        ];
        $actualizarCertificado = clienteModelo::actualizar_certificado_modelo($DatosCertificado);
        if ($actualizarCertificado == 1) {
            $direccion = "<script>javascript:history.back(-1);</script>";
            echo $direccion;
            // header('location:'.$direccion);
        }
    }


    public function matri_cliente_controlador()
    {

        $siglas = mainModel::limpiar_cadena($_POST['siglas']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
        $correo = mainModel::limpiar_cadena($_POST['correo']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion']);
        $grado = mainModel::limpiar_cadena($_POST['grado']);
        $pais = mainModel::limpiar_cadena($_POST['pais']);
        $departamento = mainModel::limpiar_cadena($_POST['departamento']);
        $distrito = mainModel::limpiar_cadena($_POST['distrito']);
        $direccion = mainModel::limpiar_cadena($_POST['direccion']);
        $dni = mainModel::limpiar_cadena($_POST['dni']);
        $fecha = mainModel::limpiar_cadena($_POST['fechanacimiento']);
        $alumno = mainModel::limpiar_cadena($_POST['alumno']);
        $detalle = mainModel::limpiar_cadena($_POST['detalle']);
        $idcurso = mainModel::limpiar_cadena($_POST['codigocurso']);
        $codigopack = mainModel::limpiar_cadena($_POST['codigopack']);
        $codigocliente = mainModel::limpiar_cadena($_POST['codigocliente']);


        $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
                dni_al, codigoalumno FROM alumno where dni_al=$dni ");
        $dni_al = $consultaAlumnoExiste->fetchColumn();


        if (empty($dni_al)) {

            $consultaAlumno = mainModel::ejecutar_consulta_simple("SELECT 
                    MAX(idalumno) FROM alumno ");
            $numeroAlumno = ($consultaAlumno->fetchColumn()) + 1;
            $codigoAlumno = mainModel::generar_codigo_aleatorio("ALUM", 0, $numeroAlumno);
            $datosAlumno = [
                "Codigo" => $codigoAlumno,
                "Siglas" => $siglas,
                "Nombre" => $nombre,
                "Apellidos" => $apellidos,
                "Correo" => $correo,
                "Telefono" => $telefono,
                "Profesion" => $profesion,
                "Grado" => $grado,
                "Pais" => $pais,
                "Departamento" => $departamento,
                "Distrito" => $distrito,
                "Direccion" => $direccion,
                "Dni" => $dni,
                "Fecha" => $fecha,
                "Detalle" => $detalle,
                "Alumno" => $alumno

            ];

            $guardarAlumno = clienteModelo::agregar_alumno_modelo($datosAlumno);
        } else {

            $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
                    codigoalumno FROM alumno where dni_al=$dni ");
            $codigo = $consultaAlumnoExiste->fetchColumn();

            $codigoAlumno = $codigo;
        }

        if ($codigopack == "") {

            $conexion = mainModel::conectar();
            $datosEs = $conexion->query("
            SELECT * FROM especialidad WHERE idespecialidad=$idcurso and estado_matricula=1");
            $datosEs = $datosEs->fetchAll();
            foreach ($datosEs as $rowsEs) {

                $idespe = $rowsEs['idespecialidad'];
                $fecha_inicio = $rowsEs['fecha_inicio'];
                $fecha_fin = $rowsEs['fecha_fin'];
                $horas_certificado = $rowsEs['horas_certificado'];
                $certicado_ladouno = $rowsEs['certicado_ladouno'];
                $certicado_ladodos = $rowsEs['certicado_ladodos'];
            }

            $consultaDetalle = mainModel::ejecutar_consulta_simple("SELECT 
            MAX(iddetalle_certificado) FROM detalle_certificado ");
            $numeroDetalle = ($consultaDetalle->fetchColumn()) + 1 + 3425;
            $codigoDetalle = mainModel::generar_codigo_aleatorio_certificado("IC", 0, $numeroDetalle, "-ESP");


            $detalle_certificado = [
                "Codigodetalle" => $codigoDetalle,
                "Codigocliente" => $codigoAlumno,
                "Idespecialidad" => $idespe,
                "FechaInicio" => $fecha_inicio,
                "FechaFin" => $fecha_fin,
                "HorasCert" => $horas_certificado,
                "Certificadouno" => $certicado_ladouno,
                "Certificadodos" => $certicado_ladodos

            ];
            $guardarMatricula = clienteModelo::agregar_matricula_modelo($detalle_certificado);
            // $cambiarestado=clienteModelo::actualizar_interes_modelo_matri($codigocliente);

        } else {
            $conexion = mainModel::conectar();
            $datosEs = $conexion->query("
    SELECT * FROM especialidad WHERE codigo_pack='$codigopack' and estado_matricula=1");
            $datosEs = $datosEs->fetchAll();
            foreach ($datosEs as $rowsEs) {
                $idespe = $rowsEs['idespecialidad'];
                $fecha_inicio = $rowsEs['fecha_inicio'];
                $fecha_fin = $rowsEs['fecha_fin'];
                $horas_certificado = $rowsEs['horas_certificado'];
                $certicado_ladouno = $rowsEs['certicado_ladouno'];
                $certicado_ladodos = $rowsEs['certicado_ladodos'];

                $consultaDetalle = mainModel::ejecutar_consulta_simple("SELECT 
        MAX(iddetalle_certificado) FROM detalle_certificado ");
                $numeroDetalle = ($consultaDetalle->fetchColumn()) + 1 + 3425;
                $codigoDetalle2 = mainModel::generar_codigo_aleatorio_certificado("IC", 0, $numeroDetalle, "-ESP");



                $detalle_certificado = [
                    "Codigodetalle" => $codigoDetalle2,
                    "Codigocliente" => $codigoAlumno,
                    "Idespecialidad" => $idespe,
                    "FechaInicio" => $fecha_inicio,
                    "FechaFin" => $fecha_fin,
                    "HorasCert" => $horas_certificado,
                    "Certificadouno" => $certicado_ladouno,
                    "Certificadodos" => $certicado_ladodos
                ];
                $guardarMatricula = clienteModelo::agregar_matricula_modelo($detalle_certificado);
            }
        }
        $cambiarestado = clienteModelo::actualizar_interes_modelo_matri($codigocliente);
        //if($guardarAlumno->rowCount()>=1){

        $direccion = SERVERURL . "clientesprematriculados";
        header('location:' . $direccion);
        // echo "<script>alert('Alumno Matriculado');location.href='.(SERVERURL).';</script>";
        // }
        // $actualizarCliente=clienteModelo::matri_cliente_modelo($datosClienteA);
        // $direccion=SERVERURL."clientesprematriculados";
        // header('location:'.$direccion);
    }

    public function agregar_alumno_controlador() 
      {
        $idespecialidadf = mainModel::limpiar_cadena($_POST['idespecialidad']);
        $dni = mainModel::limpiar_cadena($_POST['dni']);
        $siglas = mainModel::limpiar_cadena($_POST['siglas']);
        $siglas=ucwords(strtolower($siglas));
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);       
        $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion']);


        $siglas = mb_convert_encoding(mb_convert_case($siglas, MB_CASE_TITLE), "UTF-8"); 
        $nombre = mb_convert_encoding(mb_convert_case($nombre, MB_CASE_TITLE), "UTF-8"); 
        $apellidos = mb_convert_encoding(mb_convert_case($apellidos, MB_CASE_TITLE), "UTF-8"); 
    

        $fecha = mainModel::limpiar_cadena($_POST['fechanacimiento']);
        $alumno = mainModel::limpiar_cadena($_POST['alumno']);
       

        $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
            dni_al, codigoalumno FROM alumno where dni_al=$dni ");
        $dni_al = $consultaAlumnoExiste->fetchColumn();


        if (empty($dni_al)) {

            $consultaAlumno = mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idalumno) FROM alumno ");
            $numeroAlumno = ($consultaAlumno->fetchColumn()) + 1;
            $codigoAlumno = mainModel::generar_codigo_aleatorio("ALUM", 0, $numeroAlumno);
            $datosAlumno = [
                "Codigo" => $codigoAlumno,
                "Siglas" => $siglas,
                "Nombre" => $nombre,
                "Apellidos" => $apellidos,
                "Correo" => $correo,
                "Telefono" => $telefono,
                "Profesion" => $profesion,
                "Grado" => "",
                "Pais" => "",
                "Departamento" => "",
                "Distrito" => "",
                "Direccion" => "",
                "Dni" => $dni,
                "Fecha" => $fecha,
                "Detalle" => "",
                "Alumno" => $alumno

            ];

            $guardarAlumno = clienteModelo::agregar_alumno_modelo($datosAlumno);
        } else {

            $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
                codigoalumno FROM alumno where dni_al=$dni ");
            $codigo = $consultaAlumnoExiste->fetchColumn();

            $codigoAlumno = $codigo;

            $conexion = mainModel::conectar();
            $datosNew = $conexion->query("SELECT 
            nombres_al,apellidos_al FROM alumno where dni_al=$dni ");
                    $datosNew = $datosNew->fetchAll();
                    foreach ($datosNew as $rowNew) {
                        $nombre = $rowNew['nombres_al'];
                        $apellidos = $rowNew['apellidos_al'];
                    }
    
        }



        $fecha_inicio = mainModel::limpiar_cadena($_POST['fechainicio']);
        $fecha_fin = mainModel::limpiar_cadena($_POST['fechafinal']);
        $fecha_emision = mainModel::limpiar_cadena($_POST['fechaemision']);
        $horas_certificado = mainModel::limpiar_cadena($_POST['horasp']);
        $tipo = mainModel::limpiar_cadena($_POST['tipocertificado']);
        $certicado_ladouno = mainModel::decryption($_POST['certicado_ladouno']);
        $certicado_ladodos = mainModel::decryption($_POST['certicado_ladodos']);
        $nota = mainModel::limpiar_cadena($_POST['nota']);
        $estadodetalle = 0;
        if ($nota >= 14 && $nota <= 20) {
            $estadodetalle = 1;
        }

        $consultaDetalle = mainModel::ejecutar_consulta_simple("SELECT 
        MAX(iddetalle_certificado) FROM detalle_certificado ");
        $numeroDetalle = ($consultaDetalle->fetchColumn()) + 1 + 3425;
        $codigoDetalle = mainModel::generar_codigo_aleatorio_certificado("IC", 0, $numeroDetalle, "-ESP");


        $detalle_certificado = [
            "Codigodetalle" => $codigoDetalle,
            "Codigocliente" => $codigoAlumno,
            "Idespecialidad" => $idespecialidadf,
            "FechaInicio" => $fecha_inicio,
            "FechaEmision" => $fecha_emision,
            "EstadoDetalle" => $estadodetalle,
            "FechaFin" => $fecha_fin,
            "Nota" => $nota,
            "HorasCert" => $horas_certificado,
            "Tipo" => $tipo,
            "Certificadouno" => $certicado_ladouno,
            "Certificadodos" => $certicado_ladodos
        ];
        $guardarMatricula = clienteModelo::agregar_matricula_modelo($detalle_certificado);

        $conexion = mainModel::conectar();
        $datosEs = $conexion->query("
        SELECT * FROM especialidad WHERE idespecialidad='$idespecialidadf'");
                $datosEs = $datosEs->fetchAll();
                foreach ($datosEs as $rowsEs) {
                    $nombre_es = $rowsEs['nombre_es'];
                }

                $nombre=utf8_decode($nombre);
                $apellidos=utf8_decode($apellidos);
                $nombre_es=utf8_decode($nombre_es);

     

        $direccion = "
            <script>
                
                alert('INSERTADO');
                javascript:history.back(-1);

                
            </script>";
        echo $direccion;
  
    }
    public function enviar_certificado_controlador() 
    {
     
   
      $nombre = mainModel::limpiar_cadena($_POST['nombres_al']);       
      $apellidos = mainModel::limpiar_cadena($_POST['apellidos_al']);    
      $correo = mainModel::limpiar_cadena($_POST['correo_al']);    
      $nombre_es = mainModel::limpiar_cadena($_POST['nombre_es']);    


      $nombre = mb_convert_encoding(mb_convert_case($nombre, MB_CASE_TITLE), "UTF-8"); 
      $apellidos = mb_convert_encoding(mb_convert_case($apellidos, MB_CASE_TITLE), "UTF-8"); 
  

     
        $nombre=utf8_decode($nombre);
        $apellidos=utf8_decode($apellidos);
        $nombre_es=utf8_decode($nombre_es);

      include "../PHPMailer-master/src/PHPMailer.php";
      include "../PHPMailer-master/src/SMTP.php";

      $email_user = "administracion@cersa.org.pe";
      $email_password = "InstitutoCersa2020";
      $the_subject = "📢 ¡Llegó tu Certificado Virtual  $nombre $apellidos!";
      $address_to = "$correo";
      $from_name = "Cersa";
      $phpmailer = new PHPMailer\PHPMailer\PHPMailer();

// ———- datos de la cuenta de Gmail ——————————-
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
//———————————————————————–
// $phpmailer->SMTPDebug = 1;
$phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = "smtp.gmail.com"; // GMail
$phpmailer->Port = 465;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;

$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email
$phpmailer->addBCC('administracion@cersa.org.pe');
$phpmailer->CharSet = 'UTF-8';
$phpmailer->Subject = $the_subject;	

$phpmailer->Body .=" ";

  $phpmailer->IsHTML(true);
  $phpmailer->Send();

  $enviar_correo = clienteModelo::enviar_correo_certificado();
  if ($enviar_correo == 1) {
      $direccion = "<script>javascript:history.back(-1);</script>";
      echo $direccion;
      // header('location:'.$direccion);
  }

  }
    public function agregar_alumno_taller_controlador()
    {

        $idespecialidadf = mainModel::limpiar_cadena($_POST['idespecialidad']);

        $dni = mainModel::limpiar_cadena($_POST['dni']);
        $siglas = mainModel::limpiar_cadena($_POST['siglas']);
        $siglas=ucwords(strtolower($siglas));
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
       // $nombre=ucwords(strtolower($nombre)); 
        $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
       // $apellidos=ucwords(strtolower($apellidos)); 
        $correo = mainModel::limpiar_cadena($_POST['correo']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion']);


        $siglas = mb_convert_encoding(mb_convert_case($siglas, MB_CASE_TITLE), "UTF-8"); 
        $nombre = mb_convert_encoding(mb_convert_case($nombre, MB_CASE_TITLE), "UTF-8"); 
        $apellidos = mb_convert_encoding(mb_convert_case($apellidos, MB_CASE_TITLE), "UTF-8"); 
    

        //$grado=mainModel::limpiar_cadena($_POST['grado']);
        //$pais=mainModel::limpiar_cadena($_POST['pais']);
        //$departamento=mainModel::limpiar_cadena($_POST['departamento']);
        //$distrito=mainModel::limpiar_cadena($_POST['distrito']);
        //$direccion=mainModel::limpiar_cadena($_POST['direccion']);

        $fecha = mainModel::limpiar_cadena($_POST['fechanacimiento']);
        $alumno = mainModel::limpiar_cadena($_POST['alumno']);
        //$detalle=mainModel::limpiar_cadena($_POST['detalle']);

        //$idcurso=mainModel::limpiar_cadena($_POST['codigocurso']);
        //$codigopack=mainModel::limpiar_cadena($_POST['codigopack']);
        //$codigocliente=mainModel::limpiar_cadena($_POST['codigocliente']);


        $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
            dni_al, codigoalumno FROM alumno where dni_al=$dni ");
        $dni_al = $consultaAlumnoExiste->fetchColumn();


        if (empty($dni_al)) {

            $consultaAlumno = mainModel::ejecutar_consulta_simple("SELECT 
                MAX(idalumno) FROM alumno ");
            $numeroAlumno = ($consultaAlumno->fetchColumn()) + 1;
            $codigoAlumno = mainModel::generar_codigo_aleatorio("ALUM", 0, $numeroAlumno);
            $datosAlumno = [
                "Codigo" => $codigoAlumno,
                "Siglas" => $siglas,
                "Nombre" => $nombre,
                "Apellidos" => $apellidos,
                "Correo" => $correo,
                "Telefono" => $telefono,
                "Profesion" => $profesion,
                "Grado" => "",
                "Pais" => "",
                "Departamento" => "",
                "Distrito" => "",
                "Direccion" => "",
                "Dni" => $dni,
                "Fecha" => $fecha,
                "Detalle" => "",
                "Alumno" => $alumno

            ];

            $guardarAlumno = clienteModelo::agregar_alumno_modelo($datosAlumno);
        } else {

            $consultaAlumnoExiste = mainModel::ejecutar_consulta_simple("SELECT 
                codigoalumno FROM alumno where dni_al=$dni ");
            $codigo = $consultaAlumnoExiste->fetchColumn();

            $codigoAlumno = $codigo;
        }



        $fecha_inicio = mainModel::limpiar_cadena($_POST['fechainicio']);
        $fecha_fin = mainModel::limpiar_cadena($_POST['fechainicio']);
        $fecha_emision = mainModel::limpiar_cadena($_POST['fechaemision']);
        $horas_certificado = mainModel::limpiar_cadena($_POST['horasp']);
        $certicado_ladouno = mainModel::decryption($_POST['certicado_ladouno']);
        $certicado_ladodos = mainModel::decryption($_POST['certicado_ladodos']);
        $nota = 20;
        $estadodetalle = 0;
        if ($nota >= 14 && $nota <= 20) {
            $estadodetalle = 1;
        }

        $consultaDetalle = mainModel::ejecutar_consulta_simple("SELECT 
        MAX(iddetalle_certificado) FROM detalle_certificado ");
        $numeroDetalle = ($consultaDetalle->fetchColumn()) + 1 + 3425;
        $codigoDetalle = mainModel::generar_codigo_aleatorio_certificado("IC", 0, $numeroDetalle, "-ESP");
        $tipo=4;

        $detalle_certificado = [
            "Codigodetalle" => $codigoDetalle,
            "Codigocliente" => $codigoAlumno,
            "Idespecialidad" => $idespecialidadf,
            "FechaInicio" => $fecha_inicio,
            "FechaEmision" => $fecha_emision,
            "EstadoDetalle" => $estadodetalle,
            "FechaFin" => $fecha_fin,
            "Nota" => $nota,
            "Tipo" => $tipo,
            "HorasCert" => $horas_certificado,
            "Certificadouno" => $certicado_ladouno,
            "Certificadodos" => $certicado_ladodos
        ];
        $guardarMatricula = clienteModelo::agregar_matricula_taller_modelo($detalle_certificado);
        // $cambiarestado=clienteModelo::actualizar_interes_modelo_matri($codigocliente);



        $direccion = "
            <script>
                
                alert('INSERTADO');
                javascript:history.back(-1);

                
            </script>";
        echo $direccion;
        // header('location:'.$direccion);

        // echo "<script>alert('Alumno Matriculado');location.href='.(SERVERURL).';</script>";
        // }
        // $actualizarCliente=clienteModelo::matri_cliente_modelo($datosClienteA);
        // $direccion=SERVERURL."clientesprematriculados";
        // header('location:'.$direccion);
    }

    public function enviar_matricula($datos){

        $tarjetaMatricula="";

        $usuario = $_SESSION['codigo_srcp'];

        $conexion = mainModel::conectar();

        //datos de interes
        $datosInteres = $conexion->query("
        SELECT * FROM interes WHERE idinteres='$datos'");
        $datosInteres = $datosInteres->fetchAll();
        foreach ($datosInteres as $rowsInt) {
            $idespecialidad=$rowsInt['idespecialidad'];
            $codigocliente=$rowsInt['codigocliente'];
            $grupo=$rowsInt['grupo'];
        }
        //Datos de clientes
        
        $datosClientes = $conexion->query("
        SELECT * FROM cliente WHERE codigocliente='$codigocliente'");
        $datosClientes = $datosClientes->fetchAll();
        foreach ($datosClientes as $rowClientes) {
            $idcliente=$rowClientes['idcliente'];
            $siglas=$rowClientes['siglas'];
            $nombres_cli=$rowClientes['nombres_cli'];
            $apellidos_cli=$rowClientes['apellidos_cli'];
            $correo_cli=$rowClientes['correo_cli'];
            $telefono_cli=$rowClientes['telefono_cli'];
            $dni_cli=$rowClientes['dni_cli'];
            $fechanacimiento_cli=$rowClientes['fechanacimiento_cli'];
            $alumno_cli=$rowClientes['alumno_cli'];
         
      }
     
      //Modal matricula /
     
        $tarjetaMatricula .= '
             <form class="needs-validation" novalidate enctype="multipart/form-data" method="post" action="'. SERVERURL.'ajax/matriculaAjax.php">
                <div class="form-row form-control font-weight-bold">
                    <div class="col-md-6">
                        <label for="validationCustom01">Siglas</label>
                                 <input type="hidden" value="'.$usuario.'" name="usuario">
                                 <input type="hidden" value="0" name="tipo_curso">
                                 <input type="hidden" value="'.$grupo.'" name="grupo">
                                 <input type="hidden" value="'.$datos.'" name="idinteres">
                                <input style=" border: 1px solid #1a92c6;" type="text" class="form-control" id="validationCustom01" 
                                placeholder="Ejemplo: Ing, Lic, Doc, etc. (Opcional para certificado)" 
                                value=" '.$siglas.'" name="siglas">
                                    <div class="valid-feedback">
                                        Correcto
                                    </div>
                                    <div class="invalid-feedback">
                                          Por favor ingrese correctamente
                                    </div>
                    </div>
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustom01">DNI</label>
                                            <input style=" border: 1px solid #1a92c6;" type="number" class="form-control" 
                                            id="validationCustom01" placeholder="DNI" 
                                            value=" '.$dni_cli.'" name="dni_cli" required>
                                            <div class="valid-feedback">
                                                Correcto
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor ingrese correctamente
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="validationCustom01">Nombres</label>
                                            <input style=" border: 1px solid #1a92c6;" type="text" class="form-control" id="validationCustom01"
                                             placeholder="Nombres (incluya tildes)" name="nombres_cli"
                                             value=" '.$nombres_cli.'" required>
                                            <div class="valid-feedback">
                                                Correcto
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor ingrese correctamente
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="validationCustom02">Apellidos</label>
                                            <input style=" border: 1px solid #1a92c6;" type="text" class="form-control" id="validationCustom02" 
                                            placeholder="Apellidos (incluya tildes)" 
                                            value=" '.$apellidos_cli.'" name="apellidos_cli" required>
                                            <div class="valid-feedback">
                                                Correcto
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor ingrese correctamente
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="validationCustom01">Fecha de Nacimiento</label>
                                            <input style=" border: 1px solid #1a92c6;" type="date" class="form-control" id="validationCustom01" 
                                            placeholder="Fecha Nacimiento" 
                                            value=" '.$fechanacimiento_cli.'" name="fechanacimiento_cli" required>
                                            <div class="valid-feedback">
                                                Correcto
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor ingrese correctamente
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustomUsername">Email</label>
                                            <div class="input-group">
                                                <input style=" border: 1px solid #1a92c6;" type="email" class="form-control" 
                                                id="validationCustomUsername" placeholder="Email"
                                                 aria-describedby="inputGroupPrepend" 
                                                 value=" '.$correo_cli.'" name="correo_cli" required>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustomUsername">Celular</label>
                                            <div class="input-group">
            
                                                <input style=" border: 1px solid #1a92c6;" type="number" class="form-control" 
                                                id="validationCustomUsername" placeholder="Numero de celular" 
                                                value="'.$telefono_cli.'" name="telefono_cli"
                                                 aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustomUsername">Profesion</label>
                                            <div class="input-group">
            
                                                <input style=" border: 1px solid #1a92c6;" type="text" class="form-control" 
                                                id="validationCustomUsername" placeholder="Profesión" 
                                                name="profesion_cli"
                                                aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustomUsername">Pais</label>
                                            <div class="input-group">
            
                                                <input style=" border: 1px solid #1a92c6;" type="text" class="form-control" 
                                                id="validationCustomUsername" placeholder="Pais" 
                                                name="pais_cli" 
                                                aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustomUsername">Ciudad</label>
                                            <div class="input-group">
            
                                                <input style=" border: 1px solid #1a92c6;" type="text" class="form-control" 
                                                id="validationCustomUsername" placeholder="Ciudad" 
                                                name="departamento_cli"
                                                aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-md-12  mt-2">
                                            
                                            <input style=" border: 1px solid #1a92c6;" type="hidden" class="form-control" id="validationCustom03"
                                             placeholder="Curso y Diplomado" 
                                             value="'.$idespecialidad.'" name="idespecialidad" required>
                                           
                                        </div>
            
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustom03">Tipo de alumno</label>
                                            <select style=" border: 1px solid #1a92c6;" class="custom-select " name="alumno_cli" required>
            
                                                <option value="'.$alumno_cli.'">'.$alumno_cli.'</option>
                                                <option value="Nuevo">Nuevo</option>
                                                <option value="ExAlumno">ExAlumno</option>
                                            </select>
            
                                        </div>
            
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustom03">Monto Pagado</label>
                                            <input style=" border: 1px solid #1a92c6;" type="number" min="0.00" max="10000.00" step="0.01" 
                                            class="form-control" id="validationCustom03" placeholder="En soles" 
                                            name="pago" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese correctamente
                                            </div>
                                            <div class="valid-feedback">
                                                Correcto
                                            </div>
                                        </div>
            
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustom03">Descuento</label>
                                            <input style=" border: 1px solid #1a92c6;" type="number" class="form-control" id="validationCustom03" 
                                            placeholder="%" 
                                            name="descuento" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese correctamente
                                            </div>
                                            <div class="valid-feedback">
                                                Correcto
                                            </div>
                                        </div>
                                        <div class="col-md-6  mt-2">
                                            <label for="validationCustom03">Fecha de Pago</label>
                                            <input style=" border: 1px solid #1a92c6;" type="date" class="form-control" id="validationCustom03" 
                                            placeholder="fecha de pago" 
                                            name="fechapago" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese correctamente
                                            </div>
                                            <div class="valid-feedback">
                                                Correcto
                                            </div>
                                        </div>
                                        <div class="custom-file col-md-12 mt-2 form-group">
                                                <label for="exampleFormControlFile1">Subir Voucher</label>
                                                <input style=" border: 1px solid #1a92c6;" type="file" name="img_up" class="form-control-file 
                                                col-md-12" id="validationCustom03"
                                                required>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                            </div>
            
            
                                        <div class="col-md-12 mt-4">
                                            <label for="validationCustom03">Descripción</label>
                                            <textarea style=" border: 1px solid #1a92c6;" type="text" class="form-control" id="validationCustom03" 
                                            placeholder="Información adicional" 
                                            name="descripcion" rows="10" cols="30"></textarea>
                                            <div class="invalid-feedback">
                                                Por favor ingrese correctamente
                                            </div>
                                            <div class="valid-feedback">
                                                Correcto
                                            </div>
                                        </div>
            
                                        <div class="col-md-6 mt-4">
                                            <button class="btn btn-dark col-md-12" value="enviarMatricula" name="enviarMatricula" type="submit">Enviar Matrícula</button>
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <button type="button" class="btn btn-danger col-md-12" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
             </form>
            
            ';
            return $tarjetaMatricula;
         }
         public function nueva_matricula($datos_uno, $datos_dos){

            $tarjetaMatricula="";
            $grup=$datos_dos;
            $curso=$datos_uno;

           
    
            $usuario = $_SESSION['codigo_srcp'];
    
            $conexion = mainModel::conectar();
    
         
         
          //Modal matricula /
         
            $tarjetaMatricula .= '
                 <form class="needs-validation" novalidate enctype="multipart/form-data" method="post" action="'. SERVERURL.'ajax/matriculaAjax.php">
                    <div class="form-row form-control font-weight-bold">
                        <div class="col-md-12 ">
                            <label for="validationCustom01">Siglas</label>
                                     <input type="hidden" value="'.$usuario.'" name="usuario">
                                     <input type="hidden" value="0" name="tipo_curso">
                                     <input  type="hidden" value="'.$grup.'" name="grupo">
                                  
                                    <input type="text" class="form-control" id="validationCustom01" 
                                    placeholder="Ejemplo: Ing, Lic, Doc, etc. (Opcional para certificado)" 
                                    name="siglas">
                                        <div class="valid-feedback">
                                            Correcto
                                        </div>
                                        <div class="invalid-feedback">
                                              Por favor ingrese correctamente
                                        </div>
                        </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="validationCustom01">Nombres</label>
                                                <input type="text" class="form-control" id="validationCustom01"
                                                 placeholder="Nombres (incluya tildes)" name="nombres_cli"
                                                 required>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="validationCustom02">Apellidos</label>
                                                <input type="text" class="form-control" id="validationCustom02" 
                                                placeholder="Apellidos (incluya tildes)" 
                                                name="apellidos_cli" required>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="validationCustom01">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="validationCustom01" 
                                                placeholder="Fecha Nacimiento" 
                                                name="fechanacimiento_cli" required>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                            </div>
                                            <div class="col-md-6  mt-2">
                                                <label for="validationCustom01">DNI</label>
                                                <input type="number" class="form-control" 
                                                id="validationCustom01" placeholder="DNI" 
                                                 name="dni_cli" required>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                            </div>
                                            <div class="col-md-6  mt-2">
                                                <label for="validationCustomUsername">Email</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" 
                                                    id="validationCustomUsername" placeholder="Email"
                                                     aria-describedby="inputGroupPrepend" 
                                                     name="correo_cli" required>
                                                    <div class="invalid-feedback">
                                                        Por favor ingrese correctamente
                                                    </div>
                                                    <div class="valid-feedback">
                                                        Correcto
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6  mt-2">
                                                <label for="validationCustomUsername">Celular</label>
                                                <div class="input-group">
                
                                                    <input type="number" class="form-control" 
                                                    id="validationCustomUsername" placeholder="Numero de celular" 
                                                     name="telefono_cli"
                                                     aria-describedby="inputGroupPrepend" required>
                                                    <div class="invalid-feedback">
                                                        Por favor ingrese correctamente
                                                    </div>
                                                    <div class="valid-feedback">
                                                        Correcto
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-md-12  mt-2">
                                                
                                                <input type="hidden" class="form-control" id="validationCustom03"
                                                 placeholder="Curso y Diplomado" 
                                                 value="'.$curso.'" name="idespecialidad" required>
                                               
                                            </div>
                
                                            <div class="col-md-6  mt-2">
                                                <label for="validationCustom03">Tipo de alumno</label>
                                                <select class="custom-select " name="alumno_cli" required>
                
                                                   
                                                    <option value="Nuevo">Nuevo</option>
                                                    <option value="ExAlumno">ExAlumno</option>
                                                </select>
                
                                            </div>             
                                         
                
                                            <div class="col-md-12 mt-4">
                                                <label for="validationCustom03">Descripción</label>
                                                <textarea type="text" class="form-control" id="validationCustom03" 
                                                placeholder="Información adicional" 
                                                name="descripcion" rows="10" cols="30"></textarea>
                                                <div class="invalid-feedback">
                                                    Por favor ingrese correctamente
                                                </div>
                                                <div class="valid-feedback">
                                                    Correcto
                                                </div>
                                            </div>
                
                                            <div class="col-md-6 mt-4">
                                                <button class="btn btn-dark col-md-12" value="enviarMatricula" name="enviarMatricula_admin" type="submit">Enviar Matrícula</button>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <button type="button" class="btn btn-danger col-md-12" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                 </form>
                
                ';
                return $tarjetaMatricula;
             }

          public function actualizacion_estado_cliente($datosinteres,$estadofull)
                {
                //
               
                $tarjetaEstado = "";
                $estadocool=$datosinteres;
              
                $conexion = mainModel::conectar();

                //variables de interes
                $idinteres = "";
                $descriestado = "";
                $fechacambio = "";
                //SELECIONADO CURSO
                $usuario = $_SESSION['codigo_srcp'];
                //$usuario=$_SESSION['codigo_srcp'];
               
                $consulta3=mainModel::ejecutar_consulta_simple("
                 SELECT codigocliente  FROM interes WHERE idinteres='$datosinteres'");
                $cododigo=($consulta3->fetchColumn());
               

                //datos de interes que serviran par ala inseriocn 
                $datosInteres = $conexion->query("
                SELECT * FROM interes WHERE idinteres='$datosinteres'");
                $datosInteres = $datosInteres->fetchAll();
                foreach ($datosInteres as $rowsInt) {
                    $descriestado = $rowsInt['descri_estado'];
                    $fechacambio = $rowsInt['fecha_cambio_estado'];
                    $fechanotifi = $rowsInt['fecha_notificacion'];
                    $idinteres = $rowsInt['idinteres'];
                    $idespecialidad=$rowsInt['idespecialidad'];
                    $idestado=$rowsInt['idestado'];
                
                }

              

                //selecionando cliente
                $datosCliente = $conexion->query("
                SELECT * FROM cliente WHERE codigocliente='$cododigo'");
                $datosCliente = $datosCliente->fetchAll();

                foreach ($datosCliente as $rows) {
                    $tarjetaEstado .= '
                    <h5 class="text-dark text-center"><strong>Nombre : ' . $rows['nombres_cli'] . ' ' . $rows['apellidos_cli'] . '</strong>
                    
                    <div class="btn-group dropdown float-right">
                                <button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#' . $rows['codigocliente'] . '">
                                Editar Cliente
                                </button>
                    </div>
                    </h5>
                    
                <p class=""><u><strong>Datos del Estado Actual</strong></u></p>
                        <div class="row">
                            ';


                    //DATOS DEL ESTADO 
                    
                    $datosEstado = $conexion->query("
                    SELECT * FROM estado WHERE 	idestado='$idestado' ");
                    $datosEstado = $datosEstado->fetchAll();
                    foreach ($datosEstado as $rowsEstado) {
                        $tarjetaEstado .= '
                                
                            <div class="col-md-6">
                            <address class="text-dark">
                                <p class="font-weight-bold">
                                <i class="menu-icon  fa fa-cubes"></i> Estado 
                                </p>
                                <p class="mb-2" >
                                ' . $rowsEstado['nombre_estado'] . ' 
                                </p>
                                <p class="font-weight-bold">
                                <i class="fa fa-clipboard"></i> Descripcion
                                </p>
                                <p>
                                ' . $descriestado .'
                                </p>
                            </address>
                            </div>

                            <div class="col-md-6">
                            <address class="text-dark">
                            <p class="font-weight-bold">
                            <i class="fa fa-calendar"></i> Fecha de Cambio de estado
                            </p>
                            <p class="mb-2">
                            ' . $fechacambio . '
                            </p>
                            <p class="font-weight-bold">
                            <i class="fa fa-bell-o"></i>   Fecha de Notificacion 
                            </p>
                            <p>
                            ' . $fechanotifi . '
                            </p>
                            </address>
                        </div>  
                        ';
                    }
                    $tarjetaEstado .= '
                </div>
                <hr>
                  <!--infomacion del contacto-->
                  <p class=""><u><strong>Datos del Cliente</strong></u></p>
                  <div class="row">
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>  Correo
                                </p>
                                <p class="mb-2">
                                ' . $rows['correo_cli'] . '
                                </p>
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>   Telefono
                                </p>
                                <p>
                                ' . $rows['telefono_cli'] . '
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>   Profesión
                                </p>
                                <p class="mb-2">
                                ' . $rows['profesion_cli'] . '
                                </p>
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>    Grado
                                </p>
                                <p>
                                ' . $rows['grado_cli'] . '
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>   Pais
                                </p>
                                <p class="mb-2">
                                ' . $rows['pais_cli'] . '
                                </p>
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>    Departamento
                                </p>
                                <p>
                                ' . $rows['departamento_cli'] . '
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>    Distrito
                                </p>
                                <p class="mb-2">
                                ' . $rows['distrito_cli'] . '
                                </p>
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i> Dirección
                                </p>
                                <p>
                                ' . $rows['direccion_cli'] . '
                                </p>
                            </address>
                        </div>
                    </div>
                    <!--fin informacion del contacto-->


<!--Nodal de editar -->
            <div class="modal fade" id="' . $rows['codigocliente'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header bg-dark">
                            <h4 class="text-light text-center">Editar Cliente</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-white">×</span>
                            </button>
                        </div>

                        <!--Body-->
                        <div class="modal-body bg-white p-4">
                                  <form action="' . SERVERURL . 'ajax/clienteAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                 <label for="exampleInputEmail1"><strong>DNI</strong></label>
                                                 <input type="hidden" class="form-control" name="estadocool" id="estadocool" value="'.$estadocool.'">   
                                                 <input type="hidden" class="form-control" name="estadofull" id="estadofull" value="'.$estadofull.'">                     
                                                <input type="hidden" class="form-control" name="idcliente" id="idcliente" value="'.$rows['idcliente'].'">                        
                                                <input type="text" class="form-control" name="dni" id="dni" placeholder="DNI"  value="'.$rows['dni_cli'].'">
                                             </div>
                                                                <div class="col-md-5 form-group">
                                                                    <label for="exampleInputEmail1"><strong> Fecha Nacimiento</strong></label>
                                                                    <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento" placeholder="Nombre" value="' . $rows['fechanacimiento_cli'] . '">
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label for="exampleInputEmail1"><strong>Alumno</strong></label>
                                                                    <select class="form-control form-control-lg" name="alumno" id="alumno">
                                                                        <option value="' . $rows['alumno_cli'] . '">' . $rows['alumno_cli'] . '</option>
                                                                        <option value="Nuevo">Nuevo</option>
                                                                        <option value="ExAlumno">ExAlumno</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputEmail1"><strong>Nombres</strong></label>
                                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="' . $rows['nombres_cli'] . '">
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Apellidos</strong></label>
                                                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="' . $rows['apellidos_cli'] . '">
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Correo</strong></label>
                                                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" value="' . $rows['correo_cli'] . '">
                                                                </div>
                                                                <div class=" col-md-6 form-group">
                                                                    <label for="exampleInputEmail1"><strong>Teléfono</strong></label>
                                                                    <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono" value="' . $rows['telefono_cli'] . '">
                                                                </div>
                                                          
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Profesión</strong></label>
                                                                    <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesion" value="' . $rows['profesion_cli'] . '">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Grado</strong></label>
                                                                    <input type="text" class="form-control" name="grado" id="grado" placeholder="grado" value="' . $rows['grado_cli'] . '">
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Pais</strong></label>
                                                                    <input type="text" class="form-control" name="pais" id="pais" placeholder="pais" value="' . $rows['pais_cli'] . '">
                                                                </div>

                                                                <div class=" col-md-4 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Departamento</strong></label>
                                                                    <input type="text" class="form-control" name="departamento" id="departamento" placeholder="Departamento" value="' . $rows['departamento_cli'] . '"> 
                                                                </div>
                                                                <div class=" col-md-4 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Distrito</strong></label>
                                                                    <input type="text" class="form-control" name="distrito" id="distrito" placeholder="Distrito" value="' . $rows['distrito_cli'] . '">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Direccion</strong></label>
                                                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion"  value="' . $rows['direccion_cli'] . '">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Detalle</strong></label>
                                                                    <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Detalle" value="' . $rows['detalle_cli'] . '">
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <button type="submit" name="actualizar_cliente" class="btn btn-dark col-md-12">Actualizar</button>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <button type="button" class=" btn btn-danger col-md-12" data-dismiss="modal" aria-label="Close">
                                                                         <span aria-hidden="true" class=""> Cancel</span>
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
    
            ';

      
        }
        $tarjetaEstado .= '
                                                
                                            <form action="' . SERVERURL . 'ajax/interesAjax.php" method="POST" class="forms-sample"  
                                            autocomplete="off" enctype="multipart/form-data">
                                            
                                                
                                                <div class="row bg-white p-4 ">
                                                
                                                    <div class="col-md-6 form-group">
                                                   <input type="hidden" name="estadofull" id="estadofull"  value="'.$estadofull .'">
                                                                                                      
                                                    <input type="hidden" name="idespecialidad" id="idespecialidad"  value="'.$idespecialidad .'">
                                                    <input type="hidden" name="codigousuario" id="codigousuario"  value="'.$usuario.'">
                                                    <input type="hidden" name="codigocliente" id="codigocliente" value="'.$cododigo.'">
                                                    <input type="hidden" name="idinteres" id="idinteres" value="'.$idinteres .'">
                                                  
                                                    <button type="button" 
                                                   
                                                    class="btn btn-dark col-md-12"
                                                    data-toggle="modal" data-target="#exampleModalScrollable"
                                                    >
                                                    Enviar Matricula
                                                    </button>
                                                    <hr>
                                         
                                                       
                                                        
                                                           
                                                           ';
                                                $datosE = $conexion->query("
                                                                    SELECT * FROM estado WHERE estado_actual=1 AND idestado<>1 AND idestado<>3 ORDER BY codigoestado");

                                                    $datosE = $datosE->fetchAll();
                                                    foreach ($datosE as $rowsE) {
                                                        $tarjetaEstado .= '
                                                                                                                        <input  type="radio" class="form-check-input" name="estado" id="estado"  value="' . $rowsE['idestado'] . '" > 
                                                                            <p> <font  style="background-color: ' . $rowsE['color'] . ';"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>&nbsp;<strong>' . $rowsE['nombre_estado'] . ' </strong> : &nbsp;  ' . $rowsE['descri_estado'] . '</p> 
                                        
                                                                        ';
        }



        $tarjetaEstado .= '    
                                                         
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                            <label><strong> Fecha de notificación</strong></label><br>
                                                             <input type="datetime-local"  class="form-control" name="fechanotificacion" id="fechanotificacion">
                                                                                          
                                                            <!--descripcion-->
                                                            <br>
                                                            <label><strong>Descripción del Estado</strong></label>
                                                            <input type="text" class="form-control" placeholder="Descripcion"  name="descripcion" id="descripcion" aria-describedby="colored-addon2" required>
                                                                
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <button type="submit" name="actualizarinteres" class="col-md-12 btn btn-success">Actualizar estado</button>
                                                        </div>
                                                    <div class="col-md-6 form-group">
                                                          <a href="' . SERVERURL . 'sesionestadoactual/'.$estadofull.'" class="col-md-12 btn btn-danger"> Cancel</a>
                                                    </div>
                                                </div>
                                                </form>
                                        ';
        return $tarjetaEstado;
    }

        public function cliente_actualizacion_estado()
                {
                //
                $idespecialidad = 0;
                $tarjetaEstado = "";
                $cod = $_SESSION['codigocliente'];
                $conexion = mainModel::conectar();

                //variables de interes
                $idinteres = "";
                $descriestado = "";
                $fechacambio = "";
                //SELECIONADO CURSO
                $usuario = $_SESSION['codigo_srcp'];
                //$usuario=$_SESSION['codigo_srcp'];
                $datosEs = $conexion->query("
                    SELECT * FROM especialidad WHERE sesion='$usuario' ");
                $datosEs = $datosEs->fetchAll();
                foreach ($datosEs as $rowsEs) {
                    $idespecialidad = $rowsEs['idespecialidad'];
                }

                //datos de interes que serviran par ala inseriocn 
                $datosInteres = $conexion->query("
                    SELECT * FROM interes WHERE idespecialidad='$idespecialidad'AND codigocliente='$cod' ORDER by idestado ");
                $datosInteres = $datosInteres->fetchAll();
                foreach ($datosInteres as $rowsInt) {

                    $descriestado = $rowsInt['descri_estado'];
                    $fechacambio = $rowsInt['fecha_cambio_estado'];
                    $fechanotifi = $rowsInt['fecha_notificacion'];
                    $idinteres = $rowsInt['idinteres'];
                    $idusuario = $rowsInt['idusuario'];
                }

                //selecionando cliente
                $datosCliente = $conexion->query("
                SELECT * FROM cliente WHERE codigocliente='$cod'  ");
                $datosCliente = $datosCliente->fetchAll();

                foreach ($datosCliente as $rows) {
                    $tarjetaEstado .= '
                    <h5 class="text-dark text-center"><strong>Nombre : ' . $rows['nombres_cli'] . ' ' . $rows['apellidos_cli'] . '</strong>
                    
                    <div class="btn-group dropdown float-right">
                                <button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#' . $rows['codigocliente'] . '">
                                Editar Cliente
                                </button>
                    </div>
                    </h5>
                    
                <p class=""><u><strong>Datos del Estado Actual</strong></u></p>
                        <div class="row">
                            ';


                    //DATOS DEL ESTADO 
                    $estado = $_SESSION['estadocliente'];
                    $datosEstado = $conexion->query("
                            SELECT * FROM estado WHERE 	idestado='$estado' ");
                    $datosEstado = $datosEstado->fetchAll();
                    foreach ($datosEstado as $rowsEstado) {
                        $tarjetaEstado .= '
                                
                            <div class="col-md-6">
                            <address class="text-dark">
                                <p class="font-weight-bold">
                                <i class="menu-icon  fa fa-cubes"></i> Estado 
                                </p>
                                <p class="mb-2" >
                                ' . $rowsEstado['nombre_estado'] . ' 
                                </p>
                                <p class="font-weight-bold">
                                <i class="fa fa-clipboard"></i> Descripcion
                                </p>
                                <p>
                                ' . $descriestado . '
                                </p>
                            </address>
                            </div>


                            <div class="col-md-6">
                            <address class="text-dark">
                            <p class="font-weight-bold">
                            <i class="fa fa-calendar"></i> Fecha de Cambio de estado
                            </p>
                            <p class="mb-2">
                            ' . $fechacambio . '
                            </p>
                            <p class="font-weight-bold">
                            <i class="fa fa-bell-o"></i>   Fecha de Notificacion 
                            </p>
                            <p>
                            ' . $fechanotifi . '
                            </p>
                            </address>
                        </div>

                        
                        
                        ';
                    }
                    $tarjetaEstado .= '
                </div>
                <hr>
                  <!--infomacion del contacto-->
                  <p class=""><u><strong>Datos del Cliente</strong></u></p>
                  <div class="row">
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>  Correo
                                </p>
                                <p class="mb-2">
                                ' . $rows['correo_cli'] . '
                                </p>
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>   Telefono
                                </p>
                                <p>
                                ' . $rows['telefono_cli'] . '
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>   Profesión
                                </p>
                                <p class="mb-2">
                                ' . $rows['profesion_cli'] . '
                                </p>
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>    Grado
                                </p>
                                <p>
                                ' . $rows['grado_cli'] . '
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>   Pais
                                </p>
                                <p class="mb-2">
                                ' . $rows['pais_cli'] . '
                                </p>
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>    Departamento
                                </p>
                                <p>
                                ' . $rows['departamento_cli'] . '
                                </p>
                            </address>
                        </div>
    
    
                        <div class="col-md-3">
                            <address class="">
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i>    Distrito
                                </p>
                                <p class="mb-2">
                                ' . $rows['distrito_cli'] . '
                                </p>
                                <p class="font-weight-bold text-dark">
                                <i class="fa fa-circle "></i> Dirección
                                </p>
                                <p>
                                ' . $rows['direccion_cli'] . '
                                </p>
                            </address>
                        </div>
                    </div>
                    <!--fin informacion del contacto-->


<!--Nodal de editar -->
            <div class="modal fade" id="' . $rows['codigocliente'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header bg-dark">
                            <h4 class="text-light text-center">Editar Cliente</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-white">×</span>
                            </button>
                        </div>

                        <!--Body-->
                        <div class="modal-body bg-white p-4">
                                  <form action="' . SERVERURL . 'ajax/clienteAjax.php" method="POST" class="forms-sample" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                 <label for="exampleInputEmail1"><strong>DNI</strong></label>
                                                <input type="hidden" class="form-control" name="idcliente" id="idcliente" value="' . $rows['idcliente'] . '">                        
                                                <input type="text" class="form-control" name="dni" id="dni" placeholder="DNI"  value="' . $rows['dni_cli'] . '">
                                             </div>
                                                                <div class="col-md-5 form-group">
                                                                    <label for="exampleInputEmail1"><strong> Fecha Nacimiento</strong></label>
                                                                    <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento" placeholder="Nombre" value="' . $rows['fechanacimiento_cli'] . '">
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label for="exampleInputEmail1"><strong>Alumno</strong></label>
                                                                    <select class="form-control form-control-lg" name="alumno" id="alumno">
                                                                        <option value="' . $rows['alumno_cli'] . '">' . $rows['alumno_cli'] . '</option>
                                                                        <option value="Nuevo">Nuevo</option>
                                                                        <option value="ExAlumno">ExAlumno</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputEmail1"><strong>Nombres</strong></label>
                                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="' . $rows['nombres_cli'] . '">
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Apellidos</strong></label>
                                                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="' . $rows['apellidos_cli'] . '">
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Correo</strong></label>
                                                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" value="' . $rows['correo_cli'] . '">
                                                                </div>
                                                                <div class=" col-md-6 form-group">
                                                                    <label for="exampleInputEmail1"><strong>Teléfono</strong></label>
                                                                    <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono" value="' . $rows['telefono_cli'] . '">
                                                                </div>
                                                          
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Profesión</strong></label>
                                                                    <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesion" value="' . $rows['profesion_cli'] . '">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Grado</strong></label>
                                                                    <input type="text" class="form-control" name="grado" id="grado" placeholder="grado" value="' . $rows['grado_cli'] . '">
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Pais</strong></label>
                                                                    <input type="text" class="form-control" name="pais" id="pais" placeholder="pais" value="' . $rows['pais_cli'] . '">
                                                                </div>

                                                                <div class=" col-md-4 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Departamento</strong></label>
                                                                    <input type="text" class="form-control" name="departamento" id="departamento" placeholder="Departamento" value="' . $rows['departamento_cli'] . '"> 
                                                                </div>
                                                                <div class=" col-md-4 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Distrito</strong></label>
                                                                    <input type="text" class="form-control" name="distrito" id="distrito" placeholder="Distrito" value="' . $rows['distrito_cli'] . '">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Direccion</strong></label>
                                                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion"  value="' . $rows['direccion_cli'] . '">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="exampleInputPassword1"><strong>Detalle</strong></label>
                                                                    <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Detalle" value="' . $rows['detalle_cli'] . '">
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <button type="submit" name="actualizar_cliente" class="btn btn-dark col-md-12">Actualizar</button>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <button type="button" class=" btn btn-danger col-md-12" data-dismiss="modal" aria-label="Close">
                                                                         <span aria-hidden="true" class=""> Cancel</span>
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
    
            ';

      
        }
        $tarjetaEstado .= '
                                                
                                            <form action="' . SERVERURL . 'ajax/interesAjax.php" method="POST" class="forms-sample"  
                                            autocomplete="off" enctype="multipart/form-data">
                                            
                                                
                                                <div class="row bg-white p-4 ">
                                                
                                                    <div class="col-md-6 form-group">
                                                    <input type="hidden" name="idespecialidad" id="idespecialidad"  value="' . $idespecialidad . '">
                                                    <input type="hidden" name="codigousuario" id="codigousuario"  value="' . $usuario . '">
                                                    <input type="hidden" name="codigocliente" id="codigocliente" value="' . $cod . '">
                                                    <input type="hidden" name="idinteres" id="idinteres" value="' . $idinteres . '">
                                                  
                                                    <button type="button" 
                                                    name="actualizarinteres" 
                                                    class="btn btn-dark col-md-12"
                                                    data-toggle="modal" data-target="#exampleModalScrollable"
                                                    >
                                                    Enviar Matricula
                                                    </button>
                                                    <hr>
                                         
                                                       
                                                        
                                                           
                                                           ';
                                                $datosE = $conexion->query("
                                                                    SELECT * FROM estado WHERE estado_actual=1 AND idestado<>1 ORDER BY codigoestado");

                                                    $datosE = $datosE->fetchAll();
                                                    foreach ($datosE as $rowsE) {
                                                        $tarjetaEstado .= '
                                                                                                                        <input  type="radio" class="form-check-input" name="estado" id="estado"  value="' . $rowsE['idestado'] . '" > 
                                                                            <p> <font  style="background-color: ' . $rowsE['color'] . ';"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>&nbsp;<strong>' . $rowsE['nombre_estado'] . ' </strong> : &nbsp;  ' . $rowsE['descri_estado'] . '</p> 
                                        
                                                                        ';
        }



        $tarjetaEstado .= '    
                                                         
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                            <label><strong> Fecha de notificación</strong></label><br>
                                                             <input type="datetime-local"  class="form-control" name="fechanotificacion" id="fechanotificacion">
                                                                                          
                                                            <!--descripcion-->
                                                            <br>
                                                            <label><strong>Descripción del Estado</strong></label>
                                                            <input type="text" class="form-control" placeholder="Descripcion"  name="descripcion" id="descripcion" aria-describedby="colored-addon2" required>
                                                                
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <button type="submit" name="actualizarinteres" class="col-md-12 btn btn-success">Actualizar estado</button>
                                                        </div>
                                                    <div class="col-md-6 form-group">
                                                          <a href="' . SERVERURL . 'sesioncurso" class="col-md-12 btn btn-danger"> Cancel</a>
                                                    </div>
                                                </div>
                                                </form>
                                        ';
        return $tarjetaEstado;
    }



    public function   pasando_variable_controlador($variable, $identificador, $idinterescontrol)
    {
        session_start(['name' => 'SRCP']);
        $_SESSION['codigocliente'] = $variable;
        $_SESSION['estadocliente'] = $identificador;
        $codigousuario = $_SESSION['id_usuario'];
        $fechaactualcompleta = date("Y-m-d H:i:s");

        $fechaactual = date("Y-m-d");
        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT idcontrol FROM controlusuario");
        $numero = ($consulta1->rowCount()) + 1;

        $codigoCu = mainModel::generar_codigo_aleatorio("CB", 2, $numero);
        $_SESSION['controlusuario'] = $codigoCu;

        $datosControlUsuario = [
            "Idinteres" => $idinterescontrol,
            "Codigousuario" => $codigousuario,
            "Fechainicio" => $fechaactualcompleta,
            "Fechafin" => $fechaactualcompleta,
            "Fecha" => $fechaactual,
            "Codigocontrol" => $codigoCu

        ];

        $insertarControlusuario = mainModel::guardar_control_usuario($datosControlUsuario);


        //insertar datos para el control usuario

    }


    public function leer_cliente_prematriculado_controlador()
    {
        $table = "";
        $conexion = mainModel::conectar();

        $datoscli = $conexion->query("
            SELECT COUNT(*) as totalcli FROM interes WHERE idestado=3 and fincurso>curdate()");
        $datoscli = $datoscli->fetchAll();
        foreach ($datoscli as $rowscli) {
            $totalcli = $rowscli['totalcli'];
        }

        $table .= '  
            <h4 class="text-primary"> <i class="fa fa-child text-primary icon-lg"></i> Total de clientes  : ' . $totalcli . '</h4>
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
                ';
        $datosclinte = $conexion->query("
            SELECT idinteres,codigocliente, idespecialidad FROM interes WHERE idestado=3 and fincurso>curdate()");
        $datosclinte = $datosclinte->fetchAll();
        foreach ($datosclinte as $rowscliente) {
            $idinteres = $rowscliente['idinteres'];
            $idcliente = $rowscliente['codigocliente'];
            $codigocurso = $rowscliente['idespecialidad'];

            $datoscurso = $conexion->query("
            SELECT nombre_es,abreviatura_es, codigo_pack FROM especialidad WHERE idespecialidad=$codigocurso");
            $datoscurso = $datoscurso->fetchAll();
            foreach ($datoscurso as $rowscurso) {
                $nombrecurso = $rowscurso['nombre_es'];
                $abrecurso = $rowscurso['nombre_es'];
                $codigopackcurso = $rowscurso['codigo_pack'];
            }

            $datos = $conexion->query("
            SELECT * FROM cliente WHERE codigocliente='$idcliente'");
            $datos = $datos->fetchAll();
            foreach ($datos as $rows) {
                $table .= '
                <tr>
                <td>' . $rows['codigocliente'] . '</td>
                <td>' . $rows['nombres_cli'] . ' ' . $rows['apellidos_cli'] . '</td>
                <td>' . $abrecurso . '</td>
            
                
                <td>
                    <button type="button" class="btn btn-inverse-dark" aria-haspopup="true" aria-expanded="false"
                        data-toggle="modal" data-target="#' . $rows['codigocliente'] . '">
                        <i class="fa fa-drivers-license-o"></i> Ver
                    </button>
                </td>
                <form action="' . SERVERURL . 'ajax/clienteAjax.php"   method="post">
            
                <td>
                <input type="text"   name="codigopack" value="' . $codigopackcurso . '">
                <input type="text"   name="codigocurso" value="' . $codigocurso . '">

                <input type="text"   name="codigocliente" value="' . $rows['codigocliente'] . '">
                <input type="text"   name="nombre" value="' . $rows['nombres_cli'] . '">
                <input type="text"   name="apellidos" value="' . $rows['apellidos_cli'] . '">
                <input type="text"   name="correo" value="' . $rows['correo_cli'] . '">
                <input type="text"   name="telefono" value="' . $rows['telefono_cli'] . '">
                <input type="text"   name="profesion" value="' . $rows['profesion_cli'] . '">
                <input type="text"   name="grado" value="' . $rows['grado_cli'] . '">
                <input type="text"   name="pais" value="' . $rows['pais_cli'] . '">
                <input type="text"   name="departamento" value="' . $rows['departamento_cli'] . '">
                <input type="text"   name="distrito" value="' . $rows['distrito_cli'] . '">
                <input type="text"   name="direccion" value="' . $rows['direccion_cli'] . '">
                <input type="text"   name="dni" value="' . $rows['dni_cli'] . '">
                <input type="text"   name="fechanacimiento" value="' . $rows['fechanacimiento_cli'] . '">
                <input type="text"   name="alumno" value="' . $rows['alumno_cli'] . '">
                <input type="text"   name="detalle" value="' . $rows['detalle_cli'] . '">
               
         
                 
                    <button type="submit" name="matricular" class="btn btn-danger">
                        <i class="fa fa-drivers-license-o"></i> Matricular
                    </button>
                    </form>
                </td>
            </tr>

            <!--DETALLE-->  
                <div class="modal fade" id="' . $rows['codigocliente'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header bg-dark">
                        <h4 class="text-light text-center"> <i class="fa fa-child text-white icon-lg"></i> Cliente: &nbsp;' . $rows['nombres_cli'] . '</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                        </button>
                    </div>

                    <!--Body-->
                    <div class="modal-body">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                                <address class=""> 
                                <p class="font-weight-bold">
                                Nombres
                                </p>
                                <p class="mb-2">
                                ' . $rows['nombres_cli'] . ' &nbsp; ' . $rows['apellidos_cli'] . '
                                </p>
                                <p class="font-weight-bold">
                                    Correo
                                </p>
                                <p>
                                ' . $rows['correo_cli'] . '
                                </p>
                                </address>
                            </div>


                            <div class="col-md-6">
                                <address class="">
                                <p class="font-weight-bold">
                                Teléfono
                                </p>
                                <p class="mb-2">
                                ' . $rows['telefono_cli'] . '
                                </p>
                                <p class="font-weight-bold">
                                    Profesion
                                </p>
                                <p>
                                ' . $rows['profesion_cli'] . '
                                </p>
                                </address>
                            </div>

                            <div class="col-md-6">
                                    <address class="">
                                    <p class="font-weight-bold">
                                    Grado
                                    </p>
                                    <p class="mb-2">
                                    ' . $rows['grado_cli'] . '
                                    </p>
                                    <p class="font-weight-bold">
                                    Departamento
                                    </p>
                                    <p>
                                    ' . $rows['departamento_cli'] . '
                                    </p>
                                    </address>
                                </div> 
                                
                                <div class="col-md-6">
                                    <address class="">
                                    <p class="font-weight-bold">
                                    Distrito
                                    </p>
                                    <p class="mb-2">
                                    ' . $rows['distrito_cli'] . '
                                    </p>
                                    <p class="font-weight-bold">
                                    Direccion
                                    </p>
                                    <p>
                                    ' . $rows['direccion_cli'] . '
                                    </p>
                                    </address>
                                </div>   



                            


                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
           <!--FINDETALLE--> 

                ';
            }
        }
        return $table;
    }
    //mostrar tabla estados


    public function informacion_detalle_certificado_($datosdeAlumno)
    {

        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');
        $table = "";
        $id = mainModel::decryption($datosdeAlumno);
        $conexion = mainModel::conectar();

        //INTERESES
        $datosAlumno = $conexion->query("
            SELECT * FROM detalle_certificado WHERE iddetalle_certificado=$id");
        $datosAlumno = $datosAlumno->fetchAll();
        foreach ($datosAlumno as $rowsDetalle) {

            $table = ' 
            <div class="row">
                <div class="col-md-8">
                    <h3 class=" text-primary mb-2">Codigo : ' . $rowsDetalle['codigo_detalle'] . '</h3>
                </div>

                <div class="col-md-4 ">
                    
                 <div class="btn-group dropdown float-right">
                            <a href="javascript:window.history.back();">
                                <button type="button" class="btn btn-primary  btn-sm" aria-haspopup="true"
                                    aria-expanded="false">
                                    Regresar
                                </button>
                            </a>
                            <a href="alumnoconfig.php">
                            <button type="button" class="btn btn-danger  btn-sm" aria-haspopup="true"
                                aria-expanded="false">
                                Eliminar
                            </button>
                        </a>
                </div>
                </div>

            </div>
            ';

            $table .= '
            <hr>

            <!--infomacion del contacto-->
            <div class="row">
                <div class="col-md-3">
                    <address class="">
                        <p class="font-weight-bold">
                            Codigo Alumno
                        </p>
                        <p class="mb-2">
                        ' . $rowsDetalle['codigoalumno'] . '
                        </p>
                        <p class="font-weight-bold">
                            Nota
                        </p>
                        <p>
                        ' . $rowsDetalle['nota'] . '
                        </p>
                    </address>
                </div>


                <div class="col-md-3">
                    <address class="">
                        <p class="font-weight-bold">
                           Fecha Inicio
                        </p>
                        <p class="mb-2">
                        ' . strftime("%d de %B del %Y", strtotime($rowsDetalle['fecha_inicio'])) . '
                        </p>
                        <p class="font-weight-bold">
                            Fecha Fin
                        </p>
                        <p>
                        ' . strftime("%d de %B del %Y", strtotime($rowsDetalle['fecha_fin'])) . '
                        </p>
                    </address>
                </div>


                <div class="col-md-3">
                    <address class="">
                        <p class="font-weight-bold">
                            Fecha de Emision
                        </p>
                        <p class="mb-2">
                        ' . strftime("%d de %B del %Y", strtotime($rowsDetalle['fecha_emision'])) . '
                        </p>
                        <p class="font-weight-bold">
                            Horas Pedagógicas
                        </p>
                        <p>
                        ' . $rowsDetalle['horas_pedagogicas'] . '
                        </p>
                    </address>
                </div>

            </div>
            <!--fin informacion del contacto-->
            ';
        }
        return $table;
    }


    public function editar_detalle_certificado_($datosdeAlumno)
    {

        $table = "";
        $id = mainModel::decryption($datosdeAlumno);
        $conexion = mainModel::conectar();

        //INTERESES
        $datosAlumno = $conexion->query("
            SELECT * FROM detalle_certificado WHERE iddetalle_certificado=$id");
        $datosAlumno = $datosAlumno->fetchAll();
        foreach ($datosAlumno as $rowsDetalle) {

            $table = '';

            $table .= '
            <form class="forms-sample" method="POST" action="' . SERVERURL . 'ajax/clienteAjax.php">
                    <div class="row">
                        <div class="col-md-6">
                            <!--nombre/apellidos/correo-->

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Fecha Inicio</label>
                                    <input type="hidden" class="form-control" name="iddetalle" id="iddetalle" placeholder="fecha inicio"
                                    value="' . $rowsDetalle['iddetalle_certificado'] . '">
                                    <input type="date" class="form-control" name="fechainicio" id="fechainicio" placeholder="fecha inicio"
                                     value="' . $rowsDetalle['fecha_inicio'] . '">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="exampleInputPassword1">Fecha Final</label>
                                    <input type="date" class="form-control" name="fechafinal" id="fechafinal"
                                     value="' . $rowsDetalle['fecha_fin'] . '" >
                                </div>

                                <div class="col-md-12 form-group form-group">
                                    <label for="exampleInputPassword1">Fecha de Emision</label>
                                    <input type="date" class="form-control" name="fechaemision" id="fechaemision"
                                     value="' . $rowsDetalle['fecha_emision'] . '">
                                </div>

                            </div>

                          
                           
                        </div>

                        <!--telefono/profesion/grado-->
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputPassword1">Horas Pedagógicas</label>
                                <input type="text" class="form-control" name="horasp" id="horasp"
                                value="' . $rowsDetalle['horas_pedagogicas'] . '">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Nota</label>
                                <input type="text" class="form-control" name="nota" id="nota"
                                value="' . $rowsDetalle['nota'] . '">
                            </div>
                          
                        </div>


                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button type="submit" name="actualizar_certificado" class="btn btn-success mr-2">Actualizar</button>
                           </div>
                        <div class="form-group">
                           <a href="javascript:history.back(-1);" class="btn btn-info">Cancel</a>
                        </div>
                    </div>
                </form>';
        }
        return $table;
    }

    public function cargar_certificado_nuevoalumno($datosdeAlumno)
    {

        $table = "";
        $fechaemision = date("Y-m-d");
        $nota = 0;
        $id = mainModel::decryption($datosdeAlumno);
        $conexion = mainModel::conectar();

        //INTERESES
        $datosAlumno = $conexion->query("
            SELECT * FROM especialidad WHERE idespecialidad=$id");
        $datosAlumno = $datosAlumno->fetchAll();
        foreach ($datosAlumno as $rowsDetalle) {



            $table .= '  <div class="col-md-12 form-group">
            <label for="exampleInputEmail1">Fecha Inicio</label>
        
            <input type="date" class="form-control" name="fechainicio" id="fechainicio" placeholder="fecha inicio"
             value="' . $rowsDetalle['fecha_inicio'] . '">
        </div>

        <div class="col-md-12 form-group">
            <label for="exampleInputPassword1">Fecha Final</label>
            <input type="date" class="form-control" name="fechafinal" id="fechafinal"
             value="' . $rowsDetalle['fecha_fin'] . '" >
        </div>

        <div class="col-md-12 form-group form-group">
            <label for="exampleInputPassword1">Fecha de Emision</label>
            <input type="date" class="form-control" name="fechaemision" id="fechaemision"
             value="' . $fechaemision . '">
        </div>
        
        <div class="col-md-12 form-group">
            <label for="exampleInputPassword1">Horas Pedagógicas</label>
            <input type="text" class="form-control" name="horasp" id="horasp"
            value="' . $rowsDetalle['horas_certificado'] . '">
        </div>
        <div class="col-md-12 form-group">
            <label for="exampleInputPassword1"> Nota</label>
            <input type="text" size="2" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" name="nota" id="nota"
            value="' . $nota . '">
            <input type="hidden" class="form-control" name="certicado_ladouno" id="certicado_ladouno"
            value="' . mainModel::encryption($rowsDetalle['certicado_ladouno']) . '">
            <input type="hidden" class="form-control" name="certicado_ladodos" id="certicado_ladodos"
            value="' . mainModel::encryption($rowsDetalle['certicado_ladodos']) . '">
        </div>';
        }
        return $table;
    }
    public function cargar_datos_certificado($datosdeAlumno)
    {

        $table = "";
        $fechaemision = date("Y-m-d");
        $nota = 18;
        $id = $datosdeAlumno; 
        $conexion = mainModel::conectar();

        //INTERESES
        $datosAlumno = $conexion->query("
            SELECT * FROM especialidad WHERE idespecialidad=$id");
        $datosAlumno = $datosAlumno->fetchAll();
        foreach ($datosAlumno as $rowsDetalle) {



            $table .= '  <div class="form-group">
            <label for="exampleInputEmail1">Fecha Inicio</label>
        
            <input type="date" class="form-control" name="fechainicio" id="fechainicio" placeholder="fecha inicio"
             value="' . $rowsDetalle['fecha_inicio'] . '">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Fecha Final</label>
            <input type="date" class="form-control" name="fechafinal" id="fechafinal"
             value="' . $rowsDetalle['fecha_fin'] . '" >
        </div>

        <div class="form-group form-group">
            <label for="exampleInputPassword1">Fecha de Emision</label>
            <input type="date" class="form-control" name="fechaemision" id="fechaemision"
             value="' . $fechaemision . '">
        </div>
        
        <div class="form-group">
            <label for="exampleInputPassword1">Horas Pedagógicas</label>
            <input type="text" class="form-control" name="horasp" id="horasp"
            value="' . $rowsDetalle['horas_certificado'] . '">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"> Nota</label>
            <input type="text" size="2" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" name="nota" id="nota"
            value="' . $nota . '">
            <input type="hidden" class="form-control" name="certicado_ladouno" id="certicado_ladouno"
            value="' . mainModel::encryption($rowsDetalle['certicado_ladouno']) . '">
            <input type="hidden" class="form-control" name="certicado_ladodos" id="certicado_ladodos"
            value="' . mainModel::encryption($rowsDetalle['certicado_ladodos']) . '">
        </div>';
        }
        return $table;
    }

    public function cargar_taller_nuevoalumno($datosdeAlumno)
    {

        $table = "";
        $fechaemision = date("Y-m-d");
        $nota = 0;
        $id = mainModel::decryption($datosdeAlumno);
        $conexion = mainModel::conectar();

        //INTERESES
        $datosAlumno = $conexion->query("
            SELECT * FROM especialidad WHERE idespecialidad=$id");
        $datosAlumno = $datosAlumno->fetchAll();
        foreach ($datosAlumno as $rowsDetalle) {



            $table .= '  <div class="col-md-12 form-group">
            <label for="exampleInputEmail1">Fecha de Taller</label>
        
            <input type="date" class="form-control" name="fechainicio" id="fechainicio" placeholder="fecha inicio"
             value="' . $rowsDetalle['fecha_inicio'] . '">
        </div>

    
        <div class="col-md-12 form-group form-group">
            <label for="exampleInputPassword1">Fecha de Emision</label>
            <input type="date" class="form-control" name="fechaemision" id="fechaemision"
             value="' . $fechaemision . '">
        </div>
        
        <div class="col-md-12 form-group">
            <label for="exampleInputPassword1">Horas Cronologicas</label>
            <input type="text" class="form-control" name="horasp" id="horasp"
            value="' . $rowsDetalle['horas_certificado'] . '">
        </div>
        <div class="col-md-12 form-group">
          
           
            <input type="hidden" class="form-control" name="certicado_ladouno" id="certicado_ladouno"
            value="' . mainModel::encryption($rowsDetalle['certicado_ladouno']) . '">
            <input type="hidden" class="form-control" name="certicado_ladodos" id="certicado_ladodos"
            value="' . mainModel::encryption($rowsDetalle['certicado_ladodos']) . '">
        </div>';
        }
        return $table;
    }


    public function informacion_alumnos_paraeditar($datosdeAlumno)
    {

        $table = "";
        $id = mainModel::decryption($datosdeAlumno);
        $conexion = mainModel::conectar();

        //INTERESES
        $datosAlumno = $conexion->query("
            SELECT * FROM alumno WHERE idalumno=$id");
        $datosAlumno = $datosAlumno->fetchAll();
        foreach ($datosAlumno as $rowsAlumno) {

            $table = ' 
            <div class="row">
                <div class="col-md-8">
                    <h3 class=" text-primary mb-2">Alumno : ' . $rowsAlumno['nombres_al'] . ' ' . $rowsAlumno['apellidos_al'] . '</h3>
                </div>

                <div class="col-md-4 ">
                    
                 <div class="btn-group dropdown float-right">
                            <a href="alumnoconfig.php">
                                <button type="button" class="btn btn-danger  btn-sm" aria-haspopup="true"
                                    aria-expanded="false">
                                    Eliminar
                                </button>
                            </a>
                </div>
                </div>

            </div>
            ';

            $table .= '
            <hr>

            <!--infomacion del contacto-->
            <div class="row">
                <div class="col-md-3">
                    <address class="">
                        <p class="font-weight-bold">
                            Correo
                        </p>
                        <p class="mb-2">
                        ' . $rowsAlumno['correo_al'] . '
                        </p>
                        <p class="font-weight-bold">
                            Telefono
                        </p>
                        <p>
                        ' . $rowsAlumno['telefono_al'] . '
                        </p>
                        <p class="font-weight-bold">
                            Alumno
                        </p>
                        <p "mb-2">
                        ' . $rowsAlumno['alumno_al'] . '
                        </p>
                    </address>
                </div>


                <div class="col-md-3">
                    <address class="">
                        <p class="font-weight-bold">
                            Profesión
                        </p>
                        <p class="mb-2">
                        ' . $rowsAlumno['profesion_al'] . '
                        </p>
                        <p class="font-weight-bold">
                            Grado
                        </p>
                        <p>
                        ' . $rowsAlumno['grado_al'] . '
                        </p>
                    </address>
                </div>


                <div class="col-md-3">
                    <address class="">
                        <p class="font-weight-bold">
                            Pais
                        </p>
                        <p class="mb-2">
                        ' . $rowsAlumno['pais_al'] . '
                        </p>
                        <p class="font-weight-bold">
                            Departamento
                        </p>
                        <p>
                        ' . $rowsAlumno['departamento_al'] . '
                        </p>
                    </address>
                </div>


                <div class="col-md-3">
                    <address class="">
                        <p class="font-weight-bold">
                            Distrito
                        </p>
                        <p class="mb-2">
                        ' . $rowsAlumno['distrito_al'] . '
                        </p>
                        <p class="font-weight-bold">
                            Direccion
                        </p>
                        <p>
                        ' . $rowsAlumno['direccion_al'] . '
                        </p>
                        
                    </address>
                </div>
            </div>
            <!--fin informacion del contacto-->
            ';
        }
        return $table;
    }

    public function editar_alumno_controlador($datosdeAlumno)
    {

        $table = "";
        $id = mainModel::decryption($datosdeAlumno);
        $conexion = mainModel::conectar();

        //INTERESES
        $datosAlumno = $conexion->query("
            SELECT * FROM alumno WHERE idalumno=$id");
        $datosAlumno = $datosAlumno->fetchAll();
        foreach ($datosAlumno as $rowsAlumno) {


            $table .= '
            <form action="' . SERVERURL . 'ajax/clienteAjax.php" method="POST" class="forms-sample" autocomplete="off">
                <div class="row">
                                <div class="col-md-12">
                                    <!--nombre/apellidos/correo-->

                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputEmail1">DNI</label>
                                            <input type="hidden" class="form-control" name="idalumno" id="idalumno" placeholder="DNI" value="' . $rowsAlumno['idalumno'] . '" required>
                                            <input type="text" class="form-control" name="dni" id="dni" placeholder="DNI" value="' . $rowsAlumno['dni_al'] . '" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputEmail1">Fecha Nacimiento</label>
                                            <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento"  value="' . $rowsAlumno['fechanacimiento_al'] . '" >
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputEmail1">Alumno</label>
                                            <select class="form-control form-control-lg" name="alumno" id="alumno"> 
                                                <option value="' . $rowsAlumno['alumno_al'] . '">' . $rowsAlumno['alumno_al'] . '</option>
                                                <option value="Nuevo">Nuevo</option>
                                                <option value="ExAlumno">ExAlumno</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputEmail1">Siglas</label>
                                               <input type="text" class="form-control" name="siglas" id="siglas" placeholder="siglas" value="' . $rowsAlumno['siglas'] . '">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputEmail1">Nombres</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="' . $rowsAlumno['nombres_al'] . '" required>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputPassword1">Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="' . $rowsAlumno['apellidos_al'] . '">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputPassword1">Correo</label>
                                            <input type="email" class="form-control" id="exampleInputPassword1" name="correo" id="correo"
                                            placeholder="Correo" value="' . $rowsAlumno['correo_al'] . '">
                                        </div>
                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputEmail1">Teléfono</label>
                                            <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono"  value="' . $rowsAlumno['telefono_al'] . '" >
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputPassword1">Profesión</label>
                                            <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesion" value="' . $rowsAlumno['profesion_al'] . '">
                                        </div>
                                        
                                    </div>


                                </div>

                                <!--telefono/profesion/grado-->
                                <div class="col-md-12">
                                    <div class="row">

                                    <div class="col-md-4 form-group">
                                            <label for="exampleInputPassword1">Grado</label>
                                            <input type="text" class="form-control" name="grado" id="grado" placeholder="grado" value="' . $rowsAlumno['grado_al'] . '">
                                        </div>
                                      
                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputPassword1">Pais</label>
                                            <input type="text" class="form-control" name="pais" id="pais" placeholder="pais" value="' . $rowsAlumno['pais_al'] . '">
                                        </div>

                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputPassword1">Departamento</label>
                                            <input type="text" class="form-control" name="departamento" id="departamento" placeholder="Departamento" value="' . $rowsAlumno['departamento_al'] . '">
                                        </div>
                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputPassword1">Distrito</label>
                                            <input type="text" class="form-control" name="distrito" id="distrito" placeholder="Distrito"  value="' . $rowsAlumno['distrito_al'] . '" >
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputPassword1">Direccion</label>
                                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" value="' . $rowsAlumno['direccion_al'] . '">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="exampleInputPassword1">Detalle</label>
                                            <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Detalle" value="' . $rowsAlumno['detalle_al'] . '">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <button type="submit" name="actualizar_alumno" class="btn btn-success mr-2">Actualizar</button>
                                </div>

                                <div class="form-group">
                                    <a href="javascript:history.back(-1);" class="btn btn-info">Cancel</a>
                                </div>

                            </div>
                    </form>
                 ';
        }
        return $table;
    }


    public function mostrar_clientes_prematriculados()
    {

        $table = "";
        $conexion = mainModel::conectar();

        //INTERESES
        $datosclinte = $conexion->query("
            SELECT idinteres,codigocliente, idespecialidad FROM interes WHERE idestado=3");
        $datosclinte = $datosclinte->fetchAll();
        foreach ($datosclinte as $rowscliente) {
            $idinteres = $rowscliente['idinteres'];
            $idcliente = $rowscliente['codigocliente'];
            $codigocurso = $rowscliente['idespecialidad'];


            //ESPECIALIDAD
            $datoscurso = $conexion->query("
            SELECT nombre_es,abreviatura_es, codigo_pack FROM especialidad WHERE idespecialidad=$codigocurso");
            $datoscurso = $datoscurso->fetchAll();
            foreach ($datoscurso as $rowscurso) {

                $abrecurso = $rowscurso['nombre_es'];
                $codigopackcurso = $rowscurso['codigo_pack'];
            }


            //CLIENTE
            $datos = $conexion->query("
            SELECT * FROM cliente WHERE codigocliente='$idcliente'");
            $datos = $datos->fetchAll();
            foreach ($datos as $rows) {
                $table .= '
                <tr>
                <td>' . $rows['codigocliente'] . '</td>
                <td>' . $rows['nombres_cli'] . ' ' . $rows['apellidos_cli'] . '</td>
                <td>' . $abrecurso . '</td>    
                <td>
                    <a class="btn btn-inverse-dark" href="' . SERVERURL . 'detallecliente/' . $rows['codigocliente'] . '">
                        <i class="fa fa-drivers-license-o"></i> Ver               
                    </a>
                </td>  
                <td>
                    <form action="' . SERVERURL . 'ajax/clienteAjax.php"   method="post">
                            <input type="hidden"   name="codigopack" value="' . $codigopackcurso . '">
                            <input type="hidden"   name="codigocurso" value="' . $codigocurso . '">
                            <input type="hidden"   name="codigocliente" value="' . $rows['codigocliente'] . '">
                            <input type="hidden"   name="siglas" value="' . $rows['siglas'] . '">
                            <input type="hidden"   name="nombre" value="' . $rows['nombres_cli'] . '">
                            <input type="hidden"   name="apellidos" value="' . $rows['apellidos_cli'] . '">
                            <input type="hidden"   name="correo" value="' . $rows['correo_cli'] . '">
                            <input type="hidden"   name="telefono" value="' . $rows['telefono_cli'] . '">
                            <input type="hidden"   name="profesion" value="' . $rows['profesion_cli'] . '">
                            <input type="hidden"   name="grado" value="' . $rows['grado_cli'] . '">
                            <input type="hidden"   name="pais" value="' . $rows['pais_cli'] . '">
                            <input type="hidden"   name="departamento" value="' . $rows['departamento_cli'] . '">
                            <input type="hidden"   name="distrito" value="' . $rows['distrito_cli'] . '">
                            <input type="hidden"   name="direccion" value="' . $rows['direccion_cli'] . '">
                            <input type="hidden"   name="dni" value="' . $rows['dni_cli'] . '">
                            <input type="hidden"   name="fechanacimiento" value="' . $rows['fechanacimiento_cli'] . '">
                            <input type="hidden"   name="alumno" value="' . $rows['alumno_cli'] . '">
                            <input type="hidden"   name="detalle" value="' . $rows['detalle_cli'] . '">
                    ';

                if (preg_match('/[A-Za-z]+/', $rows['dni_cli']) || empty($rows['dni_cli'])) {

                    $table .= '  
                        <p class="btn btn-warning">
                            DNI INCORRECTO
                        </p>';
                } else {
                    $table .= '   <button type="submit" name="matricular" class="btn btn-danger">
                            <i class="fa fa-drivers-license-o"></i> Matricular
                        </button>';
                }
                $table .= '  
                    </form>
                </td>
            </tr>

       

                ';
            }
        }
        return $table;
    }

    public function detalle_cliente_prematri($codigocliente)
    {
        $table = "";
        $conexion = mainModel::conectar();

        $datos = $conexion->query("
            SELECT * FROM cliente WHERE codigocliente='$codigocliente'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {


            $table .= '
                <div class="col-md-8">
                    <h3 class=" text-primary mb-2">Cliente : ' . $rows['nombres_cli'] . ' &nbsp; ' . $rows['apellidos_cli'] . '</h3>
                </div>

                 <div class="col-md-4">
                    <div class="btn-group dropdown float-right">
                        <a href="<?php SERVERURL;?>editarcliente">
                            <button type="button" class="btn btn-warning btn-sm" aria-haspopup="true"
                                    aria-expanded="false">
                                Editar(En proceso)
                            </button>
                        </a>
                    </div>
                </div>

                </div>



                <hr>

        
                ';


            $table .= '
                <!--infomacion del contacto-->
                <div class="row">
                    <div class="col-md-3">
                    <address class="">

                    <p class="font-weight-bold">
                            Siglas
                        </p>
                        <p class="mb-2">
                            ' . $rows['siglas'] . '
                        </p>
                   
                        <p class="font-weight-bold">
                            Correo
                        </p>
                        <p class="mb-2">
                            ' . $rows['correo_cli'] . '
                        </p>
                        <p class="font-weight-bold">
                            Telefono
                        </p>
                        <p>
                            ' . $rows['telefono_cli'] . '
                        </p>
                    </address>
                </div>
                ';

            $table .= '<div class="col-md-3">
                <address class="">
                    <p class="font-weight-bold">
                        Profesión
                    </p>
                    <p class="mb-2">
                        ' . $rows['profesion_cli'] . '
                    </p>
                    <p class="font-weight-bold">
                        Grado
                    </p>
                    <p>
                        ' . $rows['grado_cli'] . '
                    </p>
                </address>
            </div>';

            $table .= '
                
                <div class="col-md-3">
                <address class="">
                    <p class="font-weight-bold">
                        Pais
                    </p>
                    <p class="mb-2">
                        Perú
                    </p>
                    <p class="font-weight-bold">
                        Departamento
                    </p>
                    <p>
                        ' . $rows['departamento_cli'] . '
                    </p>
                </address>
            </div>';
            $table .= '
                <div class="col-md-3">
                <address class="">
                    <p class="font-weight-bold">
                        Distrito
                    </p>
                    <p class="mb-2">
                    ' . $rows['distrito_cli'] . '
                    </p>
                    <p class="font-weight-bold">
                        Direccion
                    </p>
                    <p>
                    ' . $rows['direccion_cli'] . '
                    </p>
                </address>
            </div>
            </div>';
        }

        return $table;
    }


    public function leer_cliente_matriculado_controlador()
    {
        $table = "";
        $conexion = mainModel::conectar();

        $datoscli = $conexion->query("
            SELECT COUNT(*) as totalcli FROM interes WHERE idestado=7 and fincurso>curdate()");
        $datoscli = $datoscli->fetchAll();
        foreach ($datoscli as $rowscli) {
            $totalcli = $rowscli['totalcli'];
        }

        $table .= '  
            <h4 class="text-primary"> <i class="fa fa-child text-primary icon-lg"></i> Total de clientes  : ' . $totalcli . '</h4>
            <hr>
                <div class="table-responsive">
                <table class="table table-hover" id="bootstrap-data-table"
            class="table table-striped table-bordered">
                <thead class="bg bg-primary text-white">
                    <tr>
                        <th>Codigo</th>
                        <th>Curso</th>
                        <th>Nombre</th>
                     
                        
                         <th>Detalle</th>
                         <th>Descripcion</th>
                       
                    </tr>
                </thead>
                <tbody>
                ';
        $datosclinte = $conexion->query("
            SELECT idinteres,codigocliente,descri_estado, idespecialidad FROM interes WHERE idestado=7 and fincurso>curdate()");
        $datosclinte = $datosclinte->fetchAll();
        foreach ($datosclinte as $rowscliente) {
            $idinteres = $rowscliente['idinteres'];
            $idcliente = $rowscliente['codigocliente'];
            $descri_estado = $rowscliente['descri_estado'];
            $codigocurso = $rowscliente['idespecialidad'];

            $datoscurso = $conexion->query("
            SELECT nombre_es FROM especialidad WHERE idespecialidad=$codigocurso");
            $datoscurso = $datoscurso->fetchAll();
            foreach ($datoscurso as $rowscurso) {
                $nombrecurso = $rowscurso['nombre_es'];
            }

            $datos = $conexion->query("
            SELECT * FROM cliente WHERE codigocliente='$idcliente'");
            $datos = $datos->fetchAll();
            foreach ($datos as $rows) {
                $table .= '
                <tr>
                <td>' . $rows['codigocliente'] . '</td>
                <td>' . $nombrecurso . '</td>
                <td>' . $rows['nombres_cli'] . ' ' . $rows['apellidos_cli'] . '</td>
                
            
                
                <td>
                    <button type="button" class="btn btn-inverse-dark" aria-haspopup="true" aria-expanded="false"
                        data-toggle="modal" data-target="#' . $rows['codigocliente'] . '">
                        <i class="fa fa-drivers-license-o"></i> Ver
                    </button>
                </td>


                <td>
                    ' . $descri_estado . '
                 </td>
              
              
         
                
            </tr>

            <!--DETALLE-->  
            <div class="modal fade" id="' . $rows['codigocliente'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <!--Header-->
                  <div class="modal-header bg-dark">
                      <h4 class="text-light text-center"> <i class="fa fa-child text-white icon-lg"></i> Cliente: &nbsp;' . $rows['nombres_cli'] . '</h4>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="text-white">×</span>
                      </button>
                  </div>

                  <!--Body-->
                  <div class="modal-body">
                      <div class="card">
                      <div class="card-body">
                          <div class="row">
                          <div class="col-md-6">
                              <address class="">
                              <p class="font-weight-bold">
                              Nombres
                              </p>
                              <p class="mb-2">
                              ' . $rows['nombres_cli'] . ' &nbsp; ' . $rows['apellidos_cli'] . '
                              </p>
                              <p class="font-weight-bold">
                                  Correo
                              </p>
                              <p>
                              ' . $rows['correo_cli'] . '
                              </p>
                              </address>
                          </div>


                          <div class="col-md-6">
                              <address class="">
                              <p class="font-weight-bold">
                             Teléfono
                              </p>
                              <p class="mb-2">
                              ' . $rows['telefono_cli'] . '
                              </p>
                              <p class="font-weight-bold">
                                  Profesion
                              </p>
                              <p>
                              ' . $rows['profesion_cli'] . '
                              </p>
                              </address>
                          </div>

                          <div class="col-md-6">
                                <address class="">
                                <p class="font-weight-bold">
                                Grado
                                </p>
                                <p class="mb-2">
                                ' . $rows['grado_cli'] . '
                                </p>
                                <p class="font-weight-bold">
                                   Departamento
                                </p>
                                <p>
                                ' . $rows['departamento_cli'] . '
                                </p>
                                </address>
                            </div> 
                            
                            <div class="col-md-6">
                                <address class="">
                                <p class="font-weight-bold">
                                Distrito
                                </p>
                                <p class="mb-2">
                                ' . $rows['distrito_cli'] . '
                                </p>
                                <p class="font-weight-bold">
                                Direccion
                                </p>
                                <p>
                                ' . $rows['direccion_cli'] . '
                                </p>
                                </address>
                            </div>   
                          </div>
                      </div>
                      </div>
                  </div>
                  </div>
              </div>
           </div>
           <!--FINDETALLE--> 

                ';
            }
        }
        return $table;
    }
    public function leer_cliente_controlador()
    {
        $table = "";
        $conexion = mainModel::conectar();

        $datoscli = $conexion->query("
            SELECT COUNT(*) as totalcli FROM cliente where fincurso>curdate() ");
        $datoscli = $datoscli->fetchAll();
        foreach ($datoscli as $rowscli) {
            $totalcli = $rowscli['totalcli'];
        }

        $table .= '  
            <h4 class="text-primary"> <i class="fa fa-child text-primary icon-lg"></i> Total de clientes  : ' . $totalcli . '</h4>
            <hr>
                <div class="table-responsive">
                <table class="table table-hover" id="bootstrap-data-table"
            class="table table-striped table-bordered">
                <thead class="bg bg-primary text-white">
                    <tr>
                        <th>Codigo</th>
                        <th>Nombres y Apellidos</th>
                       
                        <th>Correo</th>
                      
                        <th>Celular</th>
                        <th>Departamento</th>
                        <th>Profesión</th>
                         <th>Fecha de registro</th>
                      
                    </tr>
                </thead>
                <tbody>
                ';

        $datos = $conexion->query("
            SELECT * FROM cliente where fincurso>curdate() ORDER BY fecha_registro DESC");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $table .= '
                <tr>
                <td>' . $rows['codigocliente'] . '</td>
                <td>' . $rows['nombres_cli'] . ' ' . $rows['apellidos_cli'] . '</td>
           
                <td>' . $rows['correo_cli'] . '</td>
                
                <td>' . $rows['telefono_cli'] . '</td>
                <td>' . $rows['departamento_cli'] . '</td>
                <td>' . $rows['profesion_cli'] . '</td>
                <td>' . $rows['fecha_registro'] . '</td>
               
            </tr>

      

                ';
        }
        return $table;
    }

    public function ver_certificado_controlador($datoss)
    {

        $codigo = mainModel::decryption($datoss);
        $codigoalumno = 0;

        $table = "";
        $conexion = mainModel::conectar();

        $datos = $conexion->query("
            SELECT * FROM detalle_certificado WHERE iddetalle_certificado=$codigo");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {



            $table .= '
                ';
        }
        return $table;
    }


    public function ver_curso__grupo_controlador($datoss)
    {

        $codigo = $datoss;
        $codigoalumno = 0;
        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
            SELECT nombre_es FROM especialidad WHERE idespecialidad=$codigo");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $table .= '' . $rows['nombre_es'] . '';
        }

        $table .= '
            <div class="btn-group dropdown float-right">
                    <a href="' . SERVERURL . 'agregaralumno/' . mainModel::encryption($codigo) . '" class="btn btn-success  btn-sm">
                          <i class="fa fa-plus"></i> Certificado
                    </a>

                    <a href="' . SERVERURL . 'agregaralumnotaller/' . mainModel::encryption($codigo) . '" class="btn btn-warning  btn-sm">
                    <i class="fa fa-plus"></i> Taller
              </a>
            </div>
            ';
        return $table;
    }

    public function nombre_curso_certificado($datoss)
    {

        $codigo = $datoss;      
        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
            SELECT nombre_es FROM especialidad WHERE idespecialidad=$codigo");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $table .= '' . $rows['nombre_es'] . '';
        }       
        return $table;
    }

    public function alumno_grupo_controlador($datoss)
    {

        $codigo = $datoss;    
      
        $table = "";
        $conexion = mainModel::conectar();

        $datos = $conexion->query("
        SELECT 
        alumno.idalumno,
        alumno.nombres_al,
        alumno.apellidos_al,
        alumno.dni_al,
        detalle_certificado.nota,
        detalle_certificado.iddetalle_certificado  
        FROM detalle_certificado
        INNER JOIN alumno
        ON alumno.codigoalumno=detalle_certificado.codigoalumno  
        WHERE idespecialidad = $codigo     
        ORDER BY detalle_certificado.estado ASC");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {       
         $table .= '
                <tr>
                    <td>
                        <a href="' . SERVERURL . 'certificadoscersa/certificado.php?registro=' . mainModel::encryption($rows['iddetalle_certificado']) . '" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                    </td>
                 
                    <td>' . $rows['dni_al'] . '</td>
                    <td> ' .$rows['nombres_al'].'  ' .$rows['apellidos_al'].' </td> 
                    <td >' .$rows['nota'] . '<td>
                    <td>
                        <a href="' . SERVERURL . 'editaralumno/' . mainModel::encryption($rows['idalumno']) . '" class="btn btn-warning btn-sm"><i class="fa fa-pencil" title="informacion "></i></a>
                    </td>
                    <td>
                        <a href="' . SERVERURL . 'editarcertificado/' . mainModel::encryption($rows['iddetalle_certificado']) . '" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                    </td>
                    <td>
                        <form class="forms-sample" method="POST" action="' . SERVERURL . 'ajax/clienteAjax.php">
                            <input type="hidden" class="form-control" name="idcertificado" id="idcertificado" value="' . $rows['iddetalle_certificado'] . '">    
                             <button type="submit" name="eliminar_certificado" class="btn btn-danger mr-2"><i class="fa fa-trash"></i></button>                     
                        </form>
                    </td>
                              
                </tr>

                ';
            
        }
        return $table;
    }
    public function eliminar_certificado_controlador(){

        $idcertificado = mainModel::limpiar_cadena($_POST['idcertificado']);     


        $DatosCertificado = [
            "idcertificado" => $idcertificado,           

        ];
        $eliminarCertificado = clienteModelo::eliminar_certificado_modelo($DatosCertificado);
        if ($eliminarCertificado == 1) {
            $direccion = "<script>javascript:history.back(-1);</script>";
            echo $direccion;
            // header('location:'.$direccion);
        }
    }

    public function alumnos_lista($dato_unos,$dato_dos)
    {

        $codigo = $dato_unos;
        $codigo_dos = $dato_dos;
        $codigoalumno = 0;
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $conexion = mainModel::conectar();



        $table .= ' 
         
                ';
                


        $datos = $conexion->query("
            SELECT * FROM matricula 
             WHERE codigocurso=$codigo 
             and estado='1' 
             and tipo_curso='0'
             and grupo='$codigo_dos'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $codigoInicial = 1;
            $codigoalumno = $rows['codigoalumno'];   

            $datosalumno = $conexion->query("
            SELECT * FROM alumno WHERE codigoalumno='$codigoalumno' AND  estado_alumno=0");
            $datosalumno = $datosalumno->fetchAll();
            foreach ($datosalumno as $rowsalumno) {
                $idalumno=$rowsalumno['idalumno'];
                $contadorhorario=0;
                $contador_asistencia=0;

                  //horarios del curso
                    $datos_horario = $conexion->query("
                    SELECT  id FROM horario  WHERE 
                    idcurso=$codigo and 
                    estado='1' and 
                    grupo='$codigo_dos'

                    ");
                    $datos_horario = $datos_horario->fetchAll();
                    //datos de asistencia
                    foreach ($datos_horario as $rowshorario) {
                        $contadorhorario++;
                        $idhorario=$rowshorario['id'];                         
                        
                        $datos_asistencia = $conexion->query("
                        SELECT  * FROM asistencia  WHERE 
                        idhorario='$idhorario' and 
                        idalumno='$idalumno' and 
                        estado='1'    
                        LIMIT 1
                        ");
                        $datos_asistencia = $datos_asistencia->fetchAll();
                        foreach ($datos_asistencia as $rowsasistencia) {   

                            $contador_asistencia++;
                        }
                        
                        
                    }
                   




                $porcentaje=0;
                $codigoInicial = $codigoInicial++;
                if($contadorhorario!=0){
                    $porcentaje=($contador_asistencia*100)/$contadorhorario;
                }
                

                $table .= '
                <tr>
                <td><a href="' . SERVERURL . 'asistencia/' .mainModel::encryption($rowsalumno['codigoalumno']) . '/' .mainModel::encryption($codigo) . '/' .mainModel::encryption($codigo_dos) . '" class="btn btn-warning btn-sm" target="_blank"><i class="menu-icon  fa fa-cubes"></i></a></td>
             
                <td>'. $rowsalumno['dni_al'] .' - ' . $rowsalumno['codigoalumno'] . '</td>     
               </td>
                 
                     <td>   
                    ' . ucwords(strtolower($rowsalumno['nombres_al'])). ' ' .ucwords(strtolower ($rowsalumno['apellidos_al'])). ' 
                      
                    </p>
                    </td>
                    <td>
                    
                    <div class="progress">
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" 
                        style="width: '.$porcentaje.'%" aria-valuenow="'. $contador_asistencia.'" aria-valuemin="0" 
                        aria-valuemax="'. $contadorhorario.'">
                        </div>
                    </div>
                    <br>
                    
                    '.round($porcentaje).'% - '.$contador_asistencia.'/ '. $contadorhorario.'</td>
                  
                    ';
             
                $table .= '
                   
                                   
                </tr>

                ';
            }
        }
        return $table;
    }
   
    public function alumnos_lista_control($dato_unos,$dato_dos)
    {

        $codigo = $dato_unos;
        $codigo_dos = $dato_dos;
        $codigoalumno = 0;
        $nombre_es="";
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $conexion = mainModel::conectar();

        $d = $conexion->query("
        SELECT nombre_es FROM especialidad 
         WHERE idespecialidad=$codigo         
        ");
        $d = $d->fetchAll();
        foreach ($d as $rows) {
            $nombre_es=$rows['nombre_es'];
        }

        $table .= ' 
        <h3>'.$nombre_es.' </h3>
        <div class="table-responsive mt-4">
        <div class="table-responsive">
            <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead class="bg bg-primary text-white">
                    <tr>
                        <th>Ver</th>    
                        <th>DNI - Codigo</th>
                                             
                        <th>Nombres Completo</th>    
                        <th>Asistencia</th>  
                      
                                                              
                                                                   
                    </tr>
                </thead>
                <tbody>
                ';
                


        $datos = $conexion->query("
            SELECT * FROM matricula 
             WHERE codigocurso=$codigo 
             and estado='1' 
             and tipo_curso='0'
             and grupo='$codigo_dos'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $codigoInicial = 1;
            $codigoalumno = $rows['codigoalumno'];   

            $datosalumno = $conexion->query("
            SELECT * FROM alumno WHERE codigoalumno='$codigoalumno' AND  estado_alumno=0");
            $datosalumno = $datosalumno->fetchAll();
            foreach ($datosalumno as $rowsalumno) {
                $idalumno=$rowsalumno['idalumno'];
                $contadorhorario=0;
                $contador_asistencia=0;

                  //horarios del curso
                    $datos_horario = $conexion->query("
                    SELECT  id FROM horario  WHERE 
                    idcurso=$codigo and 
                    estado='1' and 
                    grupo='$codigo_dos'

                    ");
                    $datos_horario = $datos_horario->fetchAll();
                    //datos de asistencia
                    foreach ($datos_horario as $rowshorario) {
                        $contadorhorario++;
                        $idhorario=$rowshorario['id'];                         
                        
                        $datos_asistencia = $conexion->query("
                        SELECT  * FROM asistencia  WHERE 
                        idhorario='$idhorario' and 
                        idalumno='$idalumno' and 
                        estado='1'    
                        LIMIT 1
                        ");
                        $datos_asistencia = $datos_asistencia->fetchAll();
                        foreach ($datos_asistencia as $rowsasistencia) {   

                            $contador_asistencia++;
                        }
                        
                        
                    }
                   




                $porcentaje=0;
                $codigoInicial = $codigoInicial++;
                if($contadorhorario!=0){
                    $porcentaje=($contador_asistencia*100)/$contadorhorario;
                }
                

                $table .= '
                <tr>
                <td><a href="' . SERVERURL . 'asistencia/' .mainModel::encryption($rowsalumno['codigoalumno']) . '/' .mainModel::encryption($codigo) . '/' .mainModel::encryption($codigo_dos) . '" class="btn btn-warning btn-sm" target="_blank"><i class="menu-icon  fa fa-cubes"></i></a></td>
             
                <td>'. $rowsalumno['dni_al'] .' - ' . $rowsalumno['codigoalumno'] . '</td>     
               </td>
                 
                     <td>   
                    ' . ucwords(strtolower($rowsalumno['nombres_al'])). ' ' .ucwords(strtolower ($rowsalumno['apellidos_al'])). ' 
                      
                    </p>
                    </td>
                    <td>
                    
                    <div class="progress">
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" 
                        style="width: '.$porcentaje.'%" aria-valuenow="'. $contador_asistencia.'" aria-valuemin="0" 
                        aria-valuemax="'. $contadorhorario.'">
                        </div>
                    </div>
                    <br>
                    
                    '.round($porcentaje).'% - '.$contador_asistencia.'/ '. $contadorhorario.'</td>
                  
                    ';
             
                $table .= '
                   
                                   
                </tr>

                ';
            }
        }
        return $table;
    }
   
    public function alumnos_lista_2($dato_unos,$dato_dos,$dato_tres)
    {

        $codigo = $dato_unos;
        $codigo_dos = $dato_dos;
        $codigo_tres = $dato_tres;
        $codigoalumno = 0;
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $conexion = mainModel::conectar();



        $table .= '  
                ';

        $datos = $conexion->query("
            SELECT * FROM matricula 
             WHERE codigocurso=$codigo 
             and estado='1' 
             and tipo_curso='0'
             and grupo='$codigo_dos'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $codigoInicial = 1;
            $codigoalumno = $rows['codigoalumno'];   

            $datosalumno = $conexion->query("
            SELECT * FROM alumno WHERE codigoalumno='$codigoalumno' AND  estado_alumno=0");
            $datosalumno = $datosalumno->fetchAll();
            foreach ($datosalumno as $rowsalumno) {
                $idalumno=$rowsalumno['idalumno'];
                $contadorhorario=0;
                $contador_asistencia=0;

                  //horarios del curso
                    $datos_horario = $conexion->query("
                    SELECT  id FROM horario  WHERE 
                    idcurso=$codigo and 
                    estado='1' and 
                    grupo='$codigo_dos'

                    ");
                    $datos_horario = $datos_horario->fetchAll();
                    //datos de asistencia
                    foreach ($datos_horario as $rowshorario) {
                        $contadorhorario++;
                        $idhorario=$rowshorario['id'];                         
                        
                        $datos_asistencia = $conexion->query("
                        SELECT  * FROM asistencia  WHERE 
                        idhorario='$idhorario' and 
                        idalumno='$idalumno' and 
                        estado='1'    
                        LIMIT 1
                        ");
                        $datos_asistencia = $datos_asistencia->fetchAll();
                        foreach ($datos_asistencia as $rowsasistencia) {   

                            $contador_asistencia++;
                        }
                        
                        
                    }
                   




                $porcentaje=0;
                $codigoInicial = $codigoInicial++;
                if($contadorhorario!=0){
                    $porcentaje=($contador_asistencia*100)/$contadorhorario;
                }
                

                $table .= '
                <tr>
                    <td>
                    
                        <form  method="post" action="'. SERVERURL.'ajax/matriculaAjax.php">                            
                            <input type="hidden" value="'.$rowsalumno['idalumno'] .'" name="idalumno" id="idalumno">
                            <input type="hidden" value="'.$codigo.'" name="idcurso" id="idcurso">
                            <input type="hidden" value="'.$codigo_dos.'" name="grupo" id="grupo">
                            <input type="hidden" value="'.$codigo_tres.'" name="idhorario" id="idhorario">
                            <button class="btn btn-danger" name="activar_asistencia_2" id="activar_asistencia_2">MARCAR</button>  
                        </form> 
                    </td>                           

                    <td><a href="' . SERVERURL . 'asistencia/' .mainModel::encryption($rowsalumno['codigoalumno']) . '/' .mainModel::encryption($codigo) . '/' .mainModel::encryption($codigo_dos) . '" class="btn btn-warning btn-sm" target="_blank"><i class="menu-icon  fa fa-cubes"></i></a></td>
                
                    <td>'. $rowsalumno['dni_al'] .' - ' . $rowsalumno['codigoalumno'] . '</td>     
                    </td>
                    
                        <td>   
                        ' . ucwords(strtolower($rowsalumno['nombres_al'])). ' ' .ucwords(strtolower ($rowsalumno['apellidos_al'])). ' 
                        
                        </p>
                        </td>
                        <td>   
                        ' .$rowsalumno['correo_al']. '
                        
                      
                        </td>
                        <td>
                        
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" 
                            style="width: '.$porcentaje.'%" aria-valuenow="'. $contador_asistencia.'" aria-valuemin="0" 
                            aria-valuemax="'. $contadorhorario.'">
                            </div>
                        </div>
                        <br>
                        
                        '.round($porcentaje).'% - '.$contador_asistencia.'/ '. $contadorhorario.'</td>
                    
                        ';
                
                    $table .= '
                   
                                   
                </tr>

                ';
            }
        }
        return $table;
    }
    public function sesiones_horario($dato_unos,$dato_dos)    {

        $codigo = $dato_unos;
        $codigo_dos = $dato_dos;
 
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $contador=0;
        $conexion = mainModel::conectar();




        $datos = $conexion->query("
            SELECT * FROM horario  WHERE idcurso=$codigo and  grupo='$codigo_dos' order by fecha  asc");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {  
            $contador++;       
         

                $table .= '
                <tr>
            
                     <td>' . $contador.'</td>
                     <form  method="post" action="'. SERVERURL.'ajax/matriculaAjax.php">
                        <td>
                        <input type="hidden" value="'.$rows['id'] .'" name="idh" id="idh">
                        <input type="hidden" value="'.$codigo.'" name="curso" id="curso">
                            <input type="hidden" value="'.$codigo_dos.'" name="grupo" id="grupo">
                            <input type="date" value="'.$rows['fecha'].'"  name="fecha" id="fecha">                    
                        </td>
                        <td>
                            <input type="time" value="'.$rows['hora_inicio'].'"  name="hora_inicio" id="hora_inicio">                    
                        </td>
                        <td>
                            <input type="time" value="'.$rows['hora_fin'].'"  name="hora_fin" id="hora_fin">                    
                        </td>
                    
                        <td>  <button class="btn btn-warning" name="editar_sesion_horario" id="editar_sesion_horario">Editar</button> </td>
                        <td>  <button class="btn btn-danger" name="eliminar_sesion_horario" id="eliminar_sesion_horario">Eliminar</button>   </td>
                    </form>
                   
                </tr>
                    ';
                        
             

            
        }
        return $table;
    }
    public function sesiones_horario_actualizado($dato_unos,$dato_dos)    {

        $codigo = $dato_unos;
        $codigo_dos = $dato_dos;
 
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $contador=0;
        $conexion = mainModel::conectar();




        $datos = $conexion->query("
            SELECT * FROM horario  WHERE idcurso=$codigo and  grupo='$codigo_dos' order by fecha  asc");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {  
            $contador++;       
         

                $table .= '
                <tr>
            
                     <td>' . $contador.'</td>
                     <form  method="post" action="'. SERVERURL.'ajax/matriculaAjax.php">
                        <td>
                        <input type="hidden" value="'.$rows['id'] .'" name="idh" id="idh">
                        <input type="hidden" value="'.$codigo.'" name="curso" id="curso">
                            <input type="hidden" value="'.$codigo_dos.'" name="grupo" id="grupo">
                            <input type="date" value="'.$rows['fecha'].'"  name="fecha" id="fecha">                    
                        </td>
                        <td>
                            <input type="time" value="'.$rows['hora_inicio'].'"  name="hora_inicio" id="hora_inicio">                    
                        </td>
                        <td>
                            <input type="time" value="'.$rows['hora_fin'].'"  name="hora_fin" id="hora_fin">                    
                        </td>
                    
                        <td>  <button class="btn btn-warning" name="editar_sesion_horario" id="editar_sesion_horario">Editar</button> </td>
                        <td>  <button class="btn btn-danger" name="eliminar_sesion_horario" id="eliminar_sesion_horario">Eliminar</button>   </td>
                        <td>  <a  href="'.SERVERURL.'alumnoslistasmarcar/'.$codigo.'/'.$codigo_dos.'/'.$rows['id'].'" class="btn btn-info" name="eliminar_sesion_horario" id="eliminar_sesion_horario">Marcar</a>   </td>
                    </form>
                   
                </tr>
                    ';
                        
             

            
        }
        return $table;
    }
    public function nombre_curso($datoss)
    {

        $codigo = $datoss;
        $codigoalumno = 0;
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $conexion = mainModel::conectar();



        $table .= '  
                ';

        $datos = $conexion->query("
            SELECT * FROM especialidad  WHERE idespecialidad=$codigo");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            
          
      
        return $rows['codigo_curso'].': '.$rows['nombre_es'];
    }
    } 
    public function grupos_cursos_alumnos($datoss)
    {

        $codigo = $datoss;
        $codigoalumno = 0;
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $conexion = mainModel::conectar();



        $table .= '  
                ';

        $datos = $conexion->query("
            SELECT * FROM especialidad  WHERE idespecialidad=$codigo");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $grupo = $rows['grupo'];
       
            for ($i = 0; $i <= $grupo; $i++) {
                $table .= '
                <tr>
                   
                   <td> <a href="'.SERVERURL.'alumnoslistas/'.$codigo.'/'.$i.'">Grupo '.$i.'</a></td>
 
                </tr>
           
                ';
            }
          
        }
        return $table;
    }
    public function grupos_cursos_alumnos_control($datoss)
    {

        $codigo = $datoss;
        $codigoalumno = 0;
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $conexion = mainModel::conectar();



        $table .= '  
                ';

        $datos = $conexion->query("
            SELECT * FROM especialidad  WHERE idespecialidad=$codigo");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $grupo = $rows['grupo'];
       
            for ($i = 0; $i <= $grupo; $i++) {
                $table .= '
                <h3> '.$rows['nombre_es'].'</h3>
                <div class="table-responsive mt-4">
                    <div class="table-responsive">
                        <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead class="bg bg-primary text-white">
                                <tr>
                                    <th>Grupo</th> 
                                                        
                                </tr>
                            </thead>
                            <tbody>
                            <tr>                   
                            <td> <a href="'.SERVERURL.'control/'.$codigo.'/'.$i.'">Grupo '.$i.'</a></td> 
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
           
                ';
            }
          
        }
        return $table;
    }
    public function alumno_total_controlador()
    {


        $codigoalumno = 0;
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $conexion = mainModel::conectar();

        $contador = 0;

        $datoscer = $conexion->query("
                SELECT * FROM detalle_certificado ORDER BY codigo_detalle desc");
        $datoscer = $datoscer->fetchAll();
        foreach ($datoscer as $rowscer) {
            $idalumno = $rowscer['codigoalumno'];
            $idespecialidad = $rowscer['idespecialidad'];
            $contador++;

            $codigoalumno = $rowscer['codigoalumno'];
            $fechainicio = $rowscer['fecha_inicio'];
            $fechainicio = strftime("%d de %B del %Y", strtotime($fechainicio));
            $fechaifin = $rowscer['fecha_fin'];
            $fechaifin = strftime("%d de %B del %Y", strtotime($fechaifin));
            $fechaiemision = $rowscer['fecha_emision'];
            $fechaiemision = strftime("%d de %B del %Y", strtotime($fechaiemision));
            $nota = $rowscer['nota'];
            $horas = $rowscer['horas_pedagogicas'];



            $datosal = $conexion->query("
                    SELECT * FROM alumno WHERE codigoalumno='$idalumno'");
            $datosal = $datosal->fetchAll();
            foreach ($datosal as $rowsal) {
                $dni = $rowsal['dni_al'];
                $nombre = $rowsal['siglas'] . " " . $rowsal['nombres_al'] . " " . $rowsal['apellidos_al'];
            }
            $datosEs = $conexion->query("
                    SELECT * FROM especialidad WHERE idespecialidad='$idespecialidad'");
            $datosEs = $datosEs->fetchAll();
            foreach ($datosEs as $rowsEs) {
                $curso = $rowsEs['nombre_es'];
            }




            $table .= '
                <tr>
                <td><a href="' . SERVERURL . 'certificadoscersa/certificado.php?registro=' . mainModel::encryption($rowscer['iddetalle_certificado']) . '" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i></a></td>
              
               
                  
                  
                    <td>   <p><a class="tooltipjose" href="#">
                    ' . $dni . '-' . ucwords(strtolower($nombre)). '  
                        <span class="custom info"><img src="http://sistema.cersa.org.pe/vistas/images/favicon.ico" alt="Information" height="48" width="48" />
                            <em>Datos de Certificado</em>
                            Fecha Inicio&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;: &nbsp;&nbsp;' . $fechainicio . ' <br>
                            Fecha Fin &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; : &nbsp; &nbsp;' . $fechaifin . '<br>
                            Fecha de Emisión: &nbsp;&nbsp;' . $fechaiemision . '<br>
                            Horas Pedagógicas:&nbsp; &nbsp; ' . $horas . '<br>
                        </span>
                    </a></p>
                    </td>
                    
                    <td>
                    '. $curso .'
                    </td>
    
                    </tr>
                  
                    ';
        }


        return $table;
    }
    public function enviar_dni_controlador()
    {
        $dni = mainModel::limpiar_cadena($_POST['dni']);
        $variable = SERVERURL . "buscador/" . $dni;
        header('location:' . $variable);
    }

    public function buscador_curso_controlador($datoss)
    {

        $dni = mainModel::decryption($datoss);
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');


        $table = "";
        $conexion = mainModel::conectar();




        $datos = $conexion->query("
            SELECT * FROM alumno WHERE dni_al='$datoss'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $codigoalumno = $rows['codigoalumno'];
        }
        if (!empty($codigoalumno)) {
            $table .= '
            <h5 class="text-center text-dark">' . $rows['nombres_al'] . ' ' . $rows['apellidos_al'] . '</h5>
            
            
            <div class="list-group mt-4">
                
               ';

            $datos2 = $conexion->query("
            SELECT * FROM detalle_certificado WHERE codigoalumno='$codigoalumno' and estado='1' ");
            $datos2 = $datos2->fetchAll();
            foreach ($datos2 as $rows2) {
                $idcurso = $rows2['idespecialidad'];

                $datos3 = $conexion->query("
                SELECT nombre_es FROM especialidad WHERE idespecialidad='$idcurso'");
                $datos3 = $datos3->fetchAll();
                foreach ($datos3 as $rows3) { }

                $table .= '
                <a target="_blank" href="' . SERVERURL . 'certificadoscersa/certificado.php?registro=' .mainModel::encryption($rows2['iddetalle_certificado']). '" class="text-left list-group-item list-group-item-action">
                <i class="fa fa-file-pdf-o text-primary"></i>&nbsp;&nbsp; ' . $rows3['nombre_es'] . '
                
                </a>
            
  
              ';
            }
        } else {
            $table .= '   </tbody>
            </table>
                <h4 class=" text-center">No tiene certificados</h4> ';
        }
        return $table;
    }
    public function DetalleDeCertificado($datoss)
    {

        $dni = mainModel::decryption($datoss);
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');

        $table = "";
        $conexion = mainModel::conectar();
        $datos = $conexion->query("
            SELECT * FROM alumno WHERE dni_al='$datoss'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $codigoalumno = $rows['codigoalumno'];
        }
        if (!empty($codigoalumno)) {
            $table .= '
            <h5 class="text-center text-dark">' . $rows['nombres_al'] . ' ' . $rows['apellidos_al'] . '</h5>
            
            
            <div class="list-group mt-4">
                
               ';

            $datos2 = $conexion->query("
            SELECT * FROM detalle_certificado WHERE codigoalumno='$codigoalumno' and estado='1' ");
            $datos2 = $datos2->fetchAll();
            foreach ($datos2 as $rows2) {
                $idcurso = $rows2['idespecialidad'];

                $datos3 = $conexion->query("
                SELECT nombre_es FROM especialidad WHERE idespecialidad='$idcurso'");
                $datos3 = $datos3->fetchAll();
                foreach ($datos3 as $rows3) { }

                $table .= '
                <a href="' . SERVERURL . 'buscador/'.$datoss.'/'.mainModel::encryption($rows2['iddetalle_certificado']). '" class="text-left list-group-item list-group-item-action">
                <i class="fa fa-file-pdf-o text-primary"></i>&nbsp;&nbsp; ' . $rows3['nombre_es'] . '
                
                </a>
            
  
              ';
            }
        } else {
            $table .= '   </tbody>
            </table>
                <h4 class=" text-center">No tiene certificados</h4> ';
        }
        return $table;
    }
    public function DescargarCertificado($datoss,$datoscertificado)
    {

        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');
        $conexion = mainModel::conectar();
        $table= '';
        $curso='';
        $mes_emision=0;
        $ano_emision=0;
        $alumno_nombre="";
        $alumno_apellido="";
        $datoscertificado= mainModel::decryption($datoscertificado);

       $datos = $conexion->query("
       SELECT 
       detalle_certificado.codigo_detalle, 
       detalle_certificado.iddetalle_certificado, 
       especialidad.nombre_es as nombrecurso,
       MONTH(detalle_certificado.fecha_emision) as mes_emision,
       YEAR(detalle_certificado.fecha_emision) as ano_emision
       FROM `detalle_certificado`  
       INNER JOIN especialidad
       ON especialidad.idespecialidad=detalle_certificado.idespecialidad
       WHERE iddetalle_certificado='$datoscertificado' and estado='1' ");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $curso = $rows['nombrecurso'];
            $credencial = $rows['codigo_detalle'];
            $mes_emision = $rows['mes_emision'];
            $ano_emision = $rows['ano_emision'];
        }

        
        $datos = $conexion->query("
            SELECT * FROM alumno WHERE dni_al='$datoss'");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $codigoalumno = $rows['codigoalumno'];
            $alumno_nombre=$rows['nombres_al'];
            $alumno_apellido.=$rows['apellidos_al'];
           
        }

        $table .= '  
        <div class="container">

            <div class="row mt-4">

                <div class="col-md-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0 text-center">
                            <div class="col-md-4">                       
                                <img src="https://cersa.org.pe/images/logo_iso.png" alt="..." class="img-fluid rounded-start mt-4">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <h3 class="card-text">'. $alumno_nombre.' '.$alumno_apellido.'</h3>
                                    <p class="card-text"><small class="text-muted">Alumno de Cersa</small></p>
                                </div>
                            </div>
                        </div>
                    </div>               
                </div>

                <div class="col-md-6">
                    <div class="card mb-3" >
                        <div class="card-body text-center">
                            <h5 class="card-title"></h5>
                            <h3 class="card-text">'.$curso.'</h3>
                            <h4 class="text-muted"> <small> ID DE CREDENCIAL : '.mainModel::encryption($datoscertificado).'<small></h4>
                            <h4 class="text-muted"> <small> CODIGO CERTIFICADO : '.($credencial).'<small></h4>
                        </div>                   
                    </div>               
                </div>
             

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3" >
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 class="">¡Muchas felicidades! <br> Comparte tus logros con tu familia, amigos, empleadores y la comunidad.
                                    </h3>
                                    <p class="card-text"><small class="text-muted">Cersa contigo en tu desarrollo</small></p>
                                    <div class="d-grid gap-2 ">
                                        <a class="btn btn-outline-secondary btn-lg col-md-12" href="' . SERVERURL . 'certificadoscersa/certificado.php?registro=' .mainModel::encryption($datoscertificado). '" target="_bank> <i class="fa fa-file-pdf-o text-primary"></i><span style="font-size: 15px; color:black"><i class="fa fa-file-pdf-o text-primary"></i>Descargar Diploma/Certificado</span></a>
                                        
                                    </div>
                                    <div class="mt-4">
                                        <h4>Compartir en : </h4>
                                        <hr>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="https://www.linkedin.com/in/joseramiq/edit/forms/certification/new/?certId='.mainModel::encryption($datoscertificado). '&certUrl=https://sistema.cersa.org.pe/buscador/'.$datoss . '/'.mainModel::encryption($datoscertificado) . '&isFromA2p=true&issueMonth='.$mes_emision.'&issueYear='.$ano_emision.'&name='.$curso.'&organizationId=23514547" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light"><img src="https://cersa.org.pe/images/linkedin.png"/ width="30px"></a>
                                            <a href="https://twitter.com/intent/tweet/?hashtags=Cersa&text=%C2%A1Aprob%C3%A9%20'.$curso.'%20en%20%20el%20@InstitutoCersa!%20https://sistema.cersa.org.pe/buscador/'.$datoss . '/'.mainModel::encryption($datoscertificado) . '" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light"><img src="https://cersa.org.pe/images/twitter.png"/ width="30px"></a>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://sistema.cersa.org.pe/buscador/'.$datoss . '/'.mainModel::encryption($datoscertificado) . '" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light"><img src="https://cersa.org.pe/images/facebook.png"/ width="30px"></a>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-4">                            
                                <img src="https://sistema.cersa.org.pe/vistas/images/certificado.png" class="img-fluid rounded-start" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           

        </div>  ';

      
        return $table;
    }
    public function estados_cliente_controlador()
    {
        $table = "";

        $conexion = mainModel::conectar();

        //selecionados todos los estados
        $datos = $conexion->query("
            SELECT * FROM estado where estado_actual=1");
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            $idestado = $rows['idestado'];

            //contamos todos los intereses en el id que me pasan
            $datosinteres = $conexion->query("
                SELECT COUNT(*) as intereses FROM interes WHERE idestado=$idestado ");
            $datosinteres = $datosinteres->fetchAll();
            foreach ($datosinteres as $datosinteres) {
                $numerointeresados = $datosinteres['intereses'];
            }
            $table .= '
                <div class="col-md-2" badge style="background-color:' . $rows['color'] . '" >
                    <div class="wrapper d-flex justify-content-between">
                        <div class="side-left">
                        <p class="mb-2">' . $rows['nombre_estado'] . '</p>
                        <p class="display-3 mb-4 font-weight-light">' . $numerointeresados . '</p>
                        </div>
        
                    </div>
                </div>
                ';
        }
        return $table;
    }
}
