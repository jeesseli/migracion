
<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
error_reporting(-1);
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
		include '/../pagination.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM inv_pcs ");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'pcs.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"Select * from inv_pcs LIMIT $offset,$per_page");

		if ($numrows>0){
			?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


  <script type="text/javascript">
        /*$(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
		*/


		$(document).ready(function(){
			 function search(){
				  var term=$("#filtrar").val();
				  if(term!=""){
					//$("#result").html("<img alt="ajax search" src='ajax-loader.gif'/>");
					 $.ajax({
						type:"post",
						url:"busqueda2.php",
						//data:"term="+term,
						data: {term: term},
						success:function(data){
							/*var table = document.getElementById("myTable");
							var row = table.insertRow();
							row.insertCell(0).innerHTML =document.getElementById("ID_Equipo").value;*/
							$("table#tabla_pcs  tbody").html(data);
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
		<table class="table table-bordered" id="tabla_pcs">

			  <thead>
				<tr>
				<th></th>
          <th>Imagen</th>
					<th>Serie</th>
				   <th>Descripcion</th>
				  <th>Marca</th>
				  <th>Modelo</th>
				  <th>Numero de inventario</th>
				  <th>Monitor Marca</th>
				  <th>Monitor Modelo</th>
				  <th>Monitor Serie</th>
				  <th>Teclado Marca</th>
				  <th>Teclado Modelo</th>
				  <th>Teclado Serie</th>
				  <th>Mouse Marca</th>
				  <th>Mouse Modelo</th>
				  <th>Mouse Serie</th>
				  <th>Ups Marca</th>
				  <th>Ups Modelo</th>
				  <th>Ups Serie</th>
				  <th>Sitio</th>
				  <th>ID Propietario</th>
				  <th>Descripcion Propietario</th>
				  <th>Empleado</th>


				</tr>
			</thead>
			<tbody class="buscar">
			<?php while($row = mysqli_fetch_array($query)){?>
			<tr>
				<td>
				<?php $muestra= "show('".$row['ID_Equipo']."')";?>
                 <input type="checkbox" class="select-row"  onclick="<?php echo $muestra;?>">

				<div id="<?php echo $row['ID_Equipo'];?>" style="display: none;">
					<?php echo $row['ID_Equipo'];?>
					<button type="button" class="btn-primary" data-toggle="modal"
					data-target="#dataUpdate"
					data-id="<?php echo $row['ID_Equipo']?>"
					data-tipo-equipo="<?php echo $row['ID_Tipo_Equipo']?>"
					data-equipo_serie="<?php echo $row['Equipo_Serie']?>"
					data-equipo_marca="<?php echo $row['Equipo_Marca']?>"
					data-equipo_modelo="<?php echo $row['Equipo_Modelo']?>"
					data-numinv="<?php echo $row['Equipo_numinv']?>"
					data-monitor_marca="<?php echo $row['Monitor_Marca']?>"
					data-monitor_modelo="<?php echo $row['Monitor_Modelo']?>"
					data-monitor_serie="<?php echo $row['Monitor_Serie']?>"
					data-teclado_marca="<?php echo $row['Teclado_Marca']?>"
					data-teclado_modelo="<?php echo $row['Teclado_Modelo']?>"
					data-teclado_serie="<?php echo $row['Teclado_Serie']?>"
					data-mouse_marca="<?php echo $row['Mouse_Marca']?>"
					data-mouse_modelo="<?php echo $row['Mouse_Modelo']?>"
					data-mouse_serie="<?php echo $row['Mouse_Serie']?>"
					data-ups_marca="<?php echo $row['Ups_Marca']?>"
					data-ups_modelo="<?php echo $row['Ups_Modelo']?>"
					data-ups_serie="<?php echo $row['Ups_Serie']?>"
					data-resguardo="<?php echo $row['resguardo']?>"
					data-sitio="<?php echo $row['ID_Sitio']?>"
					data-propietario="<?php echo $row['ID_Propietario']?>"
					data-imagen="<?php echo $row['imagen']?>"
					data-empleado="<?php echo $row['Empleado']?> " >
					<i class='glyphicon glyphicon-edit'></i> Modificar</button>
					<button type="button" class="btn btn-danger"
					data-toggle="modal"
					data-target="#dataDelete"
					data-id="<?php echo $row['ID_Equipo']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button></div>
				  </td>
					<td>
						<?php
            if(strlen($row['imagen'])>0){
						        echo'<a href="'.$row['imagen'].'" rel="lightbox['.$row['Equipo_Modelo'].']" data-lightbox="roadtrip"><img src="'.$row['imagen'].'" width="100px" height="100px" alt="'.$row['Equipo_Modelo'].'"></a></td>';
            }else{
              echo "Sin imagen";
            }
						?>

					</td>


				<td><?php echo $row['Equipo_Serie'];?></td>
			
					<td><?php echo $row['ID_Tipo_Equipo'];?></td>
					<td><?php echo $row['Equipo_Marca'];?></td>
					<td><?php echo $row['Equipo_Modelo'];?></td>
					<td><?php echo $row['Equipo_numinv'];?></td>
					<td><?php echo $row['Monitor_Marca'];?></td>
					<td><?php echo $row['Monitor_Modelo'];?></td>
					<td><?php echo $row['Monitor_Serie'];?></td>
					<td><?php echo $row['Teclado_Marca'];?></td>
					<td><?php echo $row['Teclado_Modelo'];?></td>
					<td><?php echo $row['Teclado_Serie'];?></td>
					<td><?php echo $row['Mouse_Marca'];?></td>
					<td><?php echo $row['Mouse_Modelo'];?></td>
					<td><?php echo $row['Mouse_Serie'];?></td>
					<td><?php echo $row['Ups_Marca'];?></td>
					<td><?php echo $row['Ups_Modelo'];?></td>
					<td><?php echo $row['Ups_Serie'];?></td>
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
