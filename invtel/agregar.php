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


		// escaping, additionally removing everything that could be (html/javascript-) code
		//$ID_Equipo=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));	
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));
		$serie=mysqli_real_escape_string($con,(strip_tags($_POST["serie"],ENT_QUOTES)));
		$uni=mysqli_real_escape_string($con,(strip_tags($_POST["uni"],ENT_QUOTES)));
		$ext=mysqli_real_escape_string($con,(strip_tags($_POST["ext"],ENT_QUOTES)));
		$ip=mysqli_real_escape_string($con,(strip_tags($_POST["ip"],ENT_QUOTES)));
		$inv=mysqli_real_escape_string($con,(strip_tags($_POST["inventario"],ENT_QUOTES)));
		$empleado=$_SESSION['usuario']['empleado'];
		$sitio=mysqli_real_escape_string($con,(strip_tags($_POST["sitio"],ENT_QUOTES)));
		// $sit=mysqli_real_escape_string($con,(strip_tags($_POST["sitio"],ENT_QUOTES)));
		$propietario=(int)($_POST['propietario']);
		$tipo_telefono=(int)($_POST['tipo_telefono']);
		
		$propietario_des='';
		$consult="select * from propietarios where ID_Propietario=".$propietario;
		$result = $con->query($consult); //usamos la conexion para dar un resultado a la variable	 
		if ($result->num_rows > 0){ //si la variable tiene al menos 1 fila entonces seguimos con el codigo				
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$propietario_des=$row['Descripcion_propietario'];
			}
		}
		
		$tel_des='';
		$consult2="select * from telefonos where ID_Tipo_Tel=".$tipo_telefono;
		$result = $con->query($consult); //usamos la conexion para dar un resultado a la variable	 
		if ($result->num_rows > 0){ //si la variable tiene al menos 1 fila entonces seguimos con el codigo				
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$tel_des=$row['Descripcion'];
			}
		}
		
		$sql="INSERT INTO inv_tel(Descripcion, Marca,Modelo, Serie,Uni,Ext,IP,Inventario, ID_Sitio,ID_Propietario,Propietario,Empleado,ID_Tipo_Tel) VALUES
		('".$descripcion."','".$marca."','".$modelo."','".$serie."','".$uni."',
		".$ext.",".$ip.",".$inv.",'".$sitio."',".$propietario.",'".$propietario_des."',
		".$empleado.",".$tipo_telefono.",".$tel_des.")";
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