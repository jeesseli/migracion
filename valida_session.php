<?php

if(!isset($_SESSION['usuario']['id_usuario'])){
	//header ("Location: login.php");buu, bubuu		
	header("Location: \SistemaDeInventarios\login.php"); 
	
}else{
	if(strcmp ($_SESSION['tipo'],'ADMIN')==0){
		header("Location: \SistemaDeInventarios\PaginaPrincipal.php"); //redirecciona a la pagina.		
	}else{
		header("Location: \SistemaDeInventarios\MenuCatalogo.php"); //redirecciona a la pagina.		
	}
}
?>