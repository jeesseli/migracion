<?php
/*echo "holis";
echo "-->".$_POST['usuario'][Nombre];
$table = $_POST['tabla'];
echo ".....".$table[1];
*/
$con=@mysqli_connect('localhost', 'root', '', 'migracion');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }	
	$empleado =(int)($_POST['usuario'][Empleado]);
	$nombre =mysqli_real_escape_string($con,(strip_tags($_POST['usuario'][Nombre],ENT_QUOTES)));
	$ape_pat =mysqli_real_escape_string($con,(strip_tags($_POST['usuario'][Ape_Paterno],ENT_QUOTES)));
	$ape_mat =mysqli_real_escape_string($con,(strip_tags($_POST['usuario'][Ape_Materno],ENT_QUOTES)));
	$sitio =(int)($_POST['usuario'][ID_Sitio]);	
	$observaciones =mysqli_real_escape_string($con,(strip_tags($_POST['usuario'][Observaciones],ENT_QUOTES)));	

	$sql="INSERT INTO resguardo (Empleado, Nombre, Ape_Paterno, Ape_Materno, ID_Sitio, Observaciones) VALUES(
	".$empleado.",
	'".$nombre."',
	'".$ape_pat."',
	'".$ape_mat."',
	".$sitio.",
	'".$observaciones."')";
	$query_update = mysqli_query($con,$sql);	
		if ($query_update){
			$id_Resguardo = $con->insert_id;
			echo $id_Resguardo;
			//$messages[] = "Los datos han sido guardados satisfactoriamente.";
			echo "\nExito!!";
			$table = $_POST['tabla'];
			echo "\n elementos en la tabla--".count($table);
			for ($i=0; $i < count($table); $i++) { 
				mysqli_query($con,"INSERT INTO resguardo_invpcs (id_resguardo,id_inv_pcs) VALUES(".$id_Resguardo.",".$table[$i].")");
			}
			echo "\n Exito x2";
			//$sql2="INSERT INTO resguardo_invpcs (id_resguardo,id_inv_pcs) VALUES(".$id_Resguardo.",".$.")";
		} else{
			//$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			echo "Lo siento algo ha salido mal intenta nuevamente.";

		}
	
	
	if (isset($errors)){
		
		?>
		
		<?php
		}
		if (isset($messages)){
			
			?>
			<?php
		}

?>