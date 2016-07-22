<?php

session_start();
if(isset($_SESSION["usuario"]))
{
	//header("Location:PaginaPrincipal.php");
	if(strcmp ($_SESSION['tipo'],'ADMIN')==0){
		header("Location: \SistemaDeInventarios\PaginaPrincipal.php"); //redirecciona a la pagina.		
	}else{
		header("Location: \SistemaDeInventarios\MenuCatalogo.php"); //redirecciona a la pagina.		
	}
}
	?>
<html lang="es"
><head>
<title>Iniciar Sesion</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
 <meta name="viewport" content="width=device-width, initial-scale=1">

<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/elegant-icons-style.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet" />
</head>
<body class="login-img3-body">
  <a href="http://www.gobernacion.gob.mx/" target="_blank" alt="SEGOB"><img src="img/Logo1.png" style="padding-left: 400px;"></a>
  <a href="http://www.inm.gob.mx/" target="_blank" alt="INM"> <img src="img/Logo2.png"></a>  
  <img class="img-responsive" src="img/b.png" background-position:bottom;>

  <form class="login-form" role="form" action="validar.php" method="POST" style="
  margin-top: 50px;    margin-bottom: 50px;">        
  <div class="login-wrap">
    <p class="login-img"><img src="img/usu.png"></i></p>


    <div class="input-group">

      <span class="input-group-addon"><i class="icon_profile"></i></span>

      <input name="usuario"type="text"id="usuario"class="form-control" placeholder="usuario" autofocus title="usuario">
    </div>
    <div class="input-group">
      <span class="input-group-addon"><i class="icon_key_alt"></i></span>
      <input  name="password"type="password" id="password" class="form-control" placeholder="pass" title="pass">
    </div>


    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="entrar">Inicia Sesion</button>
	<!-- <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#dataRegisterlogin"><i class='glyphicon glyphicon-plus'></i> Agregar</button>
	-->
  </div>
</form>

</div>


</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
<script src="js/bootstrap.min.js" ></script>

 
</body></html>