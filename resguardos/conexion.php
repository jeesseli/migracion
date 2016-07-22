<?php 
   function conectar()
   {
	$servidor="localhost";
	$usuario="root";
	$password="";
	$bd="migracion";
	$conexion=mysql_connect($servidor,$usuario,$password);
	if (!$conexion)
	{
		echo"ERROR AL CONECTARCE CON EL SERVIDOR";
		exit();
	}

	$coneccion=mysql_select_db($bd,$conexion);

	if (!$coneccion)
	{
		echo"ERROR AL ABRIR LA BASE DE DATOS";
		exit();
	}
     	return ($conexion);
   }
?>