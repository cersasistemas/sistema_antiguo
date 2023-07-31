<?php

$peticionAjax=true;
 require_once("../core/configgeneral.php");

 if(isset($_POST['enviarMatricula'])){
 
    require_once("../controladores/matriculaControlador.php");
    $instInteres= new matriculaControlador();
    echo  $instInteres->nuevamatricula_controlador();
 }
 elseif(isset($_POST['enviarMatricula_admin'])){

  require_once("../controladores/matriculaControlador.php");
  $instInteres= new matriculaControlador();
  echo  $instInteres->nuevamatricula_admin_controlador();


}
elseif(isset($_POST['activar_asistencia'])){

  require_once("../controladores/matriculaControlador.php");
  $instInteres= new matriculaControlador();
  echo  $instInteres->activar_asistencia_controlador();


  
}
elseif(isset($_POST['activar_asistencia_2'])){

  require_once("../controladores/matriculaControlador.php");
  $instInteres= new matriculaControlador();
  echo  $instInteres->activar_asistencia_controlador_2();


}
elseif(isset($_POST['nueva_sesion'])){

  require_once("../controladores/matriculaControlador.php");
  $instInteres= new matriculaControlador();
  echo  $instInteres->horario_controlador();
}
elseif(isset($_POST['nueva_sesion_actualizado'])){

  require_once("../controladores/matriculaControlador.php");
  $instInteres= new matriculaControlador();
  echo  $instInteres->horario_controlador_actualizado();
}
elseif(isset($_POST['editar_sesion_horario'])){

  require_once("../controladores/matriculaControlador.php");
  $instInteres= new matriculaControlador();
  echo  $instInteres->editar_sesion_horario_controlador();


}

elseif(isset($_POST['eliminar_sesion_horario'])){

  require_once("../controladores/matriculaControlador.php");
  $instInteres= new matriculaControlador();
  echo  $instInteres->eliminar_sesion_horario_controlador();


}
elseif(isset($_POST['matricula_dni'])){

  require_once("../controladores/matriculaControlador.php");
  $instInteres= new matriculaControlador();
  echo  $instInteres->asistencia_matricula();


}

 elseif(isset($_POST['enviarMatriculaGrupo'])){

   require_once("../controladores/matriculaControlador.php");
   $instInteres= new matriculaControlador();
   echo  $instInteres->nuevamatriculaGrupo_controlador();


 }else{

 }