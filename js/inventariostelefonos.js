	function load(page){
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			type: "POST",
			
			
			url:'inventario_ajax.php',
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
		  var id = button.data('id') 
		  var marca = button.data('marca') 
		  var modelo = button.data('modelo')
		  var serie = button.data('serie') 
		  var uni = button.data('uni') 
		  var ext = button.data('ext')
		  var ip = button.data('ip') 
		  var inv = button.data('inventario')
		   var sitio = button.data('sitio')
		  var empleado = button.data('empleado')
				
		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Telefonos: '+marca)
		  modal.find('.modal-body #id').val(id)
		  modal.find('.modal-body #marca').val(marca)
		  modal.find('.modal-body #modelo').val(modelo)
		  modal.find('.modal-body #serie').val(serie)
		  modal.find('.modal-body #uni').val(uni)
		  modal.find('.modal-body #ext').val(ext)
		  modal.find('.modal-body #ip').val(ip)
		  modal.find('.modal-body #inventario').val(inv)
		  modal.find('.modal-body #sitio').val(sitio)
		  modal.find('.modal-body #empleado').val(empleado)
		  
		 $('.alert').hide();//Oculto alert
		 					//.setTimeout('close()',60);

		})
		
		 $('#dataDelete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var modal = $(this)
		  modal.find('.modal-content #ID_Tel').val(id)
		
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

	