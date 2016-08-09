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
	include '../../pagination.php';		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 300; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM personal ");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'personal.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"SELECT * FROM personal order by ID_Personal LIMIT $offset,$per_page");
		
		if ($numrows>0){
			
			?>
		
			
		<table class="table table-bordered" >
		
			  <thead>
				<tr>
				<th></th>			
				  <th>Empleado</th>
				  <th>Nombre</th>
				  <th>Apellido Paterno</th>
				  <th>Apellido Materno</th>
				  <th>Puesto</th>
				  <th>RFC</th>
				  <th>Curp</th>
				  <th>Sitio</th>
				  
				  
				</tr>
			</thead>
		<tbody>
			<?php while($row = mysqli_fetch_array($query)){?>
			<tr>
				<td>	 	
				<?php $muestra= "show('".$row['ID_Personal']."')";?>
                 <input type="checkbox" class="select-row"  onclick="<?php echo $muestra;?>"> 
							 				
				<div id="<?php echo $row['ID_Personal'];?>" style="display: none;">
					<?php echo $row['Empleado'];?>								
					<button type="button" class="btn-primary" data-toggle="modal" 
					data-target="#dataUpdate" 
					data-id="<?php echo $row['ID_Personal']?>"
					data-emp="<?php echo $row['Empleado']?>"
					data-nom="<?php echo $row['Nombre']?>"
					data-pat="<?php echo $row['Ape_Paterno']?>"
					data-mat="<?php echo $row['Ape_Materno']?>"
					data-pues="<?php echo $row['Puesto']?>" 
					data-rfc="<?php echo $row['RFC']?>"
					data-curp="<?php echo $row['Curp']?>"
					data-sit="<?php echo $row['ID_Sitio']?>">
					<i class='glyphicon glyphicon-edit'></i> Modificar</button>
					
					<button type="button" class="btn btn-danger" 
					data-toggle="modal" 
					data-target="#dataDelete"
					data-id="<?php echo $row['ID_Personal']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button></div>
				  </td>	
				 			 					<td><?php echo$row['Empleado'];?></td>
					<td><?php echo $row['Nombre'];?></td>
					<td><?php echo $row['Ape_Paterno'];?></td>
					<td><?php echo $row['Ape_Materno'];?></td>
					<td><?php echo $row['Puesto'];?></td>
					<td><?php echo $row['RFC'];?></td>
					<td><?php echo $row['Curp'];?></td>
					<td><?php echo $row['ID_Sitio'];?></td>
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