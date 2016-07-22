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
	 if (empty($_POST['emp'])){
			$errors[] = "Empleado vacío";
			} else if (empty($_POST['usu'])){
			$errors[] = "Usuario vacío";
		} else if (empty($_POST['pass'])){
			$errors[] = "Contraseña vacío";
		}   else if (!empty($_POST['emp'])&&
			!empty($_POST['usu']) &&
			!empty($_POST['pass']) 
			
		){

		// escaping, additionally removing everything that could be (html/javascript-) code
		$emp=mysqli_real_escape_string($con,(strip_tags($_POST["emp"],ENT_QUOTES)));
			$usu=mysqli_real_escape_string($con,(strip_tags($_POST["usu"],ENT_QUOTES)));
		$pass=mysqli_real_escape_string($con,(strip_tags($_POST["pass"],ENT_QUOTES)));
		$sql="INSERT INTO usuarios(empleado, usuario,pass) VALUES
		('".$emp."','".$usu."','".$pass."')";
		$query_update = mysqli_query($con,$sql);
	
			if ($query_update){
				$messages[] = "Los datos han sido guardados satisfactoriamente.";
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