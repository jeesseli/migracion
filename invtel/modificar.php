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
	 if (empty($_POST['descripcion'])){
			$errors[] = "Descripcion vacío";
		} else if (empty($_POST['marca'])){
			$errors[] = "Marca vacío";
		} else if (empty($_POST['modelo'])){
			$errors[] = "Modelo vacío";
		} else if (empty($_POST['serie'])){
			$errors[] = "Serie vacío";
		} else if (empty($_POST['uni'])){
			$errors[] = "Uni vacío";
		} else if (empty($_POST['ext'])){
			$errors[] = "Ext vacío";
		} else if (empty($_POST['ip'])){
			$errors[] = "IP vacío";
		} else if (empty($_POST['inventario'])){
			$errors[] = "Inventario vacío";
		}else if (
			!empty($_POST['descripcion']) && 
			!empty($_POST['marca']) &&
			!empty($_POST['modelo']) &&
			!empty($_POST['serie']) &&
			!empty($_POST['uni']) &&
			!empty($_POST['ext']) &&
			!empty($_POST['ip']) &&
			!empty($_POST['inventario']) 
		
			
		){
			
				session_start();
				
		$tipotel=(int)($_POST['telefono']);	
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));
		$serie=mysqli_real_escape_string($con,(strip_tags($_POST["serie"],ENT_QUOTES)));
		$uni=mysqli_real_escape_string($con,(strip_tags($_POST["uni"],ENT_QUOTES)));
		$ext=mysqli_real_escape_string($con,(strip_tags($_POST["ext"],ENT_QUOTES)));
		$ip=mysqli_real_escape_string($con,(strip_tags($_POST["ip"],ENT_QUOTES)));
		$inv=mysqli_real_escape_string($con,(strip_tags($_POST["inventario"],ENT_QUOTES)));
		$id=(int)($_POST['id']);
		$sitio=(int)($_POST['sitio']);
		$empleado=$_SESSION['usuario']['empleado'];		
		$propietario=(int)($_POST['propietario']);	
		$telefono_des="";
		$propietario_des='';
				
		$consult="select * from propietarios where ID_Propietario=".$propietario;
		$result = $con->query($consult); //usamos la conexion para dar un resultado a la variable	 
		if ($result->num_rows > 0){ //si la variable tiene al menos 1 fila entonces seguimos con el codigo				
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$propietario_des=$row['Descripcion_propietario'];
			}
		}		
		$consult2="selet * from telefonos where ID_Tipo_Tel=".$telefono_des;
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$propietario_des=$row['Descripcion'];
			}
		}
		$sql="UPDATE inv_tel  SET  Descripcion='".$descripcion."', Marca='".$marca."',Modelo='".$modelo."',
		Serie='".$serie."', Uni='".$uni."', Ext='".$ext."',
		IP='".$ip."', Inventario='".$inv."', Empleado='".$empleado."', ID_Sitio=".$sitio.",ID_Propietario=".$propietario.",Propietario='".$propietario_des."'
		,ID_Tipo_Tel=".$tipotel.",Descripcion=".$telefono_des.",
		WHERE ID_Tel=".$id.";";
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