<!DOCTYPE html>
<html lang="en" width="100%" height="100%">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Resguardos</title>
	 <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
<link href="../js/bootstrap.min.css" rel="stylesheet">
	
  </head>
  <body>
  <a href="http://www.gobernacion.gob.mx/" target="_blank" alt="SEGOB"><img src="../img/Logo1.png" style="padding-left: 400px;"></a>
	 <a href="http://www.inm.gob.mx/" target="_blank" alt="INM"> <img src="../img/Logo2.png"></a>
	
<img class="img-responsive" src="../img/b.png"  width="100%" height="100%" > 
  <?php include ("modal_eliminar.php");?>
    <?php include ("modal_modificar.php");?>
  <div>
 <h3 class='col-xs-20'>
	<?php 
	echo "Hola <br>" ;
session_start();
if(!isset($_SESSION['usuario']['id_usuario'])){
	
	header("Location: \SistemaDeInventarios\login.php"); 
	
}
echo $_SESSION['usuario']['nombre']. "";
	?>
</h3></div>
 
    <div class="container-fluid">
	 
		<div class='col-xs-10'>	
			<h3> Resguardos</h3>

		</div>
		<div>
		
		</div>
		
	  <div class="row">	
		<div class="col-xs-12">
		
		<div id="loader" class="text-center"> </div>
		
		<div class="outer_div"></div><!-- Datos ajax Final -->
		</div>
	  </div>
	</div>


	<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js" ></script>
<script src="../js/resguardos.js"></script>
	<script>
		$(document).ready(function(){
			load(1);
		});
	</script>
	
	<div class="datos_ajax_delete"></div><!-- Datos ajax Final --></div>
 
 </body>
</html>