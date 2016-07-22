	function load(page){
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			type: "POST",
			
			
			url:'sitios_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='../img/loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
				
				//alert("hola  si entro");
			}
		})
	}
	
		$('#dataUpdate').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var sit = button.data('sitio')
		  var id = button.data('id') 
		  var est = button.data('estado') 
		  var insta = button.data('instancia')
		  var dom = button.data('domicilio')
		  var muni = button.data('municipio') 
		  var enlace = button.data('enlace') 
		  // Extraer la información de atributos de datos
				
		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Telefonos: '+sit)
		  modal.find('.modal-body #id').val(id)
		  modal.find('.modal-body #sitio').val(sit)
		  modal.find('.modal-body #estado').val(est)
		  modal.find('.modal-body #instancia').val(insta)
		  modal.find('.modal-body #domicilio').val(dom)
		  modal.find('.modal-body #municipio').val(muni)
		  modal.find('.modal-body #enlace').val(enlace)
	
		 $('.alert').hide();//Oculto alert
		 					//.setTimeout('close()',60);

		})
		
		 $('#dataDelete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var modal = $(this)
		  modal.find('.modal-content #ID_Sitio').val(id)
		
		})

	$( "#actualizarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "modificar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax").html(datos);
					//$('#dataUpdate').modal('hide');						
					//.setTimeout('close()',60);
					
		
					load(1);
				  }
			});
			
		  event.preventDefault();
		});
		 
	
		$( "#guardarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "agregar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){					
						$("#datos_ajax_register").html(datos);
						$('#dataRegister').modal('hide');	
						load(1);
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#eliminarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "eliminar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$(".datos_ajax_delete").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$(".datos_ajax_delete").html(datos);
					
					$('#dataDelete').modal('hide');					
					load(1);
				  }
			});
		  event.preventDefault();
		});

		