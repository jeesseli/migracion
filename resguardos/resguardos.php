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
	<form id="guardarDatos">
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
	
	 <div class="ui-widget" >
  Num.Empleado:    <input id="Empleado" name="empleado"> 
    Nombre: <input id="Nombre" name="Nombre" readonly>
	 Apellido Paterno: <input id="Ape_Paterno" name="Ape_Paterno" readonly>
	  Apellido Materno: <input id="Ape_Materno" name="Ape_Materno" readonly>
	   Sitio: <input id="ID_Sitio" name="ID_Sitio" readonly>
  <input type="hidden" id="ID_Personal">
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
		<TEXTAREA class="form-control" NAME="observaciones" rows="3"> 
       </TEXTAREA> <br>
	   
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
		var parametros = $(this).serialize();
		console.log(parametros);		
		var tabla =getJson();
		console.log(tabla);		
			 $.ajax({
					type: "POST",
					url: "agregar.php",
					data: {empleado: parametros, tabla: tabla},
					 beforeSend: function(objeto){
						//$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){					
						//$("#datos_ajax_register").html(datos);
						//$('#dataRegister').modal('hide');	
						//load(1);
				  }
			});
		  event.preventDefault();
});
function getJson(){
	//console.log('holi');
    var table = document.getElementById("myTable");
    var tr = table.getElementsByTagName("tr");
    var jObject = {}
    for (var i = 0; i < tr.length; i++){
        var td = tr[i].getElementsByTagName("td");        
        for (var j = 0; j < td.length; j++){
			//jObject[""+i] = td[j].innerHTML;
			if(j==0){
				jObject[""+i] = td[j].innerHTML;
			}
        }
    }
	//console.log(jObject);
    return jObject;	
}
</script>
</html>