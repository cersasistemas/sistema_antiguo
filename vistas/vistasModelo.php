<?php

class vistasModelo
{

    protected function obtener_vistas_modelo($vistas)
    {
        //lista blanca , menos el login
        $listaBlanca = [
            "home",
            "homelista",
            "usuario",

            //vistas clientes
            "listacliente",
            "agregarcliente",
            "detallecliente",
            "editarcliente",
            "editaralumno",
            "estadisticascliente",

            "clientesmatriculados",
            "clientesprematriculados"
            ,

            //vistas curso
            "listacurso",
            "agregarcurso",
            "detallecurso",
            "editarcurso",
            "estadisticascurso",
            "estadisticasestadoscurso",
            "enviarcorreos",


            //vista usuarios
            "listausuario",
            "agregarusuario",
            "estadisticasusuario",



            //vistas reportes
            "graficos",
            "reportesgenerales",
            "reportesmatriculas",

            //sesiones
            "sesioncurso",
            "vercurso",
            "sesionestados",
            "sesionestadoactual",

            //otrasvistas
            "adcategoria",
            "adestados",
            "adpermisos",


            //prematricula
            "alumnos",
            "agregaralumno",
            //grupo por curso
            "gruposdecurso",
            "alumnosporcurso",
            "certificado",
            //certificado
            "editarcertificado",
            "buscarcliente",
            "listaalumnos",

            "matriculas"

            
            
        ];

        //si el valor que recibe de el controladro esta en la lista blanca
        if (in_array($vistas, $listaBlanca)) {

            if (is_file("./vistas/contenidos/".$vistas."-vista.php")) {
                $contenido = "./vistas/contenidos/".$vistas."-vista.php";
            } else { 
                $contenido = "login";
            }
        } elseif ($vistas == "login") {
            $contenido = "login";
        } elseif ($vistas == "index") {
            $contenido = "login";
        } elseif($vistas == "informacion") {
            $contenido = "informacion";
        }elseif($vistas == "buscador") {
            $contenido = "buscador";
        }
        }elseif($vistas == "control") {
            $contenido = "control";
        }
        }else{
            $contenido = "404";
        }
        return $contenido;
    }
}
