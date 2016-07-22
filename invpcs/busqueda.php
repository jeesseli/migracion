<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "", "migracion");
	
//$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT * FROM  inv_pcs WHERE Equipo_Serie like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	//$fetch = mysqli_query($con,"SELECT * FROM productos where codigo_producto like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	printf("Error: %s\n", mysqli_error($con));
	/*
	$('#Equipo_Serie').val(ui.item.Equipo_Serie);
					$('#Descripcion').val(ui.item.Descripcion);
					$('#Equipo_Modelo').val(ui.item.Equipo_Modelo);
					$('#ID_Equipo').val(ui.item.ID_Equipo);
	*/
	$found=mysql_num_rows($fetch);
	 
	 if($found>0){
		while($row= mysqli_fetch_array($fetch)){
		echo "<tr><td>".$row['ID_Equipo']."</td></tr>";
		}   
	 }else{
		echo "<tr>No Tutorial Found</tr>";
	 }
	/*while ($row = mysqli_fetch_array($fetch)) {

		
		$ID_Equipo=$row['ID_Equipo'];
		$row_array['value'] = $row['Equipo_Serie']." | ".$row['Descripcion'];
		$row_array['ID_Tipo_Equipo'] = $row['ID_Tipo_Equipo'];
		$row_array['Equipo_Marca'] = $row['Equipo_Marca'];
		$row_array['Equipo_Modelo'] = $row['Equipo_Modelo'];
		$row_array['Equipo_Serie'] = $row['Equipo_Serie'];
		 $row_array['Equipo_numinv'] =$row['Equipo_numinv'];
		 $row_array['Monitor_Marca'] =$row['Monitor_Marca'];
		 $row_array['Monitor_Modelo'] =$row['Monitor_Modelo'];
		 $row_array['Monitor_Serie'] =$row['Monitor_Serie'];
		 $row_array['Teclado_Marca'] =$row['Teclado_Marca'];
		 $row_array['Teclado_Modelo'] =$row['Teclado_Modelo'];
		 $row_array['Teclado_Serie'] =$row['Teclado_Serie'];
		 $row_array['Mouse_Marca'] =$row['Mouse_Marca'];
		 $row_array['Mouse_Modelo'] =$row['Mouse_Modelo'];
		 $row_array['Mouse_Serie'] =$row['Mouse_Serie'];
		 $row_array['Ups_Marca'] =$row['Ups_Marca'];
		 $row_array['Ups_Modelo'] =$row['Ups_Modelo'];
		 $row_array['Ups_Serie'] =$row['Ups_Serie'];
		 $row_array['ID_Sitio'] =$row['ID_Sitio'];
		 $row_array['ID_Propietario'] =$row['ID_Propietario'];
		 $row_array['Propietario'] =$row['Propietario'];
		 $row_array['Empleado'] =$row['Empleado'];
		//array_push($return_arr,$row_array);
    }*/	
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
//echo json_encode($return_arr);
}
?>