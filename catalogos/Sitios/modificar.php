<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('display_errors', '1');

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
		
		$sitio=mysqli_real_escape_string($con,(strip_tags($_POST["sitio"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
		$instancia=mysqli_real_escape_string($con,(strip_tags($_POST["instancia"],ENT_QUOTES)));
		$domicilio=mysqli_real_escape_string($con,(strip_tags($_POST["domicilio"],ENT_QUOTES)));
		$municipio=mysqli_real_escape_string($con,(strip_tags($_POST["municipio"],ENT_QUOTES)));
		$enlace=mysqli_real_escape_string($con,(strip_tags($_POST["enlace"],ENT_QUOTES)));
		
		$id=mysqli_real_escape_string($con,(strip_tags($_POST["sitio"],ENT_QUOTES)));
		
		$sql="UPDATE sitios  SET  ID_Sitio='".$sitio."', Estado='".$estado."',Instancia='".$instancia."',
		Domicilio='".$domicilio."', Municipio='".$municipio."', Enlace='".$enlace."' WHERE ID_Sitio=".$id.";";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Los datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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
							<script>setTimeout('document.location.reload()',X* 1000); </script>
				</div>
				<?php
			}

?>