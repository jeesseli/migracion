<?php

if (PHP_SAPI == 'cli')
	die('Este ejemplo sólo se puede ejecutar desde un navegador Web');


/** Incluye PHPExcel */
require_once dirname(__FILE__) . '../Classes/PHPExcel.php';
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("migracion")
							 ->setLastModifiedBy("migracion")
							 ->setTitle("Office 2010 XLSX Documento de prueba")
							 ->setSubject("Office 2010 XLSX Documento de prueba")
							 ->setDescription("Documento de prueba para Office 2010 XLSX, generado usando clases de PHP.")
							 ->setKeywords("office 2010 openxml php")
							 ->setCategory("Archivo con resultado de prueba");

							 // Combino las celdas desde A1 hasta E1
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:V1');
 
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'REPORTE DE Pcs')
            ->setCellValue('A2', 'DESCRIPCION')
			->setCellValue('B2', 'Tipo Equipo')
            ->setCellValue('C2', 'MARCA')
            ->setCellValue('D2', 'MODELO')
			->setCellValue('E2', 'SERIE')
			->setCellValue('F2', 'NUMERO DE INVENTARIO')
			->setCellValue('G2', 'MONITOR MARCA')
			->setCellValue('H2', 'MONITOR MODELO')
			->setCellValue('I2', 'MONITOR SERIE')
			->setCellValue('J2', 'TECLADO MARCA')
			->setCellValue('K2', 'TECLADO MODELO')
			->setCellValue('L2', 'TECLADO SERIE')
			->setCellValue('M2', 'MOUSE MARCA')
			->setCellValue('N2', 'MOUSE MODELO')
			->setCellValue('O2', 'MOUSE SERIE')
			->setCellValue('P2', 'UPS MARCA')
			->setCellValue('Q2', 'UPS MODELO')
			->setCellValue('R2', 'UPS SERIE')
			->setCellValue('S2', 'Sitio')
			->setCellValue('T2', 'Id Propietario')
			->setCellValue('U2', 'Descripcion del Propietario')
			->setCellValue('V2', 'Empleado');
			
			
// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getStyle('A1:V2')->applyFromArray($boldArray);
 
 //Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);	
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);	
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);	
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);	
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18);	
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);	
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(18);	
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(18);	
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);	

/*Extraer datos de MYSQL*/
	# conectare la base de datos
    $con=@mysqli_connect('localhost', 'root', '', 'migracion');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	$sql="SELECT * FROM inv_pcs order by descripcion";
	$query=mysqli_query($con,$sql);
	$cel=3;//Numero de fila donde empezara a crear  el reporte
	while ($row=mysqli_fetch_array($query)){
		$descripcion=$row['Descripcion'];
		$tipo_equipo=$row['ID_Tipo_Equipo'];
		$marca=$row['Equipo_Marca'];
		$modelo=$row['Equipo_Modelo'];
		$serie=$row['Equipo_Serie'];
		$numinv=$row['Equipo_numinv'];
		$mmarca=$row['Monitor_Marca'];
		$mmodelo=$row['Monitor_Modelo'];
		$mserie=$row['Monitor_Serie'];
		$tmarca=$row['Teclado_Marca'];
		$tmodelo=$row['Teclado_Modelo'];
		$tserie=$row['Teclado_Serie'];
		$mousemarca=$row['Mouse_Marca'];
		$mousemodelo=$row['Mouse_Modelo'];
		$mouseserie=$row['Mouse_Serie'];
		$umarca=$row['Ups_Marca'];
		$umodelo=$row['Ups_Modelo'];
		$userie=$row['Ups_Serie'];
		$sitio=$row['ID_Sitio'];
		$id_propietario=$row['ID_Propietario'];
		$propietario=$row['Propietario'];
		$empleado=$row['Empleado'];
		
			$a="A".$cel;			
			$b="B".$cel;
			$c="C".$cel;			
			$d="D".$cel;
			$e="E".$cel;			
			$f="F".$cel;
			$g="G".$cel;			
			$h="H".$cel;
			$i="I".$cel;			
			$j="J".$cel;
			$k="K".$cel;			
			$l="L".$cel;
			$m="M".$cel;			
			$n="N".$cel;
			$o="O".$cel;			
			$p="P".$cel;
			$q="Q".$cel;			
			$r="R".$cel;
			$s="S".$cel;
			$t="T".$cel;
			$u="U".$cel;
			$v="V".$cel;
			// Agregar datos
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($a, $descripcion)
			->setCellValue($b, $tipo_equipo)
            ->setCellValue($c, $marca)
            ->setCellValue($d, $modelo)
			->setCellValue($e, $serie)
            ->setCellValue($f, $numinv)
			->setCellValue($g, $mmarca)
			->setCellValue($h, $mmodelo)
            ->setCellValue($i, $mserie)
            ->setCellValue($j, $tmarca)
            ->setCellValue($k, $tmodelo)
			->setCellValue($l, $tserie)
			->setCellValue($m, $mousemarca)
            ->setCellValue($n, $mousemodelo)
            ->setCellValue($o, $mouseserie)
            ->setCellValue($o, $umarca)
			->setCellValue($q, $umodelo)
			->setCellValue($r, $userie)
            ->setCellValue($s, $sitio)
		    ->setCellValue($t, $id_propietario)
		    ->setCellValue($u, $propietario)
		    ->setCellValue($v, $empleado);
			
			
	$cel+=1;
	}
	$rango="A2:$v";
$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

/*Fin extracion de datos MYSQL*/
// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Reporte de pcs');
 
 
// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);


// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte_pcs.xls"');
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
header('Cache-Control: max-age=1');
 
// Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>