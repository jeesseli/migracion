<?
include("conexion.php");
$conexion=conectar();
?>

<br><br>
<center><h2><b>Consulta de Resguardos</b></h2>
<table width="900" border="0" align="center">
    	<tr align="center">
      		<td  bgcolor="#CCCCCC">Empleado</td>
      		<td  bgcolor="#CCCCCC">Nombre</td>
            <td  bgcolor="#CCCCCC">Observaciones</td>
            <td  bgcolor="#CCCCCC">REPORTE</td>
    	</tr>
    	<?php
		$consulta=mysql_query("select * FROM resguardo");
		$cantidad = mysql_num_rows($consulta);
	    if (isset($_POST['buscar'])){
			$consulta=mysql_query("select * FROM resguardo where usuario like '%".$_POST['buscar']."%'");
		}

		while($filas=mysql_fetch_array($consulta)){
			$empleado=$filas['Empleado'];
			$nombre=$filas['Nombre'];
			$observaciones=$filas['observaciones'];
        ?>
    	<tr>
      		<td><?php echo $empleado ?></td>
      		<td><?php echo $nombre ?></td>
            <td align="center"><?php echo $observaciones ?></td>
            </td>
            <td align="center"><form action="reporte.php" method="post" name="reporte">
        		  
        		  <input type="submit" value="Generar" alt="cambio" title="Generar Reporte PDF"/>
      		    </form>
            </td>
    	</tr>
    	<p>
      	<?php }?>
   	  </table>
</p>
<p align="center">
<a href="index.html">REGRESAR</a>
</p>
</body>
</html>
