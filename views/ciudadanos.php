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
              <h1>Listado de Ciudadanos</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Ciudadanos</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div id="resultados_ajax"></div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-success card-outline p-2">
                <div class="card-header with-border">
                  <h1 class="box-title">
                  <button class="btn btn-success" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#usuarioModal"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ciudadano</button></h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="card-body table-responsive">
                  <table id="usuario_data" class="table table-sm table-bordered table-striped">
                    <thead>                              
                      <tr>                           
                        <th>Cédula</th>
                        <th>Rif</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <!-- <th>Fecha Ingreso</th> -->
                        <th width="10%">Editar</th>
                        <th width="10%">Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                  </table>
                </div><!--Fin centro -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    
    <!--FORMULARIO VENTANA MODAL-->
    <div id="usuarioModal" class="modal fade">
      <div class="modal-dialog modal-dialog-scrollable">
        <form method="post" id="usuario_form">
          <div class="modal-content card-success card-outline">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Ciudadanos</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>           
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Nombres: </label>
                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Apellidos: </label>
                  <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                </div>
              </div>
              <div class="form-row">
              	<div class="col-md-2 mb-3">
                    <label for="nacionalidad">Nacionalidad: </label>
                    <select id="nacionalidad" class="form-control"  >
                        <option selected> </option>
                        <option>V</option>
                        <option>E</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label>Cédula:</label>
                  <input type="text" name="cedula" id="cedula" class="form-control" placeholder="Cédula" required pattern="[0-9]{0,15}"/>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Rif:</label>
                  <input type="text" name="cedula" id="cedula" class="form-control" placeholder="Rif" required pattern="[0-9]{0,15}"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Teléfono</label>
                  <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" required pattern="[0-9]{0,15}"/>
                </div>
                 <div class="col-md-6 mb-3">
                  <label>Correo</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Correo" required="required"/>
                </div>
              </div>       
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>Dirección</label>
                  <textarea cols="90" rows="2" id="direccion" name="direccion"  placeholder="Direccion ..." required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$"></textarea> 
                </div>
              </div>                     
            </div>
            <div class="modal-footer">
              <input type="hidden" name="id_usuario" id="id_usuario"/>
              <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left" value="Add">Guardar <i class="fas fa-user-check"></i></button>         
              <button type="button" onclick="limpiar()" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>  
            </div>
          </div>
        </form>
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