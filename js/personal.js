	function load(page){
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			type: "POST",
			
	url:'personal_ajax.php',
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
		  var emp = button.data('emp')
		  var id = button.data('id') 
		  var nom = button.data('nom') 
		  var pat = button.data('pat')
		  var mat = button.data('mat') 
		  var pues = button.data('pues') 
		  var rfc = button.data('rfc') 
		  var curp = button.data('curp') 
		  var sit = button.data('sit') 
			
		  // Extraer la información de atributos de datos
				
		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Personal: '+nom)
		  modal.find('.modal-body #id').val(id)
		  modal.find('.modal-body #empleado').val(emp)
		  modal.find('.modal-body #nombre').val(nom)
		  modal.find('.modal-body #pat').val(pat)
		  modal.find('.modal-body #mat').val(mat)
		  modal.find('.modal-body #puesto').val(pues)
		  modal.find('.modal-body #rfc').val(rfc)
		  modal.find('.modal-body #curp').val(curp)
		  modal.find('.modal-body #sitio').val(sit)
	
		 $('.alert').hide();//Oculto alert
		 					//.setTimeout('close()',60);

		})
		
		 $('#dataDelete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var modal = $(this)
		  modal.find('.modal-content #ID_Personal').val(id)
		
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

		