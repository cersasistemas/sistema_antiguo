<?php
ini_set ('error_reporting', E_ALL);
require ('conbd.php');
require_once ('fpdf/fpdf.php');
header("Content-Type: text/html; charset=iso-8859-1 ");
header('Content-Type: text/html; charset=utf-8');

$idCodigo=$_REQUEST['registro'];
const METHOD="AES-256-CBC";
const SECRET_KEY='$SC@2019';
const SECRET_IV='201926';
$key=hash('sha256', SECRET_KEY);
$iv=substr(hash('sha256', SECRET_IV), 0, 16);
$output=openssl_decrypt(base64_decode($idCodigo), METHOD, $key, 0, $iv);

$idCodigo=$output;
$query="SELECT * FROM detalle_certificado WHERE iddetalle_certificado = $idCodigo";
$resultado = $mysqli->query($query);
$idcat_logo=0;



while($fila = mysqli_fetch_array($resultado))
{ 
    //$nombre = "Jose";//strtolower($fila['nombrealumno']);
   // $apellido ="Jose"; strtolower($fila['apellidoalumno']);
    $codigo = $fila['codigoalumno'];
    $certificado =$fila['codigo_detalle'];
    $curso =$fila['idespecialidad'];
    $fechainicio = $fila['fecha_inicio'];
    $fechafinal = $fila['fecha_fin'];
    $fechaemision =$fila['fecha_emision'];
    $nota = $fila['nota'];//$fila['nota'];
    $tipo = $fila['tipo'];
    $tallerdias = $fila['tallerdias'];//tipo para cambiar el modelo
    $estado = $fila['estado_detalle'];//$fila['estado'];
    $horas = $fila['horas_pedagogicas'];
   $imgprincipal =$fila['certicado_ladouno'];// $fila['imgprincipal'];
   $imgreversa =$fila['certicado_ladodos'];// $fila['imgreversa'];

  
}
$query2="SELECT * FROM alumno WHERE codigoalumno = '$codigo' ";
$resultado2 = $mysqli->query($query2);
while($fila2 = mysqli_fetch_array($resultado2))
{ 
    $nombre = utf8_decode($fila2['nombres_al']);
    $dni = $fila2['dni_al'];
    $siglas = utf8_decode($fila2['siglas']);
    //$fila['nombres_al'];
    $apellido =utf8_decode($fila2['apellidos_al']);
    $detalle_al = $fila2['detalle_al'];
    
}

$nombre = strtolower($nombre);
$siglas = strtolower($siglas);
$apellido =strtolower($apellido);
$nombre=$siglas." ".$nombre;

$lugar="";
if($detalle_al=="1"){
    $lugar="Perú";
}else{
    $lugar="Cajamarca";
}


$link=  $imgprincipal;
$link2= $imgreversa;
ob_start();
if ($estado==1 ) { //INICIO IF ESTADO 
for($i = 0; $i < 2; $i++) { //INICIO FOR
if($i == 0) { //INICIO IF1
$pdf=new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->Image($link,0,0,297,210,'JPG');





/////////////PARA CERTIFICADOS NUEVOS///////////////////////////////////////////////////////////////
if($tipo==3){
    //CERTIFICADOO DIPLOMADO
    $pdf->AddFont('impact');
    $pdf->SetFont('impact','',16);
    $pdf->SetTextColor(13,74,131);
    $pdf->Text(150,50,ucwords("OTORGADO A"));

        $query3="SELECT * FROM especialidad WHERE idespecialidad = '$curso' ";
        $resultado3 = $mysqli->query($query3);
        while($fila3 = mysqli_fetch_array($resultado3))
        { 
        if($fila3['idcategoria']==1){
                $pdf->AddFont('impact');
                $pdf->SetFont('impact','',50);
                $pdf->SetTextColor(13,74,131);
                $pdf->Text(118,40,ucwords("CERTIFICADO"));    
                
                
                //OTORGADO 
                $pdf->AddFont('segoeui');
                $pdf->SetFont('segoeui','',12);
                $pdf->SetTextColor(40,40,41);
                $pdf->Text(95,85,utf8_decode("Por su participación activa y por haber aprobado los objetivos trazados en el curso: "));

        }elseif($fila3['idcategoria']==2){
                $pdf->AddFont('impact');
                $pdf->SetFont('impact','',50);
                $pdf->SetTextColor(13,74,131);
                $pdf->Text(130,40,ucwords("DIPLOMA"));   

                //OTORGADO 
                $pdf->AddFont('segoeui');
                $pdf->SetFont('segoeui','',12);
                $pdf->SetTextColor(40,40,41);
                $pdf->Text(95,85,utf8_decode("Por su participación activa y por haber aprobado los objetivos trazados en el : "));
        }elseif($fila3['idcategoria']==4){

            $pdf->AddFont('impact');
            $pdf->SetFont('impact','',50);
            $pdf->SetTextColor(13,74,131);
            $pdf->Text(130,40,ucwords("CERTIFICADO"));   

            //OTORGADO 
            $pdf->AddFont('segoeui');
            $pdf->SetFont('segoeui','',12);
            $pdf->SetTextColor(40,40,41);
            $pdf->Text(95,85,utf8_decode("Por su participación activa y por haber aprobado los objetivos trazados en la ruta : "));
            $idcat_logo=1;
    }else{

        }
            
        }

    //DESARROLLADO CON EXITO 
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'spanish');
        $fechaInicioLetras = strftime("%d de %B del %Y", strtotime($fechainicio));
        $fechaFinalLetras = strftime("%d de %B del %Y", strtotime($fechafinal));
        $pdf->Text(95,117,utf8_decode("Desarrollado con éxito del "). $fechaInicioLetras." al ". $fechaFinalLetras.".");
        if( $idcat_logo==0){
        $pdf->Text(85,122,utf8_decode("Con un total de "). $horas.utf8_decode(" horas pedagógicas de entrenamiento a nivel de clases teórico - práctico."));
        }

        $fechaLetras = strftime("%d de %B del %Y", strtotime($fechaemision));
        $pdf->Text(192,133,utf8_decode($lugar)." , ".$fechaLetras.".");

    //CODIGO Y LOGO
    if($idcat_logo==1){
        $pdf->Image("logo_nuevo2.png",28,42,50,90,'PNG');
    }
    else{
        $pdf->Image("logo_nuevo.png",28,42,50,90,'PNG');
    }
  
  $pdf->Image("https://qr-generator.qrcode.studio/qr/custom?download=true&file=png&data=https%3A%2F%2Fcersa.org.pe%2FRegistrodeCertificados2%2Fcertificado.php%3Fregistro%3D".$certificado."&size=1000&config=%7B%22body%22%3A%22square%22%2C%22eye%22%3A%22frame2%22%2C%22eyeBall%22%3A%22ball2%22%2C%22erf1%22%3A%5B%22fv%22%5D%2C%22erf2%22%3A%5B%5D%2C%22erf3%22%3A%5B%5D%2C%22brf1%22%3A%5B%22fv%22%5D%2C%22brf2%22%3A%5B%5D%2C%22brf3%22%3A%5B%5D%2C%22bodyColor%22%3A%22%23000000%22%2C%22bgColor%22%3A%22%23FFFFFF%22%2C%22eye1Color%22%3A%22%23000000%22%2C%22eye2Color%22%3A%22%23000000%22%2C%22eye3Color%22%3A%22%23000000%22%2C%22eyeBall1Color%22%3A%22%23000000%22%2C%22eyeBall2Color%22%3A%22%23000000%22%2C%22eyeBall3Color%22%3A%22%23000000%22%2C%22gradientColor1%22%3A%22%231A92C6%22%2C%22gradientColor2%22%3A%22%230d4a83%22%2C%22gradientType%22%3A%22linear%22%2C%22gradientOnEyes%22%3A%22true%22%2C%22logo%22%3A%22%22%2C%22logoMode%22%3A%22default%22%7D",35,138,35,0,'PNG');
    $pdf->SetFont('impact','',18);
    $pdf->SetTextColor(13,74,131);
    $pdf->Text(38,181, "$certificado");

    //FIRMAS 
    $pdf->Image("Firmas/firma_katia.png",93,141,73,0,'PNG');
    $pdf->Image("Firmas/firma_roberth.png",178,140,73,0,'PNG');
    $pdf->AddFont('impact');

    //NOMBRES DE ALUMNOS
        
    if (strlen($nombre." ".$apellido) <= 15) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(102,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 16) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 17) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 18) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 19) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 20) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 21) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 22) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 23) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 24) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 25) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 26) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 27) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 28) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 29) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 30) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 31) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==32) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==33) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',35);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==34) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',35);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==35) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',33);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==36) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',33);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==37) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',33);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==38) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',35);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==39) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(92,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==40) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(91,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==41) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(91,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==42) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(91,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==43) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==44) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==45) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==46) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==47) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',27);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==48) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',26);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==49) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==50) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==51) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==52) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==53) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==54) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(78,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==55) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(78,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==56) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',23);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==57) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',23);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==58) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',23);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==59) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',22);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==60) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',21);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==61) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',21);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==62) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',21);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==63) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==64) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==65) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==66) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==67) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==68) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',19);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==69) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',19);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==70) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',19);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        

}
/////////////////////////////////////////////////////////////////



//PARA TALLERES
elseif($tipo==4){

    $pdf->AddFont('impact');
    $pdf->SetFont('impact','',16);
    $pdf->SetTextColor(13,74,131);
    $pdf->Text(150,50,ucwords("OTORGADO A"));

    $pdf->AddFont('impact');
    $pdf->SetFont('impact','',50);
    $pdf->SetTextColor(13,74,131);
    $pdf->Text(118,40,ucwords("CERTIFICADO"));                    
                
    //OTORGADO 
    $pdf->AddFont('segoeui');
    $pdf->SetFont('segoeui','',12);
    $pdf->SetTextColor(40,40,41);
    $pdf->Text(88,85,utf8_decode("Por su participación activa y por haber aprobado los objetivos trazados en el taller : "));

    

    //DESARROLLADO CON EXITO 
        date_default_timezone_set('Europe/Madrid');
        setlocale(LC_TIME, 'spanish');
        $fechaInicioLetras = strftime("%d de %B del %Y", strtotime($fechainicio));
        $fechaFinalLetras = strftime("%d de %B del %Y", strtotime($fechafinal));

        if($tallerdias==0 || $tallerdias==1 ){
            $pdf->Text(115,117,utf8_decode("Desarrollado con éxito el "). $fechaInicioLetras.". Con un total de");
            $pdf->Text(100,122,utf8_decode(""). $horas.utf8_decode(" horas académicas de entrenamiento a nivel de clases teórico - práctico."));
    
        }
        elseif( $tallerdias==2 ){
            $fechaInicioLetras = strftime("%d", strtotime($fechainicio));
            $pdf->Text(110,117,utf8_decode("Desarrollado con éxito el "). $fechaInicioLetras." y ". $fechaFinalLetras.". Con un total de ");
            $pdf->Text(100,122,utf8_decode(""). $horas.utf8_decode(" horas académicas de entrenamiento a nivel de clases teórico - práctico."));
       
        }else{

        }

       
        $fechaLetras = strftime("%d de %B del %Y", strtotime($fechaemision));
        $pdf->Text(192,133,utf8_decode($lugar)." , ".$fechaLetras.".");

    //CODIGO Y LOGO

   
   
    $pdf->Image("logo_nuevo.png",28,42,50,0,'PNG');
 $pdf->Image("https://qr-generator.qrcode.studio/qr/custom?download=true&file=png&data=https%3A%2F%2Fcersa.org.pe%2FRegistrodeCertificados2%2Fcertificado.php%3Fregistro%3D".$certificado."&size=1000&config=%7B%22body%22%3A%22square%22%2C%22eye%22%3A%22frame2%22%2C%22eyeBall%22%3A%22ball2%22%2C%22erf1%22%3A%5B%22fv%22%5D%2C%22erf2%22%3A%5B%5D%2C%22erf3%22%3A%5B%5D%2C%22brf1%22%3A%5B%22fv%22%5D%2C%22brf2%22%3A%5B%5D%2C%22brf3%22%3A%5B%5D%2C%22bodyColor%22%3A%22%23000000%22%2C%22bgColor%22%3A%22%23FFFFFF%22%2C%22eye1Color%22%3A%22%23000000%22%2C%22eye2Color%22%3A%22%23000000%22%2C%22eye3Color%22%3A%22%23000000%22%2C%22eyeBall1Color%22%3A%22%23000000%22%2C%22eyeBall2Color%22%3A%22%23000000%22%2C%22eyeBall3Color%22%3A%22%23000000%22%2C%22gradientColor1%22%3A%22%231A92C6%22%2C%22gradientColor2%22%3A%22%230d4a83%22%2C%22gradientType%22%3A%22linear%22%2C%22gradientOnEyes%22%3A%22true%22%2C%22logo%22%3A%22%22%2C%22logoMode%22%3A%22default%22%7D",35,138,35,0,'PNG');
    $pdf->AddFont('impact');
    $pdf->SetFont('impact','',18);
    $pdf->SetTextColor(13,74,131);
    $pdf->Text(38,181, "$certificado");

    //FIRMAS 
    $pdf->Image("Firmas/firma_katia.png",93,141,73,0,'PNG');
$pdf->Image("Firmas/firma_roberth.png",178,140,73,0,'PNG');

    //NOMBRES DE ALUMNOS
        
    if (strlen($nombre." ".$apellido) <= 15) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(102,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 16) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 17) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 18) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 19) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 20) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 21) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 22) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 23) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 24) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 25) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(100,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 26) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 27) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 28) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 29) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 30) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 31) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==32) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==33) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',35);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==34) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',35);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==35) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',33);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==36) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',33);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==37) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',33);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==38) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',35);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==39) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(92,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==40) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(91,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==41) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(91,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==42) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(91,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==43) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==44) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==45) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==46) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==47) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',27);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==48) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',26);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==49) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==50) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==51) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==52) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==53) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(90,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==54) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(78,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==55) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',25);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(78,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==56) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',23);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==57) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',23);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==58) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',23);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==59) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',22);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==60) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',21);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==61) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',21);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==62) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',21);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==63) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==64) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==65) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==66) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==67) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',20);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==68) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',19);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==69) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',19);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==70) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',19);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,75,ucwords($nombre." ".$apellido));
        }
        

}





elseif($tipo==2 || $tipo==1 || $tipo==0){
    //DESPUES DEL NOMBRE VA TODOS LOS DEMAS
    $pdf->AddFont('segoeui');
    $pdf->SetFont('segoeui','',12);
    $pdf->SetTextColor(40,40,41);
    //CONVERTIR FECHA A LETRAS
    date_default_timezone_set('Europe/Madrid');
    setlocale(LC_TIME, 'spanish');
    $fechaInicioLetras = strftime("%d de %B del %Y", strtotime($fechainicio));
    $fechaFinalLetras = strftime("%d de %B del %Y", strtotime($fechafinal));
    if($tipo==0){
    
    }
    else if($tipo==2 || $tipo==1){
        $pdf->Text(78,134,utf8_decode("Desarrollado con éxito del "). $fechaInicioLetras." al ". $fechaFinalLetras.".");
        $pdf->Text(65,139,utf8_decode("Con un total de "). $horas.utf8_decode(" horas pedagógicas de entrenamiento a nivel de clases teórico - práctico."));
    }

    $fechaLetras = strftime("%d de %B del %Y", strtotime($fechaemision));
    $pdf->Text(175,148,utf8_decode($lugar)." , ".$fechaLetras.".");

    $pdf->Image("logo.png",12,27,59,18,'PNG');
   $pdf->Image("https://qr-generator.qrcode.studio/qr/custom?download=true&file=png&data=https%3A%2F%2Fcersa.org.pe%2FRegistrodeCertificados2%2Fcertificado.php%3Fregistro%3D".$certificado."&size=1000&config=%7B%22body%22%3A%22square%22%2C%22eye%22%3A%22frame2%22%2C%22eyeBall%22%3A%22ball2%22%2C%22erf1%22%3A%5B%22fv%22%5D%2C%22erf2%22%3A%5B%5D%2C%22erf3%22%3A%5B%5D%2C%22brf1%22%3A%5B%22fv%22%5D%2C%22brf2%22%3A%5B%5D%2C%22brf3%22%3A%5B%5D%2C%22bodyColor%22%3A%22%23000000%22%2C%22bgColor%22%3A%22%23FFFFFF%22%2C%22eye1Color%22%3A%22%23000000%22%2C%22eye2Color%22%3A%22%23000000%22%2C%22eye3Color%22%3A%22%23000000%22%2C%22eyeBall1Color%22%3A%22%23000000%22%2C%22eyeBall2Color%22%3A%22%23000000%22%2C%22eyeBall3Color%22%3A%22%23000000%22%2C%22gradientColor1%22%3A%22%231A92C6%22%2C%22gradientColor2%22%3A%22%230d4a83%22%2C%22gradientType%22%3A%22linear%22%2C%22gradientOnEyes%22%3A%22true%22%2C%22logo%22%3A%22%22%2C%22logoMode%22%3A%22default%22%7D",10,155,35,0,'PNG');
    if($tipo==2){
        $pdf->Image("Firmas/katia4.png",72,152,71,36,'PNG');
    }else{
        $pdf->Image("Firmas/JoseHuaman.png",72,152,71,36,'PNG');
    }

    $pdf->Image("Firmas/RoberthNontol.png",178,153,55,35,'PNG');

    $pdf->AddFont('impact');
    $pdf->SetFont('impact','',14);
    $pdf->SetTextColor(254,254,254);
    $pdf->Text(16,196, "$certificado");


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
        $pdf->Text(80,90,ucwords($nombre." ".$apellido));
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
        $pdf->Text(70,90,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 23) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(75,90,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 24) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',45);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(74,90,ucwords($nombre." ".$apellido));
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
        $pdf->Text(59,90,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) == 31) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(59,90,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==32) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',40);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(59,90,ucwords($nombre." ".$apellido));
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
        $pdf->Text(69,90,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==41) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(69,90,ucwords($nombre." ".$apellido));
        }
        
        elseif (strlen($nombre." ".$apellido) ==42) {
        $pdf->AddFont('Heart','','Heart.php');
        $pdf->SetFont('Heart','',30);
        $pdf->SetTextColor(29,146,198);
        $pdf->Text(69,90,ucwords($nombre." ".$apellido));
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



    }
////////////////////////////////////////////////////////////////////////////////



} //FINAL IF1



else { //INICIO ELSE 1

if($tipo!=4){
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 10);
   $pdf->Image($link2,0,0,297,210,'JPG');
    $pdf->AddFont('YessyFont','','YessyFont.php');
   
    $pdf->SetTextColor(29,146,198);
    if($tipo==0){

    }elseif($tipo==3){

        if($idcat_logo==1){

        }
       else{

       
        if(strlen($dni)==8){
            $pdf->SetFont('YessyFont','',60);
            $pdf->Text(100,35, $nota);
        }
        else{
            $pdf->SetFont('YessyFont','',30);
            $pdf->Text(99,31, $nota."/20");
        }
    }
      
    }
    elseif($tipo==2 || $tipo==1){
      
        $pdf->SetFont('YessyFont','',70);
        $pdf->Text(30,45, $nota);
      
    }
}
    } //FINAL ELSE 1

} //FINAL DEL FOR
} //FINAL IF ESTADO EMITIDO




else { //INICIO ELSE ESTADO NO EMITIDO
    for($i = 0; $i < 2; $i++) { //INICIO FOR
        if($i == 0) 
        { //INICIO IF1
        $pdf=new FPDF('L','mm','A4');
        $pdf->AddPage();
        $pdf->Image('noexiste.jpg',0,0,297,210,'JPG');
        } //FINAL IF1
    } //FINAL DEL FOR
} //FINAL ELSE NO EMITIDO

ob_clean();
$pdf->Output($certificado.'.pdf','I');
?>
