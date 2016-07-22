<form id="actualizarDatos">
<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Modificar Personal</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax"></div>
			  <div class="form-group">
            <label for="sitio" class="control-label">Sitio:</label>
            <input type="text" class="form-control" id="sitio" name="sitio" >
			<input type="hidden" class="form-control" id="id" name="id">
		  </div>
		  <div class="form-group">
            <label for="estado" class="control-label">Estado:</label>
            <input type="text" class="form-control" id="estado" name="estado" >
          </div>
		  <div class="form-group">
            <label for="instancia" class="control-label">Instancia:</label>
            <input type="text" class="form-control" id="instancia" name="instancia" >
          </div>
		    <div class="form-group">
            <label for="domicilio" class="control-label">Domicilio:</label>
            <input type="text" class="form-control" id="domicilio" name="domicilio" >
          </div>
		  <div class="form-group">
            <label for="municipio" class="control-label">Municipio:</label>
            <input type="text" class="form-control" id="municipio" name="municipio" >
          </div>
		  <div class="form-group">
            <label for="enlace" class="control-label">Enlace:</label>
            <input type="text" class="form-control" id="enlace" name="enlace"> 
          </div>         
        
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar datos</button>

		</div>
    </div>
  </div>
</div>
</form>