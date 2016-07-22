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
		} else if (empty($_POST['numinv'])){
			$errors[] = "Numero de Inventario vacío";
		}   else if (
			!empty($_POST['numinv'])
			
		){
			session_start();

		// escaping, additionally removing everything that could be (html/javascript-) code
		//$ID_Equipo=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));	
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));
		$serie=mysqli_real_escape_string($con,(strip_tags($_POST["serie"],ENT_QUOTES)));
		$res=mysqli_real_escape_string($con,(strip_tags($_POST["res"],ENT_QUOTES)));
		$numinv=mysqli_real_escape_string($con,(strip_tags($_POST["numinv"],ENT_QUOTES)));
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
		$empleado=$_SESSION['usuario']['empleado'];
		$sitio=(int)($_POST['sitio']);
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
		////
		
		$sql="INSERT INTO inv_pcs (descripcion, equipo_marca,equipo_modelo, equipo_serie,Equipo_numinv,monitor_marca,monitor_modelo,monitor_serie,
		teclado_marca,teclado_modelo,teclado_serie,mouse_marca,mouse_modelo,mouse_serie,ups_marca,ups_modelo,ups_serie,resguardo,ID_Sitio,ID_Propietario,Propietario,Empleado,ID_Tipo_Equipo) VALUES
		('".$descripcion."','".$marca."','".$modelo."','".$serie."','".$numinv."','".$monitor_marca."','".$monitor_mod."',
		'".$monitor_serie."','".$teclado_marca."','".$teclado_mod."','".$teclado_serie."','".$mouse_marca."','".$mouse_mod."',
		'".$mouse_serie."', '".$ups_marca."','".$ups_mod."','".$ups_serie."','".$res."',".$sitio.",".$propietario.",'".$propietario_des."',
		".$empleado.",".$tipo_equipo.")";
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
