<?php
$id_resguardo= $_REQUEST['resguardo'];
require('../fpdf/fpdf.php');

$con=@mysqli_connect('localhost', 'root', '', 'migracion');
if(!$con){
    die("imposible conectarse: ".mysqli_error($con));
}
if (@mysqli_connect_errno()) {
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}

//echo "-> ".$id_resguardo;
if ($con ){
  $sql=mysqli_query($con,"Select * from resguardo Where id_resguardos =".$id_resguardo);
  $res_pcs=mysqli_query($con,"SELECT resguardo_invpcs. * , inv_pcs . * FROM resguardo_invpcs LEFT JOIN inv_pcs ON resguardo_invpcs.id_inv_pcs = inv_pcs.ID_Equipo WHERE resguardo_invpcs.id_resguardo =".$id_resguardo);
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
     $this->Cell(65,65,$fecha,0,0,'C');


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
  $pdf->Text(25,60,('Descripcion'),0,'C');
  $pdf->Text(65,60,('Equipo Serie'),0,'C', 0);
  $pdf->Text(110,60,('Equipo Modelo'),0,'C', 0);
      while($row = mysqli_fetch_array($res_pcs)){
        /*Nombre
        ID_Sitio
        Observaciones*/
        //$pdf->Cell(0,0,$row['Nombre'].' ',0,1);
        $pdf->Text(25,$fila,($row['Descripcion']),0,'C', 0);
        $pdf->Text(65,$fila,($row['Equipo_Serie']),0,'C', 0);
        $pdf->Text(110,$fila,($row['Equipo_Modelo']),0,'C', 0);
        //echo $row['Nombre'];
        //$pdf->Cell(30,2,$row['ID_Sitio'],0,1);
        //$pdf->Cell(0,0,$row['Ape_Paterno'],0,1);
        $fila=$fila+7;
        }
        $pdf->Text(25,180,('Observaciones : '),0,'C');
        $ob="";
        while($row2 = mysqli_fetch_array($sql)){

          //$n_observacion =wordwrap($text, 20, "<br />\n");
          //$pdf->MultiCell(177,6,'nnnn',0,'J');
          $ob=$row2['Observaciones'];
          //$pdf->Text(25,190,($row2['Observaciones']),0,'C', 0);
        }
        $y = $pdf->GetY();
        $pdf->SetXY(20,190);
        $pdf->MultiCell(177,6,$ob,0,'J');
        $pdf->SetXY(20,$y);

  $pdf->SetXY(20, 220);
  $pdf->Text(24,220,('NOMBRE Y FIRMA DE QUIEN'),0,'C', 0);
  $pdf->Cell(10, 8, 'ENTREGA EL EQUIPO EN PRESTAMO', 0, 'L');
  $pdf->Line(15, 234, 100, 234);

  $pdf->SetXY(125, 220);
  $pdf->Text(130,220,('NOMBRE Y FIRMA DE QUIEN'),0,'C', 0);
  $pdf->Cell(10, 8, ('RECIBE EL EQUIPO EN PRESTAMO'), 0, 'L');
  $pdf->Line(120, 234, 200, 234);
  $pdf->Output();
}
else {
  echo "Error en la conexion, intentelo mas tarde.";
}
?>
