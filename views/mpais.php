<?php
  require_once("../config/conexion.php");
  if(isset($_SESSION["correo"])){
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
	            <h1>Maestro Pais</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item">Maestro</li>
	              <li class="breadcrumb-item active">País</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
	    </section>
	    <section class="content">
        <div id="resultados_ajax"></div>
	      <div class="container-fluid">
	        <div class="row">
	          <div class="col-md-8 offset-md-2">
	            <div class="card card-success card-outline">
	              <div class="card-header">
	                <h3 class="card-title">País</h3>
	                <button class="btn btn-success" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#usuarioModal"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button></h1>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <div class="card-body table-responsive">
                  <table id="pais_data" class="table table-sm table-bordered table-striped">
                    <thead>                              
                      <tr>                           
                        <th>#</th>
                        <th>Nombre</th>
                        <th width="10%">Editar</th>
                        <th width="10%">Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                  </table>
                </div>
	              </div>
	              <!-- /.card-body -->
	              <div class="card-footer clearfix">
	                
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
        <form method="post" id="pais_form>
      		<div class="modal-content card-success card-outline">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalCenterTitle">Agregar País</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body">
    					<div class="form-row">
      					<div class="col-md-12 mb-3">
      						<label>Nombre Del País</label>
      						<input type="text" class="form-control" placeholder="Ingrese el nombre del País" required>
      					</div>
    					</div>
              <div class="form-row">
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
              </div>
          	</div>
            <div class="modal-footer">
              <input type="hidden" name="codpais" id="codpais"/>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-success btn-block" id="enviar" type="submit">Guardar</button>
              <button type="button" onclick="limpiar()" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
      		</div>
        </form>
  		</div>
	</div>
    <!-- /.content-wrapper -->
    <!--___________________________CONTENIDO______________________________-->

<script type="text/javascript" src="js/usuarios.js"></script>


<?php
	
	require_once("footer.php");

?>

<?php
  } else {
    header("Location:".Conectar::ruta()."views/index.php");
    exit();
  }
?>