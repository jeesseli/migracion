<?php
require('../fpdf/fpdf.php');

$con=@mysqli_connect('localhost', 'root', '', 'migracion');
if(!$con){
    die("imposible conectarse: ".mysqli_error($con));
}
if (@mysqli_connect_errno()) {
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
//$id_resguardo= $_POST["resguardo"];
//echo $id_resguardo;
if ($con){
  $sql=mysqli_query($con,"Select * from resguardo Where id_resguardos = 2");
  $res_pcs=mysqli_query($con,"SELECT * FROM  resguardo_invpcs  Where id_resguardo= 2");
  class PDF extends FPDF
  {
  // Cabecera de p�gina
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
      // T�tulo
  	//$this->Text(10,10,utf8_decode('"SALIDA DE BIENES INFORMATICOS EN PRESTAMO"'),0,'C', 0);

     $this->Text(80,10,('INSTITUTO NACIONAL DE MIGRACI�N'),0,'C', 0);
     $this->Text(75,15,('DELEGACI�N REGIONAL EN QUINTANA ROO'),0,'C', 0);
     $this->Text(85,20,('DEPARTAMENTO DE INFORMATICA'),0,'C', 0);
     $time=  time();

     //echo 'Después de setlocale es_ES.UTF-8 date devuelve: '.date("l, d-m-Y (H:i:s)", $miFecha).'<br/>';
     //$fecha= 'Fecha : '.date("l, d-m-Y (H:i:s)", $miFecha);
     $fecha ='Fecha : '.date("d-m-Y (H:i)", $time);
     $this->Cell(40,50,'SALIDA DE BIENES INFORMATICOS EN PRESTAMO',0,0,'C');
     $this->Cell(65,60,$fecha,0,0,'C');


      $this->Ln(40);
  }

  // Pie de p�gina
  function Footer()
  {
      // Posici�n: a 1,5 cm del final
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // N�mero de p�gina
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
  }

  // Creaci�n del objeto de la clase heredada
  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFont('Times','',12);
  /*for($i=1;$i<=10;$i++)
      $pdf->Cell(0,5,'Imprimiendo l�nea n�mero '.$i,0,1);*/
  //echo "holi";
  $fila=70;
      while($row = mysqli_fetch_array($res_pcs)){
        /*Nombre
        ID_Sitio
        Observaciones*/
        //$pdf->Cell(0,0,$row['Nombre'].' ',0,1);
        $pdf->Text(15,$fila,($row['Nombre']),0,'C', 0);
        $pdf->Text(30,$fila,($row['ID_Sitio']),0,'C', 0);
        echo $row['Nombre'];
        //$pdf->Cell(30,2,$row['ID_Sitio'],0,1);
        //$pdf->Cell(0,0,$row['Ape_Paterno'],0,1);
        $fila=$fila+5;
        }

  $pdf->SetXY(20, 200);
  $pdf->Text(24,200,('NOMBRE Y FIRMA DE QUIEN'),0,'C', 0);
  $pdf->Cell(10, 8, 'ENTREGA EL EQUIPO EN PRESTAMO', 0, 'L');
  $pdf->Line(15, 214, 100, 214);

  $pdf->SetXY(125, 200);
  $pdf->Text(130,200,('NOMBRE Y FIRMA DE QUIEN'),0,'C', 0);
  $pdf->Cell(10, 8, ('RECIBE EL EQUIPO EN PRESTAMO'), 0, 'L');
  $pdf->Line(120, 214, 200, 214);
  //$pdf->Output();
}
else {
  echo "Error en la conexion, intentelo mas tarde.";
}
?>
