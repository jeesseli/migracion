<?php
$server     = 'localhost'; //servidor
$user   = 'root'; //usuario de la base de datos
$pass   = ''; //password del usuario de la base de datos
$db   = 'migracion'; //nombre de la base de datos
 
$conexion = @new mysqli($server, $user, $pass, $db);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}
 
$sql="SELECT * from sitios";

$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
 
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['ID_Sitio']."'>".$row['ID_Sitio']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{echo "No hubo resultados";}
$sql2="SELECT * from propietarios";
	$result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable	 
	if ($result2->num_rows > 0){ //si la variable tiene al menos 1 fila entonces seguimos con el codigo	
		$combobit2="";
		while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
		{
			$combobit2 .=" <option value='".$row2['ID_Propietario']."'>".$row2['Descripcion_propietario']."</option>";
		}
	}
	else{$combobit2 .=" <option>Sin resultados</option>";}
	
	$sql3="SELECT * from telefonos";
	$result3 = $conexion->query($sql3); //usamos la conexion para dar un resultado a la variable	 
	if ($result2->num_rows > 0){ //si la variable tiene al menos 1 fila entonces seguimos con el codigo	
		$combobit3="";
		while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) 
		{
			$combobit3 .=" <option value='".$row3['ID_Tipo_Tel']."'>".$row3['Descripcion']."</option>";
		}
	}
	else{$combobit3 .=" <option>Sin resultados</option>";}
$conexion->close(); //cerramos la conexión
?>
<form id="actualizarDatos">
<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Modificar Telefonos</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax"></div>
 <div class="form-group">
            <label for="descripcion" class="control-label">Descripcion:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required maxlength="30">
		  <input type="hidden" class="form-control" id="id" name="id">
		  </div>
		   <div class="form-group">
			<label for="tipo_telefono" class="control-label">Tipo de Telefonos:</label>
			<select name="telefono">
			   <?php echo $combobit3;?>
			 </select>
		 </div>
		  <div class="form-group">
            <label for="marca" class="control-label">Marca:</label>
            <input type="text" class="form-control" id="marca" name="marca" required maxlength="45">
          </div>
		  <div class="form-group">
            <label for="modelo" class="control-label">Modelo:</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required maxlength="40">
          </div>
		  <div class="form-group">
            <label for="serie" class="control-label">Serie:</label>
            <input type="text" class="form-control" id="serie" name="serie" required maxlength="40">
          </div>
		  <div class="form-group">
            <label for="uni" class="control-label">UNI:</label>
            <input type="text" class="form-control" id="uni" name="uni" required maxlength="30"> 
          </div>

		  		  <div class="form-group">
            <label for="ext" class="control-label">EXT:</label>
            <input type="number" class="form-control" id="ext" name="ext" required maxlength="30"> 
          </div>

		  <div class="form-group">
            <label for="ip" class="control-label">IP:</label>
            <input type="number" class="form-control" id="ip" name="ip" required maxlength="30"> 
          </div>
		  <div class="form-group">
            <label for="inventario" class="control-label">Inventario:</label>
            <input type="number" class="form-control" id="inventario" name="inventario" required maxlength="30"> 
          </div>

		  <div class="form-group">
		<label for="sitio" class="control-label">Sitio:</label>
			<select name="sitio" id="sitio">
			   <?php echo $combobit; ?>
			 </select>
		 </div>
		 
		   <div class="form-group">
			<label for="propietario" class="control-label">Propietario:</label>
			<select name="propietario">
			   <?php echo $combobit2; ?>
			 </select>
		 </div>
        
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar datos</button>

		</div>
    </div>
  </div>
</div>
</form>
