<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Resguardos</title>
		<link href="../js/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript">
$(function() {
            $("#Equipo_Serie").autocomplete({
                source: "autocompleteResguardos.php",
                minLength: 2,
                select: function(event, ui) {
					event.preventDefault();
                    $('#Equipo_Serie').val(ui.item.Equipo_Serie);
					$('#Descripcion').val(ui.item.Descripcion);
					$('#Equipo_Modelo').val(ui.item.Equipo_Modelo);
					$('#ID_Equipo').val(ui.item.ID_Equipo);
			     }
            });
		});
		$(function() {
            $("#Empleado").autocomplete({
                source: "autoEmpleado.php",
                minLength: 2,
                select: function(event, ui) {
					event.preventDefault();
                    $('#Empleado').val(ui.item.Empleado);                    
                    $('#numEmpleado').val(ui.item.Empleado);
					$('#Nombre').val(ui.item.Nombre);
					$('#Ape_Paterno').val(ui.item.Ape_Paterno);
					$('#Ape_Materno').val(ui.item.Ape_Materno);
					$('#ID_Sitio').val(ui.item.ID_Sitio);
					$('#ID_Personal').val(ui.item.ID_Personal);
			     }
            });
		});

</script>




    </head>
    <body>
	
	<div align="center">
<IMG src="../img/Logo1.png "><IMG SRC="../img/Logo2.png"> 
</div>
<h3>
<p class="text-center"  aria-labelledby="exampleModalLabel">
    <strong>
	INSTITUTO NACIONAL DE MIGRACIÓN <br>DELEGACIÓN REGIONAL EN QUINTANA ROO<br>
	DEPARTAMENTO DE INFORMATICA

	
	</strong>
</p>
</h3>
<h5><p class="text-center"><strong>SALIDA DE BIENES INFORMATICOS EN PRESTAMO<br></strong></p></h5>
<div class="container">
<div class="panel panel-success"> 
      <div class="panel-heading">BIENES INFORMATICOS             <div align="left"><?php  
$time = time();
echo date("d-m-Y ", $time);
?></div></div>
<strong>
	  <p>	 
	<form id="guardarDatos">
	 <div class="ui-widget" >
  Num.Empleado:    <input id="Empleado"> 
  <input type="hidden" id="numEmpleado" name="empleado"> 
    Nombre: <input id="Nombre" name="Nombre" readonly>
	 Apellido Paterno: <input id="Ape_Paterno" name="Ape_Paterno" readonly>
	  Apellido Materno: <input id="Ape_Materno" name="Ape_Materno" readonly>
	   Sitio: <input id="ID_Sitio" name="ID_Sitio" readonly>
  <input type="hidden" name ="ID_Personal" id="ID_Personal">
</div>	 
</p>
</strong><br>

<strong>
	  <p>	 
	 <div class="ui-widget" >
	 
  Serie:  <input id="Equipo_Serie" >
  Descripcion: <input id="Descripcion" readonly>
  Modelo: <input id="Equipo_Modelo" readonly>
  <input type="hidden" id="ID_Equipo">
   <button type="button" id="mas" name="mas" class="btn btn-success" onclick="agregar()">Agregar</button>

</div>
</p>
</strong><br>

		Observaciones: <br>
		
       <textarea class="form-control" name="observaciones" rows="5" id="observaciones"></textarea>
       <br>
	   
	   <div>
		   <table id="myTable" class="table table-bordered">
			   <tr>	 
				<th>Id</th>
				<th>Serie</th>
				<th>Descripcion</th>
				<th>Modelo</th>
				<th></th>
			   </tr>				
		</table>
	</div>
	
	  <p align="center">
 	  
 <button name="guardar" class="btn btn-primary">Guardar datos</button>
 </form>
 <button type="button" id="mas" name="mas" class="btn btn-success" onclick="getJson()">GUARDAR</button>
  <input type="reset" id="cancelar" value="CANCELAR" name="cancelar">
  <input type="button" onClick="window.location='MenuCatalogo.php'" id="regresar" value="REGRESAR" name="regresar">

  </p>

	  
	  
    

</div>


    </body>
	
<script>
function agregar() {
	if(document.getElementById("ID_Equipo").value!=''){
		var table = document.getElementById("myTable");
		var row = table.insertRow();    
		row.insertCell(0).innerHTML =document.getElementById("ID_Equipo").value;
		row.insertCell(1).innerHTML = document.getElementById("Equipo_Serie").value;
		row.insertCell(2).innerHTML = document.getElementById("Descripcion").value;
		row.insertCell(3).innerHTML = document.getElementById("Equipo_Modelo").value;	
		document.getElementById("ID_Equipo").value ='';
		document.getElementById("Equipo_Serie").value ='';
		document.getElementById("Descripcion").value ='';
		document.getElementById("Equipo_Modelo").value ='';		
		var campo3 = document.createElement("input");
			campo3.type = "button";
			campo3.value = "Borrar Fila";
			campo3.onclick = function() {        
				var fila = this.parentNode.parentNode;
				var tbody = table.getElementsByTagName("tbody")[0];            
				tbody.removeChild(fila);            
			}
		row.insertCell(4).appendChild(campo3);
	}else{
		document.getElementById("Equipo_Serie").focus();
	}
}
function eliminar() {
    var table = document.getElementById("myTable");
    var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
}
$( "#guardarDatos" ).submit(function( event ) {
		//var parametros = $(this).serialize();
		var $form = $(this);
		var parametros = getFormData($form);
		//console.log(parametros);		
		var tablaData =getJson();
		//console.log(tabla);	
		if (document.getElementById("numEmpleado").value.length == 0){
			alert('Necesita agregar un Empleado');
		}
		//console.log(tabla.value);
		if(!jQuery.isEmptyObject(tablaData)){
			$.ajax({
			    type: 'POST',
			    url:  'agregarRegistro.php',
			    data: {usuario : parametros,tabla: tablaData},
			    success:  function(data){
			        //alert("---"+data);
			        //console.log(data);
			        alert("Settings has been updated successfully.");			        
			    }
			});		
			  
		}else{
			alert('La tabla!!!');
		}
		event.preventDefault();
});
function getJson(){
	//console.log('holi');
    var table = document.getElementById("myTable");
    var tr = table.getElementsByTagName("tr");
    var jObject = {};
    for (var i = 0; i < tr.length; i++){
        var td = tr[i].getElementsByTagName("td");        
        for (var j = 0; j < td.length; j++){
			//jObject[""+i] = td[j].innerHTML;
			if(j==0){
				jObject[""+i] = td[j].innerHTML;
			}
        }
    }
	console.log(jObject);
    return jObject;	
}
function getFormData ( $form ){ 
    var unindexed_array = $form . serializeArray (); 
    var indexed_array =  {}; 

    $ . map ( unindexed_array ,  function ( n , i ){ 
        indexed_array [ n [ 'name' ]]  = n [ 'value' ]; 
    }); 

    return indexed_array ; 
}
</script>
</html>