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
{
    echo "No hubo resultados";
}
$conexion->close(); //cerramos la conexión
?>

<form id="actualizarDatos">
<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Modificar Sitio</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax"></div>
			
			       <div class="form-group">
            <label for="nombre" class="control-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" >
			<input type="hidden" class="form-control" id="id" pattern="[a-zA-Z]*" name="id">
		  </div>
		  <div class="form-group">
            <label for="pat" class="control-label">Apellido Paterno:</label>
            <input type="text" class="form-control" id="pat" pattern="[a-zA-Z]*" name="pat" >
          </div>
		  <div class="form-group">
            <label for="mat" class="control-label">Apellido Materno:</label>
            <input type="text" class="form-control" id="mat" pattern="[a-zA-Z]*"name="mat" >
          </div>
		  <div class="form-group">
            <label for="empleado" class="control-label">Empleado:</label>
            <input type="number" class="form-control" id="empleado" name="empleado" >
          </div>
		  <div class="form-group">
            <label for="puesto" class="control-label">Puesto:</label>
            <input type="text" class="form-control" id="puesto" pattern="[a-zA-Z]*" name="puesto"> 
          </div>

		  		  <div class="form-group">
            <label for="rfc" class="control-label">RFC:</label>
            <input type="text" class="form-control" id="rfc" name="rfc"> 
          </div>

		  <div class="form-group">
            <label for="curp" class="control-label">Curp:</label>
            <input type="text" class="form-control" id="curp" name="curp"> 
          </div>

		  <select name="sitio" id="sitio">
		   <?php echo $combobit; ?>
		 </select>
		 
			       
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar datos</button>

		</div>
    </div>
  </div>
</div>
</form>
