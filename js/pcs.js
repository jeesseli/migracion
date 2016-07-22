	function load(page){
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			type: "POST",
			url:'pcs_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='../img/loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");							
			}
		})
	}
	
		$('#dataUpdate').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var descripcion = button.data('descripcion')
		  var id = button.data('id') 
		  var marca = button.data('equipo_marca') 
		  var modelo = button.data('equipo_modelo')
		  var serie = button.data('equipo_serie') 
		  var resguardo = button.data('resguardo') 
		  var numinv = button.data('numinv') 
		  var mma = button.data('monitor_marca')
		  var mmd = button.data('monitor_modelo') 
		  var mse = button.data('monitor_serie')
		  var tmarca = button.data('teclado_marca')
		  var tmod = button.data('teclado_modelo') 
		  var tserie = button.data('teclado_serie')
		  var mmarca = button.data('mouse_marca') 
		  var mmod = button.data('mouse_modelo') 
		  var mserie = button.data('mouse_serie')
		  var umarca = button.data('ups_marca') 
		  var umod = button.data('ups_modelo') 
		  var userie = button.data('ups_serie')
		  var sitio = button.data('sitio')
		  var empleado = button.data('empleado') // Extraer la información de atributos de datos
				
		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar pcs: '+descripcion)
		  modal.find('.modal-body #id').val(id)
		  modal.find('.modal-body #descripcion').val(descripcion)
		  modal.find('.modal-body #equipo_marca').val(marca)
		  modal.find('.modal-body #equipo_modelo').val(modelo)
		  modal.find('.modal-body #equipo_serie').val(serie)
		    modal.find('.modal-body #resguardo').val(resguardo)
		  modal.find('.modal-body #numinv').val(numinv)
		  modal.find('.modal-body #monitor_marca').val(mma)
		  modal.find('.modal-body #monitor_mod').val(mmd)
		  modal.find('.modal-body #monitor_serie').val(mse)
		  modal.find('.modal-body #teclado_marca').val(tmarca)
		  modal.find('.modal-body #teclado_mod').val(tmod)
		  modal.find('.modal-body #teclado_serie').val(tserie)
		  modal.find('.modal-body #mouse_marca').val(mmarca)
		  modal.find('.modal-body #mouse_mod').val(mmod)
		  modal.find('.modal-body #mouse_serie').val(mserie)
		  modal.find('.modal-body #ups_marca').val(umarca)
		  modal.find('.modal-body #ups_mod').val(umod)
		  modal.find('.modal-body #ups_serie').val(userie)
		  modal.find('.modal-body #sitio').val(sitio)
		  modal.find('.modal-body #empleado').val(empleado)
		  
		 $('.alert').hide();//Oculto alert
		 					//.setTimeout('close()',60);

		})
		
		 $('#dataDelete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var modal = $(this)
		  modal.find('.modal-content #ID_Equipo').val(id)
		
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
						//$('#dataRegister').modal('hide');	
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


	