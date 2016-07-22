<?php

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
	 if  (empty($_POST['descripcion'])){
			$errors[] = "Descripcion vacío";
		} else if (empty($_POST['equipo_marca'])){
			$errors[] = "Marca vacío";
		} else if (empty($_POST['equipo_modelo'])){
			$errors[] = "Modelo vacío";
		} else if (empty($_POST['equipo_serie'])){
			$errors[] = "Serie vacío";
		} else if (empty($_POST['numinv'])){
			$errors[] = "Numero de Inventario vacío";
		}   else if (
			!empty($_POST['id']) && 
			!empty($_POST['descripcion']) && 
			!empty($_POST['equipo_marca']) &&
			!empty($_POST['equipo_modelo']) &&
			!empty($_POST['equipo_serie']) &&
			!empty($_POST['numinv'])
			
		){
				session_start();

		// escaping, additionally removing everything that could be (html/javascript-) code
		//$ID_Equipo=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));	
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST["equipo_marca"],ENT_QUOTES)));
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["equipo_modelo"],ENT_QUOTES)));
		$serie=mysqli_real_escape_string($con,(strip_tags($_POST["equipo_serie"],ENT_QUOTES)));
		$resguardo=mysqli_real_escape_string($con,(strip_tags($_POST["resguardo"],ENT_QUOTES)));
		$numinv=(int)($_POST['numinv']);
		$monitor_marca=mysqli_real_escape_string($con,(strip_tags($_POST["monitor_marca"],ENT_QUOTES)));
		$monitor_mod=mysqli_real_escape_string($con,(strip_tags($_POST["monitor_mod"],ENT_QUOTES)));
		$monitor_serie=mysqli_real_escape_string($con,(strip_tags($_POST["monitor_serie"],ENT_QUOTES)));
		$teclado_marca=mysqli_real_escape_string($con,(strip_tags($_POST["teclado_marca"],ENT_QUOTES)));
		$teclado_mod=mysqli_real_escape_string($con,(strip_tags($_POST["teclado_mod"],ENT_QUOTES)));
		$teclado_serie=mysqli_real_escape_string($con,(strip_tags($_POST["teclado_serie"],ENT_QUOTES)));
		$mouse_marca=mysqli_real_escape_string($con,(strip_tags($_POST["mouse_marca"],ENT_QUOTES)));
		$mouse_mod=mysqli_real_escape_string($con,(strip_tags($_POST["mouse_mod"],ENT_QUOTES)));
		$mouse_serie=mysqli_real_escape_string($con,(strip_tags($_POST["mouse_serie"],ENT_QUOTES)));
		$ups_marca=mysqli_real_escape_string($con,(strip_tags($_POST["ups_marca"],ENT_QUOTES)));
		$ups_mod=mysqli_real_escape_string($con,(strip_tags($_POST["ups_mod"],ENT_QUOTES)));
		$ups_serie=mysqli_real_escape_string($con,(strip_tags($_POST["ups_serie"],ENT_QUOTES)));
		
		
		$id=(int)($_POST['id']);
		$sitio=(int)($_POST['sitio']);
		$empleado=$_SESSION['usuario']['empleado'];		
		$propietario=(int)($_POST['propietario']);		
		$tipo_equipo=(int)($_POST['tipo_equipo']);		
		// esto sera para obtener la descripcion del propietario
		$propietario_des='';
				
		$consult="select * from propietarios where ID_Propietario=".$propietario;
		$result = $con->query($consult); //usamos la conexion para dar un resultado a la variable	 
		if ($result->num_rows > 0){ //si la variable tiene al menos 1 fila entonces seguimos con el codigo				
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$propietario_des=$row['Descripcion_propietario'];
			}
		}	
		//////
		
		
		$sql="UPDATE inv_pcs  SET  descripcion='".$descripcion."', equipo_marca='".$marca."',
		equipo_modelo='".$modelo."', equipo_serie='".$serie."', equipo_numinv=".$numinv.", monitor_marca='".$monitor_marca."',
		monitor_modelo='".$monitor_mod."', monitor_serie='".$monitor_serie."', teclado_marca='".$teclado_marca."', 
		teclado_modelo='".$teclado_mod."', teclado_serie='".$teclado_serie."', mouse_marca='".$mouse_marca."',
		mouse_modelo='".$mouse_mod."', mouse_serie='".$mouse_serie."', ups_marca='".$ups_marca."', 
		ups_modelo='".$ups_mod."', ups_modelo='".$ups_mod."', ups_serie='".$ups_serie."', resguardo='".$resguardo."', empleado='".$empleado."',
		ID_Sitio=".$sitio.",ID_Propietario=".$propietario.",Propietario='".$propietario_des."',ID_Tipo_Equipo=".$tipo_equipo."
		WHERE ID_Equipo=".$id.";";
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
							<!--<script>setTimeout('document.location.reload()',X* 1000); </script>
				--></div>
				<?php
				/*if(sizeof($errors)==0){
					header("Location: \SistemaDeInventarios\invpcs\inventario.php"); //redirecciona a la pagina.		
				}*/
			}

?>