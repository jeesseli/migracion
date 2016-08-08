<?php
if(isset($_POST["password"])&& isset($_POST["usuario"])){
include("conexion_full.php");
/*$con=mysql_connect("localhost","root","");
$base=mysql_select_db("migracion",$con);*/
// mysqli_query($con,"Select * from resguardo LIMIT $offset,$per_page");
$consulta=mysqli_query($con,"select * from usuarios where usuario='".$_POST["usuario"]."' and pass='".$_POST["password"]."'");
if(mysqli_num_rows($consulta)>0)
{
	session_start();
	while($row =mysqli_fetch_array($consulta)){
		$_SESSION['usuario']['id_usuario']=$row['ID_Usuarios'];
		$_SESSION['tipo']=$row['Tipo'];		
		$_SESSION['usuario']['empleado']=$row['Empleado'];
		$empleado = $row[1];				
	}
$subconsulta =mysqli_query($con,"SELECT personal. * , sitios.Instancia FROM personal LEFT JOIN sitios ON personal.ID_Sitio =
 sitios.ID_Sitio WHERE Empleado =".$_SESSION['usuario']['empleado']);

	if(mysqli_num_rows($subconsulta) > 0){
		while($row2 =mysqli_fetch_array($subconsulta)){
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