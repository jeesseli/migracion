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
$conexion->close(); //cerramos la conexión
?>

<form id="actualizarDatos" action="modificar.php" method="POST"  enctype="multipart/form-data">

<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Modificar Equipos</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax"></div>

		  <div class="form-group">
			<label for="tipo_equipo" class="control-label">Tipo de Equipo:</label>
			<select name="tipo_equipo">
			   <?php echo $combobit3; ?>
			 </select>
		 </div>
		 <div class="form-group">
  <label for="res">Resguardo:</label>
  <select name="resguardo" class="form-control" id="resguardo">
    <option value="SI">Si</option>
    <option value="NO">No</option>
    </select>
</div>
		  <div class="form-group">
            <label for="equipo_marca" class="control-label">Marca:</label>
            <input type="text" class="form-control" id="equipo_marca" name="equipo_marca">
          </div>
		  <div class="form-group">
            <label for="equipo_modelo" class="control-label">Modelo:</label>
            <input type="text" class="form-control" id="equipo_modelo" name="equipo_modelo">
          </div>
		  <div class="form-group">
            <label for="equipo_serie" class="control-label">Serie:</label>
            <input type="text" class="form-control" id="equipo_serie" name="equipo_serie">
          </div>
		  <div class="form-group">
            <label for="num_inv" class="control-label">Numero de inventario:</label>
            <input type="number" class="form-control" id="numinv" name="numinv">
          </div>


          <div class="form-group col-xs-6">
		  <p><label>Monitor</label></p>
          <label for="monitor_marca" class="control-label">Marca :</label>
		  <input type="text" name="monitor_marca" id="monitor_marca" >
		  <label for="monitor_mod" class="control-label">Modelo: </label>
		  <input name="monitor_mod" type="text"  id="monitor_mod">
		  <label for="monitor_serie" class="control-label">Serie: </label>
		  <input name="monitor_serie" type="text" id="monitor_serie" >
		</div>

 <div class="form-group col-xs-6" >
<p><label>Teclado</label></p>
		<label for="teclado_marca" class="control-label"> Marca: </label>
           <input type="text" name="teclado_marca" id="teclado_marca" >
		   <label for="teclado_mod" class="control-label">Modelo: </label>
		   <input name="teclado_mod" type="text"  id="teclado_mod">
		   <label for="teclado_serie" class="control-label">Serie:  </label>
		   <input name="teclado_serie" type="text"  id="teclado_mod" >
	</div>
 <div class="form-group col-xs-6" >
 <p><label>Mouse</label></p>
          <label for="mouse_marca" class="control-label">Marca: </label>
		   <input type="text" name="mouse_marca" id="mouse_marca" >
		   <label for="mouse_mod" class="control-label"> Modelo: </label>
			<input name="mouse_mod" type="text"  id="mouse_mod" >
			<label for="mouse_serie" class="control-label">Serie: </label>
           <input name="mouse_serie" type="text" id="mouse_serie">
       </div>

	 <div class="form-group col-xs-6">
	 <p><label>Ups</label></p>
	   <label for="ups_marca" class="control-label">Marca: </label>
			<input type="text" name="ups_marca" id="ups_marca" >
			<label for="ups_mod" class="control-label">Modelo: </label>
            <input name="ups_mod" type="text" id="ups_mod" >
			<label for="ups_serie" class="control-label">Serie: </label>
		   <input name="ups_serie" type="text" id="ups_serie" >
       		</div>
        <div class="form-group">
		<label for="sitio" class="control-label">Sitio:</label>
			<select name="sitio" id="sitio">
			   <?php echo $combobit; ?>
			 </select>
		 </div>
     <br>
     <div>
       <input name="imagen_original" type="hidden" id="imagen_original" >
       <br>
            <img id="imagen" name="imagen" style="width:200px; height:200px" />
            <label for="imagen">Imagen</b>:</label><br />
            <input type="file" name="imagen_update" id="imagen_update">
            <br><output id="list2"></output>
     </div>
		 <br>


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
<script type="text/javascript">
      $("#imagen_update").change(function() {
            var val = $(this).val();
            switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
                case 'gif': case 'jpg': case 'jpeg': case 'png':
                    break;
                default:
                    $(this).val('');
                    // error message here
                    alert("Esto no es una Imagen");
                    break;
            }
        });
      </script>
<script type="text/javascript">
function archivo(evt) {
var files = evt.target.files; // FileList object

// Obtenemos la imagen del campo "file".
for (var i = 0, f; f = files[i]; i++) {
  //Solo admitimos imágenes.
  if (!f.type.match('image.*')) {
      continue;
  }

  var reader = new FileReader();

  reader.onload = (function(theFile) {
      return function(e) {
        // Insertamos la imagen
       document.getElementById("list2").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
      };
  })(f);

  reader.readAsDataURL(f);
}
}
document.getElementById('imagen_update').addEventListener('change', archivo, false);
</script>
</form>
