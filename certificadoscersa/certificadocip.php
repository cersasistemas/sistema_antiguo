<?php
ini_set('error_reporting', E_ALL);
require_once('fpdf/fpdf.php');
header("Content-Type: text/html; charset=iso-8859-1 ");
header('Content-Type: text/html; charset=utf-8');
$alumno = $_REQUEST['nombre'];
$fecha = $_REQUEST['fecha'];
$horas = $_REQUEST['horas'] . " horas académicas de teoría y práctica";
$tipo = $_REQUEST['tipo'];
$codigoqr = $_REQUEST['codigoqr'];
$cursoid = $_REQUEST['cursoid'];
$id = $_REQUEST['id'];

$fechai = $_REQUEST['fechai'];
$fechaf = $_REQUEST['fechaf'];
$nota = $_REQUEST['nota'];
$tipocertificado = $_REQUEST['tipocertificado'];


$ladoa = "https://cersa.org.pe/imagenescertificados/" . $cursoid . "/a.png";

ob_start();


$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->Image($ladoa, 0, 0, 297, 210, 'PNG');


//Logos
$logocersa = "https://cersa.org.pe/diplomas/img/logo_cersa.409295ae.png";
$logocip = "https://cersa.org.pe/diplomas/img/logo_cip.ea34206e.png";
$pdf->Image($logocersa, 20, 10, 49, 16, 'PNG');
$pdf->Image($logocip, 251, 7, 23, 23, 'PNG');

//firmas
$firma_gerencia = "https://cersa.org.pe/imagenescertificados/firma_gerencia.png";
$firma_cip = "https://cersa.org.pe/imagenescertificados/firma_cip.png";
$pdf->Image($firma_gerencia, 63, 137, 56, 35, 'PNG');
$pdf->Image($firma_cip, 181, 137, 64, 34, 'PNG');

//Otorgado a
$pdf->AddFont('segoeui');
$pdf->SetFont('segoeui', '', 17);
$pdf->SetTextColor(40, 40, 41);
$pdf->Text(131, 45, "Otorgado a:");

//Nombre de ALumno
$ubicacion_alumno = 0;
$largo = strlen($alumno);
for ($i = 0; $i <= $largo; $i++) {
  if ($largo == $i) {
    $ubicacion_alumno = 143 - 2 * $i;
    break;
  }
}
$pdf->AddFont('segoeui');
$pdf->SetFont('segoeui', '', 26);
$pdf->SetTextColor(29, 146, 198);
$pdf->Text($ubicacion_alumno, 58, utf8_decode($alumno));


//otorgador
$ubicacion_otorgado = 113;
$participar = 'Por participar y aprobar el';
if ($tipo == 0) {
  $participar = "Por participar y aprobar el";
} else if ($tipo == 1) {
  $participar = "Por participar y aprobar el curso : ";
  $ubicacion_otorgado = 105;
} else if ($tipo == 2) {
  $participar = "Por participar y aprobar el : ";
  $ubicacion_otorgado = 113;
} else if ($tipo == 3) {
  $participar = "Por participar y aprobar el taller de :";
  $ubicacion_otorgado = 100;
} else if ($tipo == 4) {
  $participar = "Por participar y aprobar el seminario de :";
  $ubicacion_otorgado = 94;
} else if ($tipo == 5) {
  $participar = "Por participar y aprobar el : ";
  $ubicacion_otorgado = 113;
} else if ($tipo == 6) { // seminario con temario
  $participar = "Por participar y aprobar el seminario de: ";
  $ubicacion_otorgado = 94;
} else {
  $participar = "Por participar y aprobar el : ";
  $ubicacion_otorgado = 113;
}
$pdf->AddFont('segoeui');
$pdf->SetFont('segoeui', '', 17);
$pdf->SetTextColor(40, 40, 41);
$pdf->Text($ubicacion_otorgado, 72, $participar);

//Primeros certificados
if ($tipocertificado == 1) {

  //fecha
  $fecha = "El " . $_REQUEST['fecha'] . " con";
  $ubicacion_fecha = 110;
  $largo_fecha = strlen($fecha);
  for ($i = 0; $i <= $largo_fecha; $i++) {
    if ($largo_fecha == $i) {
      $ubicacion_fecha = 168 - 2 * $i;
      break;
    }
  }
  $pdf->AddFont('segoeui');
  $pdf->SetFont('segoeui', '', 15);
  $pdf->SetTextColor(40, 40, 41);
  $pdf->Text($ubicacion_fecha, 106, $fecha);

  //Horas Pedagogicas
  $pdf->AddFont('segoeui');
  $pdf->SetFont('segoeui', '', 15);
  $pdf->SetTextColor(40, 40, 41);
  $pdf->Text(100, 115, utf8_decode($horas));
}
//segundos certificados
else if ($tipocertificado == 2) {
  //fecha de inciio y fin
  $ubicacion_fecha = 110;
  $desarrollado = "Desarrollado con éxito del " . $fechai . " al " . $fechaf . "";
  $largo_fecha = strlen($desarrollado);
  for ($i = 0; $i <= $largo_fecha; $i++) {
    if ($largo_fecha == $i) {
      $ubicacion_fecha = 210 - 2 * $i;
      break;
    }
  }
  $pdf->AddFont('segoeui');
  $pdf->SetFont('segoeui', '', 15);
  $pdf->SetTextColor(40, 40, 41);
  $pdf->Text($ubicacion_fecha, 106, utf8_decode($desarrollado));

  //Horas Pedagogicas
  $pdf->AddFont('segoeui');
  $pdf->SetFont('segoeui', '', 15);
  $pdf->SetTextColor(40, 40, 41);
  $pdf->Text(80, 115, utf8_decode("Con un total de " . $horas));

  //fecha de emision
  $ubicacion_fecha_emision = 110;
  $emision = "Cajamarca, " . $fecha;
  $largo_fecha_emision = strlen($emision);
  for ($i = 0; $i <= $largo_fecha_emision; $i++) {
    if ($largo_fecha_emision == $i) {
      $ubicacion_fecha_emision = 230 - 2 * $i;
      break;
    }
  }
  $pdf->AddFont('segoeui');
  $pdf->SetFont('segoeui', '', 13);
  $pdf->SetTextColor(40, 40, 41);
  $pdf->Text($ubicacion_fecha_emision, 126, utf8_decode($emision));
}


require 'phpqrcode/qrlib.php';
$dato   =   'https://cersa.org.pe/diplomas/?codigo=' . $id;
QRcode::png($dato, "generador-qr/img/qr_" . $id . ".png", 'L', 32, 2);
$name_imagen = 'generador-qr/img/qr_' . $id . '.png';
$pdf->Image($name_imagen, 130, 137, 35, 35, 'PNG');

//Horas Pedagogicas
$pdf->AddFont('segoeui');
$pdf->SetFont('segoeui', '', 10);
$pdf->SetTextColor(40, 40, 41);
$pdf->Text(129, 178, $codigoqr);


$ladob = "";

if ($tipo == 1 || $tipo == 2 || $tipo == 6) {
  $ladob = "https://cersa.org.pe/imagenescertificados/" . $cursoid . "/b.png";
  //$ladob = "https://cersa.org.pe/imagenescertificados/b2.png";
  $pdf->AddPage();
  $pdf->SetAutoPageBreak(true, 10);
  $pdf->Image($ladob, 0, 0, 297, 210, 'PNG');
  if ($tipocertificado == 2) {
    //Horas Pedagogicas

    //firmas
    $fondo_nota = "https://cersa.org.pe/imagenescertificados/nota10.png";
    $pdf->Image($fondo_nota, 232, 11, 16, 20, 'PNG');

    $pdf->AddFont('segoeui');
    $pdf->SetFont('segoeui', 'B', 10);
    $pdf->SetTextColor(29, 146, 198);
    $pdf->Text(206, 20,utf8_decode("CALIFICACIÓN : "));

    $pdf->AddFont('segoeui');
    $pdf->SetFont('segoeui', '', 24);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Text(235, 22, $nota);
  }
}

ob_clean();
$pdf->Output($codigoqr . '.pdf', 'I');
