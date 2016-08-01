<?php
 $con=@mysqli_connect("localhost", "root", "", "migracion");
 
 $term=$_POST["term"];
 //$fetch = mysqli_query($con,"SELECT * FROM  inv_pcs WHERE Equipo_Serie like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
 $result=mysqli_query($con,"SELECT * FROM  inv_tel WHERE Serie like '%$term%'");
 $found=mysqli_num_rows($result);
 
 if($found>0){
 	while($row=mysqli_fetch_array($result)){
			echo "<tr><td>";
				$muestra= "show('".$row['ID_Tel']."')";
				echo '<input type="checkbox" class="select-row" onclick="'.$muestra.' ">';
				echo '<div id="'.$row['ID_Tel'].'"  style="display: none;">';				
				echo $row['ID_Tel'];
				echo '<button type="button" class="btn-primary" data-toggle="modal" data-target="#dataUpdate"';
				echo 'data-id="'.$row['ID_Tel'].'"';
				echo 'data-tipo-equipo="'.$row['ID_Tipo_Tel'].'"';
				echo 'data-serie="'.$row['Serie'].'"';
				echo 'data-descripcion="'.$row['Descripcion'].'"';
				echo 'data-marca="'.$row['Marca'].'"';
				echo 'data-modelo="'.$row['Modelo'].'"';
				echo 'data-uni="'.$row['Uni'].'"';	
				echo 'data-ext="'.$row['Ext'].'"';
				echo 'data-ip="'.$row['IP'].'"';
			    echo 'data-inventario="'.$row['Inventario'].'"';
				echo 'data-sitio="'.$row['ID_Sitio'].'"';	
				echo 'data-propietario="'.$row['ID_Propietario'].'"';	
				echo 'data-empleado="'.$row['Empleado'].'">';
				echo '<i class="glyphicon glyphicon-edit"></i> Modificar</button>';
				echo '<button type="button" class="btn btn-danger"';
				echo 'data-toggle="modal"  data-target="#dataDelete"';								
				echo 'data-id="'.$row['ID_Tel'].'"  ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></div>';
				echo '</td>';
				echo '<td>'.$row['Serie'].'</td>';
				echo '<td>'.$row['Descripcion'].'</td>';				
				echo '<td>'.$row['ID_Tipo_Tel'].'</td>';
				echo '<td>'.$row['Marca'].'</td>';
				echo '<td>'.$row['Modelo'].'</td>';
				echo '<td>'.$row['Uni'].'</td>';
				echo '<td>'.$row['Ext'].'</td>';
				echo '<td>'.$row['IP'].'</td>';
				echo '<td>'.$row['Inventario'].'</td>';
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