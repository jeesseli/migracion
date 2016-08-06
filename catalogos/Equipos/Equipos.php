
<!DOCTYPE html>
<html lang="en" width="100%" height="100%">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Equipos</title>
<link href="../../js/bootstrap.min.css" rel="stylesheet">
<?php
session_start();
if(!isset($_SESSION['usuario']['id_usuario']) || !strcmp ($_SESSION['tipo'],'ADMIN')==0){	
	//include("cerrar.php");	
	header("Location: \SistemaDeInventarios\login.php");	
}
?>
  </head>
  <body>
  <a href="http://www.gobernacion.gob.mx/" target="_blank" alt="SEGOB"><img src="../../img/Logo1.png" style="padding-left: 400px;"></a>
	 <a href="http://www.inm.gob.mx/" target="_blank" alt="INM"> <img src="../../img/Logo2.png"></a>
	
<img class="img-responsive" src="../../img/b.png"  width="100%" height="100%" > 
  <?php include("modal_agregar.php");?>
  <?php include ("modal_modificar.php");?>
  <?php include ("modal_eliminar.php");?>

  <h2 class='col-xs-30'>
	<?php 
	echo "Hola <br>" ;
	echo $_SESSION['usuario']['nombre']. "";
	?>
</h2>
  
 
    <div class="container-fluid">
	 
		<div class='col-xs-10'>	
			<h3> Equipos</h3>

		</div>
		
		<div class='col-xs-5'>
			<h3 class='text-right'>		
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#dataRegister"><i class='glyphicon glyphicon-plus'></i> Agregar</button>
			<a href="../exportar.php" class="btn btn-default">exportar</a>
			</h3>
		</div>
	  <div class="row">
		
		
		
		<div class="col-xs-12">
		
		<div id="loader" class="text-center"> </div>
		
		<div class="outer_div"></div><!-- Datos ajax Final -->
		</div>
	  </div>
	</div>

	<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js" ></script>
<script src="../../js/tipo_equipo.js"></script>
	<script>
		$(document).ready(function(){
			load(1);
		});
	</script>
	
	<div class="datos_ajax_delete"></div><!-- Datos ajax Final --></div>
 
 </body>
</html>