<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "", "migracion");

$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT * FROM  inv_pcs WHERE Equipo_Serie like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	//printf("Error: %s\n", mysqli_error($con));

	while ($row = mysqli_fetch_array($fetch)) {
      if($row['resguardo']=='NO'){
    		$ID_Equipo=$row['ID_Equipo'];
    		$row_array['value'] = $row['Equipo_Serie']." | ".$row['Descripcion'];
    		$row_array['ID_Equipo']=$row['ID_Equipo'];
    		$row_array['Equipo_Serie']=$row['Equipo_Serie'];
    		$row_array['Descripcion']=$row['Descripcion'];
    		$row_array['Equipo_Modelo']=$row['Equipo_Modelo'];
    		array_push($return_arr,$row_array);
        }
    }

}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
