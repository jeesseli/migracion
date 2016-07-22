	$( "#guardarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
		var tabla =getJson();
			 /*$.ajax({
					type: "POST",
					url: "agregar.php",
					data: parametros,
					 beforeSend: function(objeto){
						//$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){					
						//$("#datos_ajax_register").html(datos);
						//$('#dataRegister').modal('hide');	
						//load(1);
				  }
			});*/
		  event.preventDefault();
		});
function getJson(){
    var table = document.getElementById('myTable');
    var tr = table.getElementsByTagName('tr');
    var jObject = {}
    for (var i = 0; i < tr.length; i++){
        var td = tr[i].getElementsByTagName('td');
        
        for (var j = 0; j < td.length; j++){
            jObject['table_tr' + i + '_td_' + j] = td[j].innerHTML;
        }
    }
    return jObject;
}
console.log(getJson());