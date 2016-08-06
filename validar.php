<?php
if(isset($_POST["password"])&& isset($_POST["usuario"])){
$con=mysql_connect("localhost","root","");
$base=mysql_select_db("migracion",$con);
$consulta=mysql_query("select * from usuarios where usuario='".$_POST["usuario"]."' and pass='".$_POST["password"]."'");
if(mysql_num_rows($consulta)>0)
{
	session_start();
	while($row =mysql_fetch_array($consulta)){
		$_SESSION['usuario']['id_usuario']=$row['ID_Usuarios'];
		$_SESSION['tipo']=$row['Tipo'];		
		$_SESSION['usuario']['empleado']=$row['Empleado'];
		$empleado = $row[1];				
	}
$subconsulta =mysql_query("SELECT personal. * , sitios.Instancia FROM personal LEFT JOIN sitios ON personal.ID_Sitio =
 sitios.ID_Sitio WHERE Empleado =".$_SESSION['usuario']['empleado']);

	if(mysql_num_rows($subconsulta) > 0){
		while($row2 =mysql_fetch_array($subconsulta)){
			$_SESSION['usuario']['nombre']=$row2['Nombre'];
			$_SESSION['usuario']['id_sitio']=$row2['ID_Sitio'];				
			$_SESSION['usuario']['instancia']=$row2['Instancia'];
		}


		include("valida_session.php");	
	}else{
		session_destroy();
		echo "<center><p>Error</p></center>";
		echo '<script type="text/javascript">setTimeout(function() { location.href="login.php" } , 2000); </script>';
	}
	/*if(strcmp ($_SESSION['tipo'],'ADMIN')==0){
		header("Location: PaginaPrincipal.php"); //redirecciona a la pagina.		
	}else{
		header("Location: MenuCatalogo.php"); //redirecciona a la pagina.		
	}*/
?>

<?php
}
else
{
echo "<center><p> Datos de acceso incorrectos</p></center>";
echo '<script type="text/javascript">setTimeout(function() { location.href="login.php" } , 2000); </script>';
}
}
?>