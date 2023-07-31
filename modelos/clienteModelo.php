<?php

if ($peticionAjax) {

    require_once('../core/mainModel.php');

} else {

    require_once('./core/mainModel.php');

}



class clienteModelo  extends mainModel{

    protected function agregar_cliente_modelo($datos){

   

        $sql=self::conectar()->prepare("INSERT INTO 

         cliente(codigocliente,siglas,nombres_cli, apellidos_cli ,correo_cli, telefono_cli, 

         profesion_cli, grado_cli, pais_cli, departamento_cli, distrito_cli, direccion_cli, 

        dni_cli, fechanacimiento_cli, detalle_cli, alumno_cli, fincurso)

         VALUES(:Codigo,:Siglas, :Nombre, :Apellidos, :Correo, :Telefono, :Profesion, :Grado, :Pais, 

         :Departamento, :Distrito, :Direccion, :Dni, :Fecha, :Detalle, :Alumno, :Fincurso  )");

         

        $sql->bindParam(":Codigo",$datos['Codigo']);

        $sql->bindParam(":Siglas",$datos['Siglas']);

        $sql->bindParam(":Nombre",$datos['Nombre']);

        $sql->bindParam(":Apellidos",$datos['Apellidos']);

        $sql->bindParam(":Correo",$datos['Correo']);

        $sql->bindParam(":Telefono",$datos['Telefono']);

        $sql->bindParam(":Profesion",$datos['Profesion']);

        $sql->bindParam(":Grado",$datos['Grado']);

        $sql->bindParam(":Pais",$datos['Pais']);

        $sql->bindParam(":Departamento",$datos['Departamento']);

        $sql->bindParam(":Distrito",$datos['Distrito']);

        $sql->bindParam(":Direccion",$datos['Direccion']);



        $sql->bindParam(":Dni",$datos['Dni']);

        $sql->bindParam(":Fecha",$datos['Fecha']);

        $sql->bindParam(":Detalle",$datos['Detalle']);

        $sql->bindParam(":Alumno",$datos['Alumno']);

        $sql->bindParam(":Fincurso",$datos['Fincurso']);



        $sql->execute();

        return $sql;

    }



    protected function agregar_alumno_modelo($datos){

   

        $sql=self::conectar()->prepare("INSERT INTO 

         alumno(codigoalumno,siglas,nombres_al, apellidos_al ,correo_al, telefono_al, 

         profesion_al, grado_al,pais_al, departamento_al, distrito_al, 	direccion_al, 

         dni_al, fechanacimiento_al, detalle_al, alumno_al)

         VALUES(:Codigo,:Siglas, :Nombre, :Apellidos, :Correo, :Telefono, :Profesion, :Grado, :Pais, 

         :Departamento, :Distrito, :Direccion, :Dni, :Fecha, :Detalle, :Alumno )");

         

        $sql->bindParam(":Codigo",$datos['Codigo']);

        $sql->bindParam(":Siglas",$datos['Siglas']);

        $sql->bindParam(":Nombre",$datos['Nombre']);

        $sql->bindParam(":Apellidos",$datos['Apellidos']);

        $sql->bindParam(":Correo",$datos['Correo']);

        $sql->bindParam(":Telefono",$datos['Telefono']);

        $sql->bindParam(":Profesion",$datos['Profesion']);

        $sql->bindParam(":Grado",$datos['Grado']);

        $sql->bindParam(":Pais",$datos['Pais']);

        $sql->bindParam(":Departamento",$datos['Departamento']);

        $sql->bindParam(":Distrito",$datos['Distrito']);

        $sql->bindParam(":Direccion",$datos['Direccion']);

        $sql->bindParam(":Dni",$datos['Dni']);

        $sql->bindParam(":Fecha",$datos['Fecha']);

        $sql->bindParam(":Detalle",$datos['Detalle']);

        $sql->bindParam(":Alumno",$datos['Alumno']);

     



        $sql->execute();

        return $sql;

    }

    protected function actualizar_alumno_modelo($datos){

   

        $sql=self::conectar()->prepare("UPDATE

        alumno SET

        siglas=:Siglas,

        nombres_al=:Nombre,

        apellidos_al=:Apellidos,

        correo_al=:Correo,

        telefono_al=:Telefono, 

        profesion_al=:Profesion,

        grado_al=:Grado,

        pais_al=:Pais,

        departamento_al=:Departamento,

        distrito_al=:Distrito,

        direccion_al=:Direccion, 

        dni_al=:Dni,

        fechanacimiento_al=:Fecha,

        detalle_al=:Detalle, 

        alumno_al=:Alumno

         WHERE idalumno=:Idalumno");

         

        $sql->bindParam(":Idalumno",$datos['Idalumno']);

        $sql->bindParam(":Siglas",$datos['Siglas']);

        $sql->bindParam(":Nombre",$datos['Nombre']);

        $sql->bindParam(":Apellidos",$datos['Apellidos']);

        $sql->bindParam(":Correo",$datos['Correo']);

        $sql->bindParam(":Telefono",$datos['Telefono']);

        $sql->bindParam(":Profesion",$datos['Profesion']);

        $sql->bindParam(":Grado",$datos['Grado']);

        $sql->bindParam(":Pais",$datos['Pais']);

        $sql->bindParam(":Departamento",$datos['Departamento']);

        $sql->bindParam(":Distrito",$datos['Distrito']);

        $sql->bindParam(":Direccion",$datos['Direccion']);

        $sql->bindParam(":Dni",$datos['Dni']);

        $sql->bindParam(":Fecha",$datos['Fecha']);

        $sql->bindParam(":Detalle",$datos['Detalle']);

        $sql->bindParam(":Alumno",$datos['Alumno']);

     



        $sql->execute();

        return $sql;

    }



    protected function actualizar_cliente_modelo($datos){

   

        $sql=self::conectar()->prepare("UPDATE

         cliente SET nombres_cli=:Nombre, apellidos_cli=:Apellidos ,correo_cli=:Correo, telefono_cli=:Telefono,

          profesion_cli=:Profesion, grado_cli=:Grado, pais_cli=:Pais, departamento_cli=:Departamento, distrito_cli=:Distrito,

           direccion_cli=:Direccion, dni_cli=:Dni, fechanacimiento_cli=:Fecha, detalle_cli=:Detalle, alumno_cli=:Alumno 

           WHERE idcliente=:Idcliente");

  

        $sql->bindParam(":Idcliente",$datos['Idcliente']);

        $sql->bindParam(":Nombre",$datos['Nombre']);

        $sql->bindParam(":Apellidos",$datos['Apellidos']);

        $sql->bindParam(":Correo",$datos['Correo']);

        $sql->bindParam(":Telefono",$datos['Telefono']);

        $sql->bindParam(":Profesion",$datos['Profesion']);

        $sql->bindParam(":Grado",$datos['Grado']);

        $sql->bindParam(":Pais",$datos['Pais']);

        $sql->bindParam(":Departamento",$datos['Departamento']);

        $sql->bindParam(":Distrito",$datos['Distrito']);

        $sql->bindParam(":Direccion",$datos['Direccion']);



        $sql->bindParam(":Dni",$datos['Dni']);

        $sql->bindParam(":Fecha",$datos['Fecha']);

        $sql->bindParam(":Detalle",$datos['Detalle']);

        $sql->bindParam(":Alumno",$datos['Alumno']);



        $sql->execute();

        return $sql;

    }

   

    protected function actualizar_certificado_modelo($datos){

   

        $sql=self::conectar()->prepare("UPDATE

        detalle_certificado SET 

        fecha_inicio=:Fechainicio,

        fecha_fin=:Fechafinal,

        fecha_emision=:Fechaemision,

        horas_pedagogicas=:Horasp,

        nota=:Nota,

        estado_detalle=:Activacion

        WHERE iddetalle_certificado=:Iddetalle");

  

        $sql->bindParam(":Iddetalle",$datos['Iddetalle']);

        $sql->bindParam(":Fechainicio",$datos['Fechainicio']);

        $sql->bindParam(":Fechafinal",$datos['Fechafinal']);

        $sql->bindParam(":Fechaemision",$datos['Fechaemision']);

        $sql->bindParam(":Horasp",$datos['Horasp']);

        $sql->bindParam(":Nota",$datos['Nota']);

        $sql->bindParam(":Activacion",$datos['Activacion']);

        $sql->execute();

        $variable=1;

        return $variable;

    }
    
    protected function eliminar_certificado_modelo($datos){

   

        $sql=self::conectar()->prepare("UPDATE

        detalle_certificado SET 
        estado=0  
        WHERE iddetalle_certificado=:idcertificado");

  

        $sql->bindParam(":idcertificado",$datos['idcertificado']);     

        $sql->execute();

        $variable=1;

        return $variable;

    }
    protected function enviar_correo_certificado(){
           $variable=1;
        return $variable;

    }







    protected function matri_cliente_modelo($datos){

   

        $sql=self::conectar()->prepare("UPDATE

         interes SET idestado=:Idestado, descri_estado=:Des_interes

          WHERE idinteres=:Idinteres");

               

        $sql->bindParam(":Codigopack",$datos['Codigopack']);

        $sql->bindParam(":Codigocliente",$datos['Codigocliente']);

      



        $sql->execute();

        return $sql;

    }



    protected function agregar_interes_modelo($datos)

    {

    

        $sql=self::conectar()->prepare("INSERT INTO 

        interes(idestado, idusuario, idespecialidad,grupo, codigocliente, descri_estado, 	fecha_cambio_estado, fincurso)

        VALUES(:Estado, :Usuario, :Curso, :Grupo, :Cliente, :Descripcion, :Fecha, :Fincurso)");

        $sql->bindParam(":Estado",$datos['Estado']);

        $sql->bindParam(":Usuario",$datos['Usuario']);

        $sql->bindParam(":Curso",$datos['Curso']);
        
        $sql->bindParam(":Grupo",$datos['Grupo']);

        $sql->bindParam(":Cliente",$datos['Cliente']);

        $sql->bindParam(":Descripcion",$datos['Descripcion']);

        $fechaactual= date('Y-m-d H:i:s');

        $sql->bindParam(":Fecha",$fechaactual);

        $sql->bindParam(":Fincurso",$datos['Fincurso']);

        

        

        $sql->execute();

       // return $sql;

    }



    protected function agregar_matricula_modelo($datos)

    {

    

        $sql=self::conectar()->prepare("INSERT INTO 

        detalle_certificado(
        idespecialidad,
        codigo_detalle,
        codigoalumno,
        nota,
        fecha_inicio,
        fecha_fin,
        fecha_emision,
        horas_pedagogicas,
        estado_detalle,
        tipo,
        certicado_ladouno,
        certicado_ladodos)

        VALUES(
        :Idespecialidad,
        :Codigodetalle,
        :Codigocliente,
        :Nota,
        :FechaInicio,
        :FechaFin,
        :FechaEmision,
        :HorasCert,
        :EstadoDetalle,
        :Tipo,
        :Certificadouno,
        :Certificadodos)");

        $sql->bindParam(":Idespecialidad",$datos['Idespecialidad']);
        $sql->bindParam(":Codigodetalle",$datos['Codigodetalle']);
        $sql->bindParam(":Codigocliente",$datos['Codigocliente']);   
        $sql->bindParam(":Nota",$datos['Nota']);
        $sql->bindParam(":FechaInicio",$datos['FechaInicio']);
        $sql->bindParam(":FechaFin",$datos['FechaFin']);
        $sql->bindParam(":FechaEmision",$datos['FechaEmision']);
        $sql->bindParam(":HorasCert",$datos['HorasCert']);   
        $sql->bindParam(":Tipo",$datos['Tipo']); 
        $sql->bindParam(":EstadoDetalle",$datos['EstadoDetalle']); 
        $sql->bindParam(":Certificadouno",$datos['Certificadouno']);
        $sql->bindParam(":Certificadodos",$datos['Certificadodos']);   
        $sql->execute();

       // return $sql;

    }
    protected function agregar_matricula_taller_modelo($datos)

    {

    

        $sql=self::conectar()->prepare("INSERT INTO 

        detalle_certificado(
        idespecialidad,
        codigo_detalle,
        codigoalumno,
        nota,
        fecha_inicio,
        fecha_fin,
        fecha_emision,
        horas_pedagogicas,
        estado_detalle,
        certicado_ladouno,
        certicado_ladodos,
        tipo)

        VALUES(
        :Idespecialidad,
        :Codigodetalle,
        :Codigocliente,
        :Nota,
        :FechaInicio,
        :FechaFin,
        :FechaEmision,
        :HorasCert,
        :EstadoDetalle,
        :Certificadouno,
        :Certificadodos,
        :Tipo)
        
        ");

        $sql->bindParam(":Idespecialidad",$datos['Idespecialidad']);
        $sql->bindParam(":Codigodetalle",$datos['Codigodetalle']);
        $sql->bindParam(":Codigocliente",$datos['Codigocliente']);   
        $sql->bindParam(":Nota",$datos['Nota']);
        $sql->bindParam(":FechaInicio",$datos['FechaInicio']);
        $sql->bindParam(":FechaFin",$datos['FechaFin']);
        $sql->bindParam(":FechaEmision",$datos['FechaEmision']);
        $sql->bindParam(":HorasCert",$datos['HorasCert']);   
        $sql->bindParam(":EstadoDetalle",$datos['EstadoDetalle']); 
        $sql->bindParam(":Certificadouno",$datos['Certificadouno']);
        $sql->bindParam(":Certificadodos",$datos['Certificadodos']);   
        $sql->bindParam(":Tipo",$datos['Tipo']);
        $sql->execute();

       // return $sql;

    }



    protected function actualizar_interes_modelo_matri($codigocliente)

    {

        $sql=self::conectar()->prepare("UPDATE 

        interes SET idestado=7 WHERE codigocliente='$codigocliente'");

        $sql->execute();

       return $sql;

    }

}