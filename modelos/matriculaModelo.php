<?php

if ($peticionAjax) {

    require_once('../core/mainModel.php');

} else {

    require_once('./core/mainModel.php');

}



class matriculaModelo  extends mainModel

{
    protected function agregar_matricula_modelo($datos){

        $sql = self::conectar()->prepare(
            "INSERT INTO matricula(
                codigomatricula,
                baucher,
                tipo_curso,
            	codigousuario,
                codigocurso,
                pago,
                fechapago,
                descripcion,
                descuento,
                estado,
                grupo,
                codigoalumno)
        VALUES(
        :CodigoM,
        :Baucher,
        :Tipo_curso,
        :Usuario,
        :Idespecialidad,
        :Pago,
        :Fechapago,
        :Descripcion,
        :Descuento,
        :Estado,
        :Grupo,
        :CodigoAl)");

        $sql->bindParam(":CodigoM", $datos['CodigoM']);
        $sql->bindParam(":Baucher", $datos['Baucher']);
        $sql->bindParam(":Tipo_curso", $datos['Tipo_curso']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Idespecialidad", $datos['Idespecialidad']);
        $sql->bindParam(":Pago", $datos['Pago']);
        $sql->bindParam(":Fechapago", $datos['Fechapago']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Descuento", $datos['Descuento']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Grupo", $datos['Grupo']);
        $sql->bindParam(":CodigoAl", $datos['CodigoAl']);
        $sql->execute();
        return $sql;


    }
    protected function agregar_matricula__admin_modelo($datos){

        $sql = self::conectar()->prepare(
            "INSERT INTO matricula(
                codigomatricula,               
                tipo_curso,
            	codigousuario,
                codigocurso,               
                descripcion,              
                estado,
                grupo,
                codigoalumno)
        VALUES(
        :CodigoM,      
        :Tipo_curso,
        :Usuario,
        :Idespecialidad,       
        :Descripcion,    
        :Estado,
        :Grupo,
        :CodigoAl)");

        $sql->bindParam(":CodigoM", $datos['CodigoM']);
   
        $sql->bindParam(":Tipo_curso", $datos['Tipo_curso']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Idespecialidad", $datos['Idespecialidad']);      
        $sql->bindParam(":Descripcion", $datos['Descripcion']);    
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Grupo", $datos['Grupo']);
        $sql->bindParam(":CodigoAl", $datos['CodigoAl']);
        $sql->execute();
        return $sql;


    }
    protected function agregar_seccion($datos){

        $sql = self::conectar()->prepare(
            "INSERT INTO horario(
                fecha,               
                hora_inicio,
            	hora_fin,
                idcurso,               
                grupo,              
                estado
               )
        VALUES(
        :Fecha,      
        :Hora_inicio,
        :Hora_fin,
        :Curso,       
        :Grupo,    
        :Estado
        )");

        $sql->bindParam(":Fecha", $datos['Fecha']);
   
        $sql->bindParam(":Hora_inicio", $datos['Hora_inicio']);
        $sql->bindParam(":Hora_fin", $datos['Hora_fin']);
        $sql->bindParam(":Curso", $datos['Curso']);      
        $sql->bindParam(":Grupo", $datos['Grupo']);    
        $sql->bindParam(":Estado", $datos['Estado']);
      
        $sql->execute();
        return $sql;


    }

    protected function activar_asistencia_modelo($datos){

        $sql = self::conectar()->prepare(
            "INSERT INTO asistencia(
                idhorario,               
                idalumno,            
                estado
               )
        VALUES(
        :Idhorario,      
        :Alumno,
        :Estado
        )");

        $sql->bindParam(":Idhorario", $datos['Idhorario']);   
        $sql->bindParam(":Alumno", $datos['Alumno']);     
        $sql->bindParam(":Estado", $datos['Estado']);
      
        $sql->execute();
        return $sql;


    }
    protected function actualizar_alumno_modelo($datos){
      
        $sql=self::conectar()->prepare("UPDATE
        alumno SET 
        correo_al=:Correo,
        telefono_al=:Telefono, 
        profesion_al=:Profesion,
        grado_al=:Grado,
        pais_al=:Pais,
        departamento_al=:Departamento,
        distrito_al=:Distrito,
        direccion_al=:Direccion, 
        fechanacimiento_al=:Fecha,
        detalle_al=:Detalle,
        alumno_al=:Alumno
        WHERE  dni_al=:Dni");

       
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

    protected function atualizar_interes_modelo($datos){
        $sql=self::conectar()->prepare("UPDATE
        interes SET  
        idestado=:Estado,
        descri_estado=:Descripcion 
        WHERE idinteres=:Idinteres ");
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Idinteres", $datos['Idinteres']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
               $sql->execute();
        return $sql;
    }

    
    protected function editar_sesion_horario_modelo($datos){
        $sql=self::conectar()->prepare("UPDATE
        horario SET        
        fecha=:Fecha ,
        hora_inicio=:Hora_inicio ,
        hora_fin=:Hora_fin 
        WHERE   id=:Idh");
        $sql->bindParam(":Idh", $datos['Idh']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->bindParam(":Hora_inicio", $datos['Hora_inicio']);
        $sql->bindParam(":Hora_fin", $datos['Hora_fin']);
               $sql->execute();
        return $sql;
    }
    protected function eliminar_sesion_horario_modelo($datos){
        $sql=self::conectar()->prepare("DELETE FROM horario
        WHERE   id=:Idh");
        $sql->bindParam(":Idh", $datos['Idh']);
        
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

}