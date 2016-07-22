<?php

//error_reporting(E_ALL);
ini_set('display_errors', '1');
//error_reporting(-1);
	# conectare la base de datos
    $con=@mysqli_connect('localhost', 'root', '', 'migracion');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		include '/../pagination.php';  //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM resguardo ");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'resguardos.php';
		//consulta principal para recuperar los datos
			$query = mysqli_query($con,"Select * from resguardo LIMIT $offset,$per_page");
		
		
		
		if ($numrows>0){
			?>
	<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="filtrar" type="text" class="form-control" placeholder="Buscar">
</div>		
			
		<table class="table table-bordered" >
		
			  <thead>
				<tr>
				<th></th>			
				  <th>Fecha</th>
				  <th>Empleado</th>
				  <th>Delegacion</th>
				  <th>Nombre<th>
				   <th>Apellido Paterno<th>
				    <th>Apellido Materno<th>
				  <th>Descripcion</th>
				  <th>Serie</th>
				  <th>Modelo</th>
				  <th>Observaciones</th>
				  <th>Empleado</th>
				  
				  
				</tr>
			</thead>
		<tbody>
			<?php while($row = mysqli_fetch_array($query)){?>
			<tr>
				<td>	 	
				<?php $muestra= "show('".$row['id_resguardos']."')";?>
                 <input type="checkbox" class="select-row"  onclick="<?php echo $muestra;?>"> 
							 				
				<div id="<?php echo $row['id_resguardos'];?>" style="display: none;">
					<?php echo $row['id_resguardos'];?>								
				  
				</tr>
				<?php
			}			
			?>
			</tbody>
		</table>
		<script type="text/javascript">
			function show(bloq) {
			  obj = document.getElementById(bloq);
			 obj.style.display = (obj.style.display=='none') ? 'block' : 'none';
			}
		</script>
		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	}
?>