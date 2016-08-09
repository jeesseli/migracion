<?php
 $con=@mysqli_connect("localhost", "root", "", "migracion");
 
 $term=$_POST["term"];
 //$fetch = mysqli_query($con,"SELECT * FROM  inv_pcs WHERE Equipo_Serie like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
 $result=mysqli_query($con,"SELECT inv_pcs. * , equipos.Descripcion_Equipo FROM inv_pcs LEFT JOIN equipos ON inv_pcs.ID_Tipo_Equipo = equipos.ID_Tipo_Equipo where inv_pcs.Equipo_Serie like '%$term%'");
 $found=mysqli_num_rows($result);
 
 if($found>0){
 	while($row=mysqli_fetch_array($result)){
			echo "<tr><td>";
				$muestra= "show('".$row['ID_Equipo']."')";
				echo '<input type="checkbox" class="select-row" onclick="'.$muestra.' ">';
				echo '<div id="'.$row['ID_Equipo'].'"  style="display: none;">';				
				echo $row['ID_Equipo'];
				echo '<button type="button" class="btn-primary" data-toggle="modal" data-target="#dataUpdate"';
				echo 'data-id="'.$row['ID_Equipo'].'"';
				echo 'data-tipo_equipo="'.$row['ID_Tipo_Equipo'].'"';
				echo 'data-equipo_serie="'.$row['Equipo_Serie'].'"';
				echo 'data-descripcion="'.$row['ID_Tipo_Equipo'].'"';
				echo 'data-equipo_marca="'.$row['Equipo_Marca'].'"';
				echo 'data-equipo_modelo="'.$row['Equipo_Modelo'].'"';
				echo 'data-numinv="'.$row['Equipo_numinv'].'"';
				echo 'data-monitor_marca="'.$row['Monitor_Marca'].'"';
				echo 'data-monitor_modelo="'.$row['Monitor_Modelo'].'"';
				echo 'data-monitor_serie="'.$row['Monitor_Serie'].'"';
				echo 'data-teclado_marca="'.$row['Teclado_Marca'].'"';
				echo 'data-teclado_modelo="'.$row['Teclado_Modelo'].'"';
				echo 'data-teclado_serie="'.$row['Teclado_Serie'].'"';
				echo 'data-mouse_marca="'.$row['Mouse_Marca'].'"';
				echo 'data-mouse_modelo="'.$row['Mouse_Modelo'].'"';
				echo 'data-mouse_serie="'.$row['Mouse_Serie'].'"';
				echo 'data-ups_marca="'.$row['Ups_Marca'].'"';
				echo 'data-ups_modelo="'.$row['Ups_Modelo'].'"';
				echo 'data-ups_serie="'.$row['Ups_Serie'].'"';
				echo 'data-resguardo="'.$row['resguardo'].'"';
				echo 'data-sitio="'.$row['ID_Sitio'].'"';
				echo 'data-propietario="'.$row['ID_Propietario'].'"';				
				echo 'data-imagen="'.$row['imagen'].'">';
				echo 'data-empleado="'.$row['Empleado'].'">';
				echo '<i class="glyphicon glyphicon-edit"></i> Modificar</button>';
				echo '<button type="button" class="btn btn-danger"';
				echo 'data-toggle="modal"  data-target="#dataDelete"';								
				echo 'data-id="'.$row['ID_Equipo'].'"  ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></div>';
				echo '</td>';
				echo '<td>';
				if(strlen($row['imagen'])>0){
					echo'<a href="'.$row['imagen'].'" rel="lightbox['.$row['Equipo_Modelo'].']" data-lightbox="roadtrip"><img src="'.$row['imagen'].'" width="100px" height="100px" alt="'.$row['Equipo_Modelo'].'"></a></td>';
				}else{
					echo "Sin imagen";
				}
				echo '</td>';
				echo '<td>'.$row['Equipo_Serie'].'</td>';
				echo '<td>'.$row['Descripcion_Equipo'].'</td>';				
				echo '<td>'.$row['ID_Tipo_Equipo'].'</td>';
				echo '<td>'.$row['Equipo_Marca'].'</td>';
				echo '<td>'.$row['Equipo_Modelo'].'</td>';
				echo '<td>'.$row['Equipo_numinv'].'</td>';
				echo '<td>'.$row['Monitor_Marca'].'</td>';
				echo '<td>'.$row['Monitor_Modelo'].'</td>';
				echo '<td>'.$row['Monitor_Serie'].'</td>';
				echo '<td>'.$row['Teclado_Marca'].'</td>';
				echo '<td>'.$row['Teclado_Modelo'].'</td>';
				echo '<td>'.$row['Teclado_Serie'].'</td>';
				echo '<td>'.$row['Mouse_Marca'].'</td>';
				echo '<td>'.$row['Mouse_Modelo'].'</td>';
				echo '<td>'.$row['Mouse_Serie'].'</td>';
				echo '<td>'.$row['Ups_Marca'].'</td>';
				echo '<td>'.$row['Ups_Modelo'].'</td>';
				echo '<td>'.$row['Ups_Serie'].'</td>';
				echo '<td>'.$row['ID_Sitio'].'</td>';
				echo '<td>'.$row['ID_Propietario'].'</td>';
				echo '<td>'.$row['Propietario'].'</td>';
				echo '<td>'.$row['Empleado'].'</td>';				
				echo '</tr>';				
	    }   
 }else{
 	echo "<tr> <td colspan='23'>Sin Resultados                                         </td></tr>";
	
 }
 // ajax search
?>