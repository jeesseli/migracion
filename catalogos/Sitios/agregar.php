<?php
/*error_reporting(E_ALL);
error_reporting(-1);
ini_set('display_errors', '1');*/

	# conectare la base de datos
    $con=@mysqli_connect('localhost', 'root', '', 'migracion');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	/*Inicia validacion del lado del servidor*/
	 if (empty($_POST['sitio'])){
			$errors[] = "Sitio vacío";
		} else if (empty($_POST['estado'])){
			$errors[] = "Estado vacío";
		} else if (empty($_POST['instancia'])){
			$errors[] = "Instancia vacío";
			} else if (empty($_POST['domicilio'])){
			$errors[] = "Domicilio vacío";
		} else if (empty($_POST['municipio'])){
			$errors[] = "Municipio vacío";
		} else if (empty($_POST['enlace'])){
			$errors[] = "Enlace vacío";
		}else if (
			!empty($_POST['sitio']) && 
			!empty($_POST['estado']) &&
			!empty($_POST['instancia']) &&
			!empty($_POST['domicilio']) &&
			!empty($_POST['municipio']) &&
			!empty($_POST['enlace']) 
		
			
		){

		// escaping, additionally removing everything that could be (html/javascript-) code
		//$ID_Equipo=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));	
		$sitio=mysqli_real_escape_string($con,(strip_tags($_POST["sitio"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
		$instancia=mysqli_real_escape_string($con,(strip_tags($_POST["instancia"],ENT_QUOTES)));
		$domicilio=mysqli_real_escape_string($con,(strip_tags($_POST["domicilio"],ENT_QUOTES)));
		$municipio=mysqli_real_escape_string($con,(strip_tags($_POST["municipio"],ENT_QUOTES)));
		$enlace=mysqli_real_escape_string($con,(strip_tags($_POST["enlace"],ENT_QUOTES)));
		
		/* 
		
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["des"],ENT_QUOTES)));
		$sql="INSERT INTO telefonos (Descripcion) VALUES
		('".$descripcion."'	)";
		$query_update = mysqli_query($con,$sql);
				
		*/
		$sql="INSERT INTO sitios(ID_Sitio,Estado,Instancia,Domicilio,Municipio,Enlace) VALUES
		(".$sitio.",'".$estado."','".$instancia."','".$domicilio."','".$municipio."','".$enlace."' )";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Los datos han sido guardados satisfactoriamente.";
			} else{
				$errors []= "Sitio -Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>