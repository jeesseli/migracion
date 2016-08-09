<!DOCTYPE html>
<html lang="en"  class="no-js" width="100%" height="100%">
	<head>
		<meta charset="UTF-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Menu principal</title>
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
		  <link href="css/elegant-icons-style.css" rel="stylesheet" />
	  

	</head>
	<body>
	
	<a href="http://www.gobernacion.gob.mx/" target="_blank" alt="SEGOB"><img src="img/Logo1.png" style="padding-left: 400px;"></a>
	 <a href="http://www.inm.gob.mx/" target="_blank" alt="INM"> <img src="img/Logo2.png"></a>
	
  <section id="contact">
        <div id="wrapper">
   
	 <header>
<img class="img-responsive" src="img/b.png"  width="100%" height="100%" > 
	 </header>
	 <div>
<h2 class='col-xs-30'>
	<?php 
	echo "Hola <br>" ;
session_start();
if(!isset($_SESSION['usuario']['id_usuario']) || !strcmp ($_SESSION['tipo'],'ADMIN')==0){
	include("cerrar.php");
	header("Location: \SistemaDeInventarios\login.php");	
}
echo $_SESSION['usuario']['nombre']. "";
	?>
</h2>

	
	<p><p><p>
	<div class="main clearfix"  style="padding-left: 50px;">
	 <nav id="menu" class="nav" >	 

					<ul>
						<li>
							<a href="catalogos/Personal/personal.php">
								<span class="icon">
									<i aria-hidden="true" class="icon_documents"></i>
								</span>
								<span>Personal</span>
								</a>
								</li>
								<li>
							<a href="catalogos/Sitios/Sitios.php"">
								<span class="icon">
									<i aria-hidden="true" class="icon_documents"></i>
								</span>
								<span>Sitios</span>
								</a>
								</li>
						
								<li>
							<a href="catalogos/Propietarios/propietarios.php">
							<span class="icon">
							<i aria-hidden="true" class="icon_box-checked"></i>
							</span>
							<span>Propietarios</span>
							</a>
						</li>
						<li>
							<a href="catalogos/Equipos/Equipos.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-team"></i>
								</span>
								<span>Equipos</span> 
								
							</a>
						</li>
						<li>
							<a href="catalogos/Telefonos/telefono_index.php">
								<span class="icon">
									<i aria-hidden="true" class="icon_telephone"></i>
								</span>
								<span>Telefono</span> 
								
							</a>
						</li>
						<li>
							<a href="catalogos/Usuarios/usuarios.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-team"></i>
								</span>
								<span>Usuarios</span> 
								
							</a>
						</li>
						
						<li>
							<a href="cerrar.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-team"></i>
								</span>
								<span>Salir</span> 
								
							</a>
						</li>
						
					</ul>
				</nav>
			</div>
		</div>
	

		<script>
				var changeClass = function (r,className1,className2) {
				var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
				if( regex.test(r.className) ) {
					r.className = r.className.replace(regex,' '+className2+' ');
			    }
			    else{
					r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"),' '+className1+' ');
			    }
			    return r.className;
			};	
			var menuElements = document.getElementById('menu');
			menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> Menu</button>');

			document.getElementById('menutoggle').onclick = function() {
				changeClass(this, 'navtoogle active', 'navtoogle');
			}
			document.onclick = function(e) {
				var mobileButton = document.getElementById('menutoggle'),
					buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

				if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
					changeClass(mobileButton, 'navtoogle active', 'navtoogle');
				}
			}
		</script>
	</body>
</html>