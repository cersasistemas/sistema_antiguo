<?php

$peticionAjax=true;
require_once("../core/configgeneral.php");

if (isset($_POST['agregar_cliente'])) {
    require_once('../controladores/clienteControlador.php');
    $instanciaCliente = new clienteControlador();

    //validamos capos que se
   if (isset($_POST['nombre'])) {
            echo $instanciaCliente->agregar_cliente_controlador();
            //echo $instanciaCliente->agregar_cliente_controlador();
        } else { }

        ///LLAMAR VISTA DE SESION
}else if(isset($_POST['vistacambioestado'])){
    require_once('../controladores/clienteControlador.php');
    $insVistaCliente = new clienteControlador();

    if (isset($_POST['enlacecliente'])) {
        $_SESSION['codigocliente']=$_POST['enlacecliente'];
        $identificador=$_POST['idenestado'];
        $codigoclienteV= $_SESSION['codigocliente'];
        $idinterescontrol=$_POST['idinterescontrol'];
        echo $insVistaCliente->pasando_variable_controlador($codigoclienteV,$identificador,$idinterescontrol);
        
        $direccion=SERVERURL."sesionestados";
        header('location:'.$direccion);
        //echo $insVistaCliente->agregar_cliente_controlador();
        //echo $instanciaCliente->agregar_cliente_controlador();
    } else { }
}


else if(isset($_POST['matricular'])){
    require_once('../controladores/clienteControlador.php');
    $instanciaMatri = new clienteControlador();
    if (isset($_POST['codigocurso'])) {
        echo $instanciaMatri->matri_cliente_controlador();
    }
   

}

else if(isset($_POST['buscardni'])){
    require_once('../controladores/clienteControlador.php');
    $instanciaMatri = new clienteControlador();
    if (isset($_POST['dni'])) {
        //echo $instanciaMatri->matri_cliente_controlador();
        //echo "me encuentro aqui";
        //header('location: index.php');
        $dni=$_POST['dni'];
        $variable=SERVERURL."buscador/".$dni;
        header('location:'.$variable);
    }
   

}


else if(isset($_POST['actualizar_cliente'])){

        require_once('../controladores/clienteControlador.php');
        $instanciaClienteActualizar = new clienteControlador();
    
        //validamos capos que se
       if (isset($_POST['idcliente'])) {
                echo $instanciaClienteActualizar->actualizar_cliente_controlador();
                //echo $instanciaCliente->agregar_cliente_controlador();
            } else { }

}
else if(isset($_POST['buscarcliente'])){

    require_once('../controladores/cursoControlador.php');
    $instanciaClienteActualizar = new cursoControlador();

    //validamos capos que se
   if (isset($_POST['parametrobusqueda'])) {
            echo $instanciaClienteActualizar->busqueda_cliente_controlador();
            //echo "llego hasta aqui";
        } else { }

}

else if(isset($_POST['actualizar_alumno'])){

    require_once('../controladores/clienteControlador.php');
    $instanciaAlumnoActualizar = new clienteControlador();

    //validamos capos que se
   if (isset($_POST['idalumno'])) {
            echo $instanciaAlumnoActualizar->actualizar_alumno_controlador();
            //echo $instanciaCliente->agregar_cliente_controlador();
        } else { }

}

else if(isset($_POST['agregar_alumno'])){

    require_once('../controladores/clienteControlador.php');
    $instanciaClienteActualizar = new clienteControlador();

    //validamos capos que se
   if (isset($_POST['idespecialidad'])) {
            echo $instanciaClienteActualizar->agregar_alumno_controlador();
            //echo $instanciaCliente->agregar_cliente_controlador();
        } else { }

}
else if(isset($_POST['agregar_alumno_taller'])){

    require_once('../controladores/clienteControlador.php');
    $instanciaClienteActualizar = new clienteControlador();

    //validamos capos que se
   if (isset($_POST['idespecialidad'])) {
            echo $instanciaClienteActualizar->agregar_alumno_taller_controlador();
            //echo $instanciaCliente->agregar_cliente_controlador();
        } else { }

}
   

else if(isset($_POST['actualizar_certificado'])){

    require_once('../controladores/clienteControlador.php');
    $instanciaClienteActualizar = new clienteControlador();

    //validamos capos que se
   if (isset($_POST['iddetalle'])) {
            echo $instanciaClienteActualizar->actualizar_certificado_controlador();
            //echo $instanciaCliente->agregar_cliente_controlador();
        } else { }

}
else if(isset($_POST['eliminar_certificado'])){

    require_once('../controladores/clienteControlador.php');
    $instanciaClienteEliminar = new clienteControlador();

    //validamos capos que se
   if (isset($_POST['idcertificado'])) {
            echo $instanciaClienteEliminar->eliminar_certificado_controlador();
            //echo $instanciaCliente->agregar_cliente_controlador();
        } else { }

}
else if(isset($_POST['enviar_correo_cer'])){

    require_once('../controladores/clienteControlador.php');
    $instanciaClienteEvniar = new clienteControlador();

    //validamos capos que se
   if (isset($_POST['correo_al'])) {
            echo $instanciaClienteEvniar->enviar_certificado_controlador();
            //echo $instanciaCliente->agregar_cliente_controlador();
        } else { }

}

else{}
