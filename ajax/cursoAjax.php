<?php
 $peticionAjax=true;
 require_once("../core/configgeneral.php");
//echo "probando al admin";
if(isset($_POST['ocuparcurso'])){
   require_once("../controladores/cursoControlador.php");
   
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
   echo  $instanciaCurso->mostrar_sesion2_cursos_controlador();
  
}else

if(isset($_POST['cerrarcurso'])){
   require_once("../controladores/cursoControlador.php");
   
   //INSTANCIOAMOS LA CLASE
   $instanciaCursoCerrar= new cursoControlador();
   echo  $instanciaCursoCerrar->cerrar_cursos2_controlador();
  
}else if(isset($_POST['verinfocurso'])){
   require_once("../controladores/cursoControlador.php");
   
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
   echo  $instanciaCurso->ver_curso_controlador();
  
}
else if(isset($_POST['alumnosdecursogrupo'])){
   require_once("../controladores/cursoControlador.php");
   
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
  //valida los campos requeridos
   if(isset($_POST['idespecialidad'])){
      echo  $instanciaCurso->agregar_curso_controlador();
   }else{

   }

}

else if(isset($_POST['agregarcursobd'])){
     require_once("../controladores/cursoControlador.php");
     
     //INSTANCIOAMOS LA CLASE
     $instanciaCurso= new cursoControlador();
    //valida los campos requeridos
     if(isset($_POST['nombre'])){
        echo  $instanciaCurso->agregar_curso_controlador();
     }else{

     }

 }else if(isset($_POST['actualizarcurso'])){

   require_once("../controladores/cursoControlador.php");
     
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
  //valida los campos requeridos
   if(isset($_POST['nombre'])){
      echo  $instanciaCurso->actualizar_curso_controlador();
   }else{

   }

 }
 else if(isset($_POST['agregargrupo'])){

   require_once("../controladores/cursoControlador.php");
     
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
  //valida los campos requeridos
   if(isset($_POST['codigocurso'])){
      echo  $instanciaCurso->crear_grupo__curso_controlador();
   }else{

   }

 }
else if(isset($_POST['enviar_correos'])){

   require_once("../controladores/cursoControlador.php");
     
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
  //valida los campos requeridos
   if(isset($_POST['especialidad'])){
      echo  $instanciaCurso->cambiar_correos_sino();
   }else{

   }

 }

 else if(isset($_POST['activar_atencion'])){

   require_once("../controladores/cursoControlador.php");
     
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
  //valida los campos requeridos
   if(isset($_POST['idespecialidad'])){
      echo  $instanciaCurso->activar_atencion_curso_controlador();
   }else{

   }

 }

 else if(isset($_POST['gruposdecurso'])){

   require_once("../controladores/cursoControlador.php");
     
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
  //valida los campos requeridos
   if(isset($_POST['codigocurso'])){
      
      echo  $instanciaCurso->activar_variable_codigocursogeneral();
   }else{

   }

 }

 else if(isset($_POST['desactivar_atencion'])){

   require_once("../controladores/cursoControlador.php");
     
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
  //valida los campos requeridos
   if(isset($_POST['idespecialidad'])){
      echo  $instanciaCurso->desactivar_atencion_curso_controlador();
   }else{

   }

 }

 
 else if(isset($_POST['eliminar_curso'])){

   require_once("../controladores/cursoControlador.php");
     
   //INSTANCIOAMOS LA CLASE
   $instanciaCurso= new cursoControlador();
  //valida los campos requeridos
   if(isset($_POST['idespecialidad'])){
      echo  $instanciaCurso->eliminar_curso_controlador();
   }else{

   }

 }
   else{
}
 
