
<a href="">Direccion</a>
<?php
    $datos=explode("/",$_GET['vistas']);

    //$peticionAjax=true;
    //require ('conbd.php');
   require_once ('../vistas/certificado/fpdf/fpdf.php');
    header("Content-Type: text/html; charset=iso-8859-1 ");

    require_once("./controladores/clienteControlador.php");
    $insCurso = new clienteControlador();
    echo $insCurso->ver_certificado_controlador($datos[1]);


   // $idCodigo=$_REQUEST['registro'];
   // $query="SELECT nombrealumno,apellidoalumno,idalumno,codigocert,curso,fechainicio,fechafinal,fechaemision,nota,estado,imgprincipal,imgreversa,horas FROM alumno WHERE idalumno = $idCodigo";
   // $resultado = $mysqli->query($query);

    $nombre = "Jose Luis";//strtolower($fila['nombrealumno']);
    $apellido = "Ramirez  Quiroz";//strtolower($fila['apellidoalumno']);
    $codigo = "Jose Luis";//$fila['idalumno'];
    $certificado ="IC1-ESP";// $fila['codigocert'];
    $curso ="Obras por Impuestos";// $fila['curso'];
    $fechainicio ="28 de Enero";// $fila['fechainicio'];
    $fechafinal = "24 Febrero";//$fila['fechafinal'];
    $fechaemision ="Jose Luis";// $fila['fechaemision'];
    $nota ="Jose Luis";// $fila['nota'];
    $estado = "EMITIDO";//$fila['estado'];
    $imgprincipal = "Jose Luis";//$fila['imgprincipal'];
    $imgreversa ="Jose Luis";// $fila['imgreversa'];
    $horas = "40";//$fila['horas'];



if ($estado=="EMITIDO") { //INICIO IF ESTADO 
for($i = 0; $i < 2; $i++) { //INICIO FOR
if($i == 0) { //INICIO IF1
$pdf=new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->Image($imgprincipal,0,0,297,210,'JPG');

if (strlen($nombre." ".$apellido) <= 15) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(92,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 16) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(90,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 17) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(90,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 18) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(90,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 19) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(89,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 20) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(88,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 21) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(80,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 22) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(7,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 23) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(72,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 24) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(72,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 25) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',45);
$pdf->SetTextColor(29,146,198);
$pdf->Text(72,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 26) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',40);
$pdf->SetTextColor(29,146,198);
$pdf->Text(69,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 27) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',40);
$pdf->SetTextColor(29,146,198);
$pdf->Text(69,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 28) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',40);
$pdf->SetTextColor(29,146,198);
$pdf->Text(69,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 29) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',40);
$pdf->SetTextColor(29,146,198);
$pdf->Text(69,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 30) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',40);
$pdf->SetTextColor(29,146,198);
$pdf->Text(69,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) == 31) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',40);
$pdf->SetTextColor(29,146,198);
$pdf->Text(69,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==32) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',40);
$pdf->SetTextColor(29,146,198);
$pdf->Text(70,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==33) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',35);
$pdf->SetTextColor(29,146,198);
$pdf->Text(70,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==34) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',35);
$pdf->SetTextColor(29,146,198);
$pdf->Text(69,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==35) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',33);
$pdf->SetTextColor(29,146,198);
$pdf->Text(67,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==36) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',33);
$pdf->SetTextColor(29,146,198);
$pdf->Text(67,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==37) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',33);
$pdf->SetTextColor(29,146,198);
$pdf->Text(67,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==38) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',35);
$pdf->SetTextColor(29,146,198);
$pdf->Text(67,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==39) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',30);
$pdf->SetTextColor(29,146,198);
$pdf->Text(67,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==40) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',30);
$pdf->SetTextColor(29,146,198);
$pdf->Text(64,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==41) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',30);
$pdf->SetTextColor(29,146,198);
$pdf->Text(64,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==42) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',30);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==43) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',30);
$pdf->SetTextColor(29,146,198);
$pdf->Text(62,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==44) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',30);
$pdf->SetTextColor(29,146,198);
$pdf->Text(61,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==45) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',30);
$pdf->SetTextColor(29,146,198);
$pdf->Text(59,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==46) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',30);
$pdf->SetTextColor(29,146,198);
$pdf->Text(58,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==47) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',27);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==48) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',26);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==49) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',25);
$pdf->SetTextColor(29,146,198);
$pdf->Text(64,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==50) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',25);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==51) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',25);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==52) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',25);
$pdf->SetTextColor(29,146,198);
$pdf->Text(62,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==53) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',25);
$pdf->SetTextColor(29,146,198);
$pdf->Text(61,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==54) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',25);
$pdf->SetTextColor(29,146,198);
$pdf->Text(61,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==55) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',25);
$pdf->SetTextColor(29,146,198);
$pdf->Text(61,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==56) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',23);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==57) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',23);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==58) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',23);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==59) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',22);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==60) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',21);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==61) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',21);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==62) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',21);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==63) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',20);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==64) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',20);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==65) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',20);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==66) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',20);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==67) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',20);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==68) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',19);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==69) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',19);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

elseif (strlen($nombre." ".$apellido) ==70) {
$pdf->AddFont('Heart','','Heart.php');
$pdf->SetFont('Heart','',19);
$pdf->SetTextColor(29,146,198);
$pdf->Text(63,90,ucwords($nombre." ".$apellido));
}

//DESPUES DEL NOMBRE VA TODOS LOS DEMAS
$pdf->AddFont('segoeui');
$pdf->SetFont('segoeui','',12);
$pdf->SetTextColor(40,40,41);
//CONVERTIR FECHA A LETRAS
date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, 'spanish');
$fechaInicioLetras = strftime("%d de %B del %Y", strtotime($fechainicio));
$fechaFinalLetras = strftime("%d de %B del %Y", strtotime($fechafinal));
$pdf->Text(65,134,utf8_decode("Desarrollado con éxito del "). $fechaInicioLetras." al ". $fechaFinalLetras.".");
$pdf->Text(65,139,utf8_decode("Con un total de "). $horas.utf8_decode(" horas pedagógicas de entrenamiento a nivel de clases teórico - práctico."));
$fechaLetras = strftime("%d de %B del %Y", strtotime($fechaemision));
$pdf->Text(175,148,utf8_decode("Cajamarca, "). $fechaLetras.".");

$pdf->Image("logo.png",12,27,59,18,'PNG');
$pdf->Image("https://qr-generator.qrcode.studio/qr/custom?download=true&file=png&data=https%3A%2F%2Fcersa.org.pe%2FRegistrodeCertificados%2Fcertificado.php%3Fregistro%3D".$certificado."&size=1000&config=%7B%22body%22%3A%22square%22%2C%22eye%22%3A%22frame2%22%2C%22eyeBall%22%3A%22ball2%22%2C%22erf1%22%3A%5B%22fv%22%5D%2C%22erf2%22%3A%5B%5D%2C%22erf3%22%3A%5B%5D%2C%22brf1%22%3A%5B%22fv%22%5D%2C%22brf2%22%3A%5B%5D%2C%22brf3%22%3A%5B%5D%2C%22bodyColor%22%3A%22%23000000%22%2C%22bgColor%22%3A%22%23FFFFFF%22%2C%22eye1Color%22%3A%22%23000000%22%2C%22eye2Color%22%3A%22%23000000%22%2C%22eye3Color%22%3A%22%23000000%22%2C%22eyeBall1Color%22%3A%22%23000000%22%2C%22eyeBall2Color%22%3A%22%23000000%22%2C%22eyeBall3Color%22%3A%22%23000000%22%2C%22gradientColor1%22%3A%22%231A92C6%22%2C%22gradientColor2%22%3A%22%230d4a83%22%2C%22gradientType%22%3A%22linear%22%2C%22gradientOnEyes%22%3A%22true%22%2C%22logo%22%3A%22%22%2C%22logoMode%22%3A%22default%22%7D",10,155,35,35,'PNG');
$pdf->Image("Firmas/JoseHuaman.png",72,152,71,36,'PNG');
$pdf->Image("Firmas/RoberthNontol.png",178,153,55,35,'PNG');

$pdf->AddFont('impact');
$pdf->SetFont('impact','',14);
$pdf->SetTextColor(254,254,254);
$pdf->Text(16,196, "$certificado");
} //FINAL IF1



    else { //INICIO ELSE 1
        $pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->Image($imgreversa,0,0,297,210,'JPG');
$pdf->AddFont('YessyFont','','YessyFont.php');
$pdf->SetFont('YessyFont','',70);
$pdf->SetTextColor(29,146,198);
$pdf->Text(30,45, $nota);
    } //FINAL ELSE 1

} //FINAL DEL FOR
} //FINAL IF ESTADO EMITIDO




else { //INICIO ELSE ESTADO NO EMITIDO
for($i = 0; $i < 2; $i++) { //INICIO FOR
if($i == 0) { //INICIO IF1
$pdf=new FPDF('L','mm','A4');
$pdf->AddPage(); 
$pdf->Image('noexiste.jpg',0,0,297,210,'JPG');
} //FINAL IF1
} //FINAL DEL FOR
} //FINAL ELSE NO EMITIDO

$pdf->Output($certificado.".pdf",'I');
?>



