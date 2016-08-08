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
	if (empty($_POST['empleado'])){
			$errors[] = "Empleado vacío";
		} else if (empty($_POST['nombre'])){
			$errors[] = "Nombre vacio";
			} else if (empty($_POST['pat'])){
			$errors[] = "Apellido Paterno vacio";
		} else if (empty($_POST['mat'])){
			$errors[] = "Apellido  Materno vacío";
		} else if (empty($_POST['puesto'])){
			$errors[] = "Puesto vacío";
		} else if (empty($_POST['rfc'])){
			$errors[] = "RFC vacío";
		} else if (empty($_POST['curp'])){
			$errors[] = "CURP vacío";
		} else if (empty($_POST['sitio'])){
			$errors[] = "Sitio vacío";
		}else if (
			!empty($_POST['empleado']) && 
			!empty($_POST['nombre']) && 
			!empty($_POST['pat']) &&
			!empty($_POST['mat']) &&
			!empty($_POST['puesto']) &&
			!empty($_POST['rfc']) &&
			!empty($_POST['curp']) &&
			!empty($_POST['sitio']) 
		
			
		){

		// escaping, additionally removing everything that could be (html/javascript-) code
		//$ID_Equipo=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));	
		$em=mysqli_real_escape_string($con,(strip_tags($_POST["empleado"],ENT_QUOTES)));
		$nom=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$pat=mysqli_real_escape_string($con,(strip_tags($_POST["pat"],ENT_QUOTES)));
		$mat=mysqli_real_escape_string($con,(strip_tags($_POST["mat"],ENT_QUOTES)));
		$pues=mysqli_real_escape_string($con,(strip_tags($_POST["puesto"],ENT_QUOTES)));
		$rfc=mysqli_real_escape_string($con,(strip_tags($_POST["rfc"],ENT_QUOTES)));
		$curp=mysqli_real_escape_string($con,(strip_tags($_POST["curp"],ENT_QUOTES)));
		//$sit=mysqli_real_escape_string($con,(strip_tags($_POST["sitio"],ENT_QUOTES)));
		$sit=mysqli_real_escape_string($con,(strip_tags($_POST["sitio"],ENT_QUOTES)));
		
	
		$id=(int)($_POST['id']);
		
		$sql="UPDATE personal  SET  Empleado='".$em.",', Nombre='".$nom."',Ape_Paterno='".$pat."',
		Ape_Materno='".$mat."', Puesto='".$pues."', RFC='".$rfc."',
		Curp='".$curp."', ID_Sitio='".$sit."'  WHERE ID_Personal=".$id.";";
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
							
				</div>
				<?php
			}

?>