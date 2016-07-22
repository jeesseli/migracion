<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "", "migracion");
	
$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT * FROM  personal WHERE empleado like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	while ($row = mysqli_fetch_array($fetch)) {
		$ID_Personal=$row['ID_Personal'];
		$row_array['value'] = $row['Empleado']." | ".$row['Nombre'];
		$row_array['ID_Personal']=$row['ID_Personal'];
		$row_array['Empleado']=$row['Empleado'];
		$row_array['Nombre']=$row['Nombre'];
		$row_array['Ape_Paterno']=$row['Ape_Paterno'];
		$row_array['Ape_Materno']=$row['Ape_Materno'];
		$row_array['ID_Sitio']=$row['ID_Sitio'];
		array_push($return_arr,$row_array);
    }
	
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>