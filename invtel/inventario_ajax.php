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
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM inv_tel ");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'inventarioTel.php';
		//consulta principal para recuperar los datos
			$query = mysqli_query($con,"Select * from inv_tel LIMIT $offset,$per_page");
		
		
		
		if ($numrows>0){
			?>
			<script type="text/javascript">
			$(document).ready(function(){                 
			 function search(){ 
				  var term=$("#filtrar").val();
				  if(term!=""){
					//$("#result").html("<img alt="ajax search" src='ajax-loader.gif'/>");
					 $.ajax({
						type:"post",
						url:"busqueda.php",
						//data:"term="+term,
						data: {term: term},
						success:function(data){
							/*var table = document.getElementById("myTable");
							var row = table.insertRow();    
							row.insertCell(0).innerHTML =document.getElementById("ID_Equipo").value;*/
							$("table#tabla_tel  tbody").html(data);
							//table#resultTable tbody
							//$("#result").html(data);
							//$("#search").val("");
						 }
					  });
				  }                                           
			 }                    
			  $('#filtrar').keyup(function(e) {
				 if(e.keyCode == 13) {
					search();
				  }
			  });
		});		
      </script>  	 
<div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="filtrar" type="text" class="form-control" placeholder="Buscar">
</div>			
		<table class="table table-bordered" id="tabla_tel">
		
			  <thead>
				<tr>
				<th></th>			
				  <th>Serie</th>
				  <th>Descripcion</th>
				  <th> Tipo Equipo</th>
				  <th>Marca</th>
				  <th>Modelo</th>
				  <th>Uni</th>
				  <th>Ext</th>
				  <th>Ip</th>
				  <th>Inventario</th>
				  <th> Sitio </th>
				  <th> Propietario</th>
				  <th> Descripcion propietario</th>
				  <th>Empleado</th>
				  
				  
				</tr>
			</thead>
		<tbody class="buscar">
			<?php while($row = mysqli_fetch_array($query)){?>
			<tr>
				<td>	 	
				<?php $muestra= "show('".$row['ID_Tel']."')";?>
                 <input type="checkbox" class="select-row"  onclick="<?php echo $muestra;?>"> 
							 				
				<div id="<?php echo $row['ID_Tel'];?>" style="display: none;">
					<?php echo $row['ID_Tel'];?>								
					<button type="button" class="btn-primary" data-toggle="modal" 
					data-target="#dataUpdate" 
					data-id="<?php echo $row['ID_Tel']?>"
					data-tipo-equipo="<?php echo $row['ID_Tipo_Tel']?>"
					data-descripcion="<?php echo $row['Descripcion']?>"
					data-marca="<?php echo $row['Marca']?>"
					data-modelo="<?php echo $row['Modelo']?>"
					data-serie="<?php echo $row['Serie']?>" 
					data-uni="<?php echo $row['Uni']?>"
					data-ext="<?php echo $row['Ext']?>"
					data-ip="<?php echo $row['IP']?>"
					data-inventario="<?php echo $row['Inventario']?>"
					data-sitio="<?php echo $row['ID_Sitio']?>"
					data-propietario="<?php echo $row['ID_Propietario']?>"					
					data-empleado="<?php echo $row['Empleado']?> " >
					<i class='glyphicon glyphicon-edit'></i> Modificar</button>
					
					<button type="button" class="btn btn-danger" 
					data-toggle="modal" 
					data-target="#dataDelete"
					data-id="<?php echo $row['ID_Tel']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button></div>
				  
				    <td><?php echo $row['Serie'];?></td>
				 	<td><?php echo$row['Descripcion'];?></td>
					<td><?php echo $row['ID_Tipo_Tel']?></td>
					<td><?php echo $row['Marca'];?></td>
					<td><?php echo $row['Modelo'];?></td>
					<td><?php echo $row['Uni'];?></td>
					<td><?php echo $row['Ext'];?></td>
					<td><?php echo $row['IP'];?></td>
					<td><?php echo $row['Inventario'];?></td>
					<td><?php echo $row['ID_Sitio'];?></td>
					<td><?php echo $row['ID_Propietario'];?></td>
					<td><?php echo $row['Propietario'];?></td>
					<td><?php echo $row['Empleado'];?></td>
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