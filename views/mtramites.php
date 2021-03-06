
<?php
  require_once("../config/conexion.php");
  if(isset($_SESSION["email"])){
?>

<?php
	
	require_once("header.php");

?>

    <!--___________________________CONTENIDO______________________________-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    	<!-- Content Header (Page header) -->
	    <section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1>Tramites</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item">Maestro</li>
	              <li class="breadcrumb-item active">Tramites</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
	    </section>
	    <section class="content">
	      <div class="container-fluid">
	        <div class="row">
	          <div class="col-md-10 offset-md-1">
	            <div class="card card-success card-outline">
	              <div class="card-header">
	                <h3 class="card-title">Tramites</h3>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <table class="table table-bordered">
	                  <tr>
	                    <th>#</th>
	                    <th>Tramite</th>
	                    <th>Descripcion del tramite</th>
	                    <th>Estado</th>
	                    <th></th>
	                    <th></th>
	                  </tr>
	                  <tr>
	                    <td>1.</td>
	                    <td>Adjudicación de Tierras</td>
	                    <td>
	                      Otorgar una determinada parcela o un lote de terreno con los fines de mantener la productividad agraria.
	                    </td>
	                    <td>
              				<div class="form-check form-check-inline">
                  				<input class="form-check-input" type="radio" name="sexo" id="m" value="masculino">
                  				<label class="form-check-label" for="m">Activo</label>
              				</div>
              				<div class="form-check form-check-inline">
                  				<input class="form-check-input" type="radio" name="sexo" id="f" value="femenino">
                  				<label class="form-check-label" for="f">Inactivo</label>
              				</div>
	                    </td>
	                    <td>
	                    	<a class="btn btn-outline-warning">
		                  		<i class="fa fa-edit"></i> Editar
		                	</a>
	                    </td>
	                    <td>
	                    	<a class="btn btn-outline-danger">
		                  		<i class="fa fa-trash"></i> Borrar
		                	</a>
	                    </td>
	                  </tr>
	                </table>
	              </div>
	              <!-- /.card-body -->
	              <div class="card-footer clearfix">
	                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter"">
	                	<i class="fa fa-plus"></i> Agregar	
	                </button>
	              </div>
	            </div>
	            <!-- /.card -->
	          </div>
	        </div>
	      </div>
	    </section>
	</div>
    <!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-centered" role="document">
    		<div class="modal-content card-success card-outline">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalCenterTitle">Agregar Tramite</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body">
    				<form role="form">
      					<div class="form-row">
        					<div class="col-md-12 mb-3">
          						<label>Nombre Del Tramite</label>
          						<input type="text" class="form-control" id="validationCustom03" placeholder="Ingrese el nombre del tramite" required>
        					</div>
      					</div>
      					<div class="col-md-12 mb-3">
        					<label>Descripcion del Tramite</label>
        					<textarea class="form-control" placeholder="Ingrese la Descripcion del Tramite" min-height="50" maxlength="20"></textarea>
      					</div>
      					<div class="col-md-12 mb-3">
      						<label for="sexo">Estado</label><br>
        					<div class="form-check form-check-inline">
            					<input class="form-check-input" type="radio" name="sexo" id="m" value="masculino">
            					<label class="form-check-label" for="m">Activo</label>
        					</div>
        					<div class="form-check form-check-inline">
            					<input class="form-check-input" type="radio" name="sexo" id="f" value="femenino">
            					<label class="form-check-label" for="f">Inactivo</label>
        					</div>
      					</div>
            		</form>
              	
      				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        				<button class="btn btn-success btn-block" id="enviar" type="submit">Guardar</button>
      				</div>
      			</div>
    		</div>
  		</div>
	</div>
    <!-- /.content-wrapper -->
    <!--___________________________CONTENIDO______________________________-->


<?php
	
	require_once("footer.php");

?>

<?php
  } else {
    header("Location:".Conectar::ruta()."views/index.php");
    exit();
  }
?>
