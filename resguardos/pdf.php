<?php
 
require('../fpdf/fpdf.php');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../fpdf/Logo1.png',10,8,33);
    $this->Image('../fpdf/Logo2.png',10 ,8, 33);
	
	// $this->Image('fpdf/Logo2.png',160 ,8, 33);
	// Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
	//$this->Text(10,10,utf8_decode('"SALIDA DE BIENES INFORMATICOS EN PRESTAMO"'),0,'C', 0);
	
   $this->Text(80,10,('INSTITUTO NACIONAL DE MIGRACIÓN'),0,'C', 0);
   $this->Text(75,15,('DELEGACIÓN REGIONAL EN QUINTANA ROO'),0,'C', 0);
   $this->Text(85,20,('DEPARTAMENTO DE INFORMATICA'),0,'C', 0);
   $this->Cell(40,50,'SALIDA DE BIENES INFORMATICOS EN PRESTAMO',0,0,'C');
	
  
    $this->Ln(40);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','',12);
for($i=1;$i<=10;$i++)
    $pdf->Cell(0,5,'Imprimiendo línea número '.$i,0,1);

$pdf->SetXY(20, 140);
$pdf->Text(24,140,('NOMBRE Y FIRMA DE QUIEN'),0,'C', 0);
$pdf->Cell(10, 8, 'ENTREGA EL EQUIPO EN PRESTAMO', 0, 'L');
$pdf->Line(15, 154, 100, 154);

$pdf->SetXY(125, 140);
$pdf->Text(130,140,('NOMBRE Y FIRMA DE QUIEN'),0,'C', 0);
$pdf->Cell(10, 8, ('RECIBE EL EQUIPO EN PRESTAMO'), 0, 'L');
$pdf->Line(120, 154, 200, 154);
$pdf->Output();

?>