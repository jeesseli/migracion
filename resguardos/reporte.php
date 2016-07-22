<?php

require('fpdf/fpdf.php');
include("conexion.php");
$conexion=conectar();

class PDF extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		
		$this->Rect($x,$y,$w,$h);

		$this->MultiCell($w,5,$data[$i],0,$a,'true');
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}

function Header()
{
    $this->Image('img/cecyte.jpg' , 20 ,8, 23 , 18,'JPG');
	$this->Image('img/Logo1.png' , 45 ,13, 117 , 20,'png');
	$this->Image('img/Logo2.png' , 163 ,10, 35 , 20,'png');
	
	$this->SetFont('Arial','',11);
	$this->Text(47,40,utf8_decode('"SALIDA DE BIENES INFORMATICOS EN PRESTAMO"'),0,'C', 0);
	
	//$this->SetFont('Arial','',10);
	//$this->Text(120,73,utf8_decode('Asunto: Constancia de Terminación de Estudios'),0,'C', 0);
	$this->Ln(27);
}

}

	$num= $_POST['empleado'];
	$strConsulta = "SELECT * FROM resguardos where id_resguardos =  '$num'";
	$alumno = mysql_query($strConsulta);
	$fila = mysql_fetch_array($alumno);
	
	
	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(55);

	
	$pdf->SetFont('Arial','',11);
	//$pdf->MultiCell(177,6, utf8_decode('El que suscribe, Encargado(a) del Departamento de Titulación del CECyTE. Hace constar que el (a) C. '.utf8_decode($fila['nombre']).', con Clave ').utf8_decode($fila['clave_emp']). utf8_decode('; concluyó sus actividades en la empresa ').utf8_decode($fila['empresa'].', de la ciudad de  '.$fila['ciudad']). utf8_decode('; con un salario base de ').utf8_decode($fila['salario_base']) ,0,'J');
	
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $pdf->Ln(8);
	
	$pdf->MultiCell(177,6,utf8_decode('A petición del interesado, se expide la presente en la H. ciudad de Juchitán de Zaragoza, Oaxaca. A los '." ".date('d')." dias del mes de ".$meses[date('n')-1]. " de ".date('Y')."." ),0,'J');
    $pdf->Ln(50);
	
	$pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255); 
  
	
	$pdf->SetXY(20, 230);
    $pdf->Cell(70, 5, '______________________', 0, 0, 'C', 1);     
    
	
	
	$pdf->SetXY(145, 230);
    $pdf->Cell(10, 5, '_______________________________________', 0, 0, 'C', 1);
	
	$pdf->SetXY(20, 235);
    $pdf->Cell(70, 5, 'Nombre Y Firma De Quien ', 0, 0, 'C', 1);     
	
	$pdf->SetXY(110, 235);
    $pdf->Cell(80, 5, 'Nombre Y FIRMA DE QUIEN', 0, 0, 'C', 1);
	
	$pdf->SetXY(20, 240);
    $pdf->Cell(70, 5, 'RECIBE EL EQUIPO EN PRESTAMO', 0, 0, 'C', 1);  
	
	$pdf->SetXY(110, 240);
    $pdf->Cell(80, 5, 'ENTREGA EL EQUIPO EN PRESTAMO', 0, 0, 'C', 1);             
    $y      =   130;
    
	
$pdf->Output();
?>