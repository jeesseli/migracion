<?php
$server     = 'localhost'; //servidor
$user   = 'root'; //usuario de la base de datos
$pass   = ''; //password del usuario de la base de datos
$db   = 'migracion'; //nombre de la base de datos

$conexion = @new mysqli($server, $user, $pass, $db);

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}else{
	$sql="SELECT * from sitios";
	$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
	if ($result->num_rows > 0){ //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		$combobit="";
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$combobit .=" <option value='".$row['ID_Sitio']."'>".$row['ID_Sitio']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
		}
	}
	else{echo "No hubo resultados";}
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

	$sql3="SELECT * from equipos";
	$result3 = $conexion->query($sql3); //usamos la conexion para dar un resultado a la variable
	if ($result2->num_rows > 0){ //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		$combobit3="";
		while ($row3 = $result3->fetch_array(MYSQLI_ASSOC))
		{
			$combobit3 .=" <option value='".$row3['ID_Tipo_Equipo']."'>".$row3['Descripcion_Equipo']."</option>";
		}
	}
	else{$combobit3 .=" <option>Sin resultados</option>";}


}
$conexion->close(); //cerramos la conexión
?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $("#monitor").click(function(evento){
    if ($("#monitor").prop("checked")){
      $("#form_Monitor").css("display", "block");
    }else{
      $("#form_Monitor").css("display", "none");
    }
  });
});
</script>
<script>
$(document).ready(function(){
  $("#Mouse").click(function(evento){
    if ($("#Mouse").prop("checked")){
      $("#form_Mouse").css("display", "block");
    }else{
      $("#form_Mouse").css("display", "none");
    }
  });
});
</script>
<script>
$(document).ready(function(){
  $("#UPS").click(function(evento){
    if ($("#UPS").prop("checked")){
      $("#form_UPS").css("display", "block");
    }else{
      $("#form_UPS").css("display", "none");
    }
  });
});
</script><script>
  $(document).ready(function(){
  $("#Teclado").click(function(evento){
    if ($("#Teclado").prop("checked")){
      $("#form_Teclado").css("display", "block");
    }else{
      $("#form_Teclado").css("display", "none");
    }
  });
});
</script>

<form id="guardarDatos" action="agregar.php" method="POST"  enctype="multipart/form-data">
<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Agregar Equipos</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax_register"></div>
          <div class="form-group">
            <label for="descripcion" class="control-label">Descripcion:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required maxlength="30">
		  </div>
      <div class="form-group">
            <label for="imagen" class="control-label">Imagen:</label>
            <input type="file" name="imagen" id="imagen">
      </div>
		  <div class="form-group">
			<label for="tipo_equipo" class="control-label">Tipo de Equipo:</label>
			<select name="tipo_equipo">
			   <?php echo $combobit3; ?>
			 </select>
		 </div>
		 <div class="form-group">
  <label for="res">Resguardo:</label>
  <select NAME="res" class="form-control" id="res">
    <option>Si</option>
    <option>No</option>
    </select>
</div>
		  <div class="form-group">
            <label for="equipo_marca" class="control-label">Marca:</label>
            <input type="text" class="form-control" id="equipo_marca" name="marca" required maxlength="45">
          </div>
		  <div class="form-group">
            <label for="equipo_modelo" class="control-label">Modelo:</label>
            <input type="text" class="form-control" id="equipo_modelo" name="modelo" required maxlength="40">
          </div>
		  <div class="form-group">
            <label for="equipo_serie" class="control-label">Serie:</label>
            <input type="text" class="form-control" id="equipo_serie" name="serie" required maxlength="40">
          </div>
		  <div class="form-group">
            <label for="num_inv" class="control-label">Numero de inventario:</label>
            <input type="number" class="form-control" id="num_inv" name="numinv" required maxlength="30">
          </div>
		             <input type="checkbox" name="Monitorcheck" value="1" id="monitor"> Monitor
          <div id="form_Monitor" style="display: none;">
          <input type="text" name="monitor_marca" placeholder="Marca del Monitor">
           <input name="monitor_mod" type="text"  placeholder="Modelo del Monitor">
		   <input name="monitor_serie" type="text"  placeholder="Serie del Monitor">
           </div>

        <input type="checkbox" name="Tecladocheck" value="2" id="Teclado"> Teclado
          <div id="form_Teclado" style="display: none;">
           <input type="text" name="teclado_marca" placeholder="Marca del Teclado">
		   <input name="teclado_mod" type="text"  placeholder="Modelo del Teclado">
          <input name="teclado_serie" type="text"  placeholder="Serie del Teclado">
        </div>

        <input type="checkbox" name="Mousecheck" value="3" id="Mouse"> Mouse
          <div id="form_Mouse" style="display: none;">
         <input type="text" name="mouse_marca" placeholder="Marca del Mouse">
			<input name="mouse_mod" type="text"  placeholder="Modelo del Mouse">
           <input name="mouse_serie" type="text"  placeholder="Serie del Mouse">
        </div>

        <input type="checkbox" name="UPScheck" value="4" id="UPS"> UPS
          <div id="form_UPS" style="display: none;">
			<input type="text" name="ups_marca" placeholder="Marca del UPS">
            <input name="ups_mod" type="text"  placeholder="Modelo del UPS">
           <input name="ups_serie" type="text"  placeholder="Serie del UPS">
        </div>

		<br>
		<div class="form-group">
		<label for="sitio" class="control-label">Sitio:</label>
			<select name="sitio">
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
        <button type="submit" class="btn btn-primary">Guardar datos</button>
      </div>
    </div>
  </div>
</div>
</form>
